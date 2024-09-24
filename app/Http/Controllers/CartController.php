<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Order;
use Stripe\Stripe;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Auth::check() ? Auth::user()->cart()->with('item')->get() : collect(session()->get('cart', []));

        return view('products.shoppingcart', compact('cartItems'));
    }

    public function add(Request $request, $itemId)
    {
        if (Auth::check()) {
            $cart = new Cart();
            $cart->user_id = Auth::id();
            $cart->item_id = $itemId;
            $cart->quantity = 1;
            $cart->save();
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$itemId])) {
                $cart[$itemId]['quantity']++;
            } else {
                $item = Item::find($itemId);
                $cart[$itemId] = [
                    'type_id' => $item->type_id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'quantity' => 1,
                    'photo' => $item->photo,
                ];
            }
            session()->put('cart', $cart);
        }

        $item = Item::find($itemId);
        $request->session()->flash('item_added', [
            'type_id' => $item->type_id,
            'name' => $item->name,
            'price' => number_format($item->price, 2),
            'photo' => $item->photo,
        ]);

        if ($request->input('action') === 'checkout') {
            return redirect()->route('cart');
        } else {
            return redirect()->route('products', array_merge($request->only(['sort', 'type'])));
        }
    }

    public function update($itemId, Request $request)
    {
        if (Auth::check()) {
            $cartItem = Cart::where('user_id', Auth::id())->where('id', $itemId)->firstOrFail();
            $quantity = $request->input('quantity', 1);
            $cartItem->quantity = max(1, $quantity);
            $cartItem->save();
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$itemId])) {
                $quantity = max(1, $request->input('quantity', 1));
                $cart[$itemId]['quantity'] = $quantity;
                session()->put('cart', $cart);
            }
        }

        return redirect()
            ->route('cart', $request->only(['sort', 'type']))
            ->with('success', 'Cart updated successfully.');
    }

    public function remove($itemId, Request $request)
    {
        if (Auth::check()) {
            $cartItem = Cart::where('user_id', Auth::id())->where('id', $itemId)->firstOrFail();
            $cartItem->delete();
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$itemId])) {
                unset($cart[$itemId]);
                session()->put('cart', $cart);
            }
        }

        return redirect()
            ->route('cart', $request->only(['sort', 'type']))
            ->with('success', 'Item removed from cart.');
    }

    // STRIPE
    public function checkout()
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $cartItems = Auth::check() ? Auth::user()->cart()->with('item')->get() : collect(session()->get('cart', []));
        $lineItems = [];
        $totalPrice = 0;

        foreach ($cartItems as $cartItem) {
            $itemPrice = is_array($cartItem) ? $cartItem['price'] * 100 : $cartItem->item->price * 100;
            $quantity = is_array($cartItem) ? $cartItem['quantity'] : $cartItem->quantity;
            $totalPrice += $itemPrice * $quantity;

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'myr',
                    'product_data' => [
                        'name' => is_array($cartItem) ? $cartItem['name'] : $cartItem->item->name,
                        'images' => is_array($cartItem) ? [asset($cartItem['photo'])] : [asset($cartItem->photo)],
                    ],
                    'unit_amount' => $itemPrice,
                ],
                'quantity' => $quantity,
            ];
        }

        $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel', [], true),
        ]);

        $existingOrder = Order::where('user_id', Auth::id())->where('status', 'unpaid')->first();

        if ($existingOrder) {
            $existingOrder->session_id = $session->id;
            $existingOrder->total_price = $totalPrice / 100;
            $existingOrder->save();
        } else {
            // Create a new order if no unpaid order exists
            Order::create([
                'user_id' => Auth::id(),
                'status' => 'unpaid',
                'total_price' => $totalPrice / 100,
                'session_id' => $session->id,
            ]);
        }

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $sessionId = $request->get('session_id');

        // Log the start of the success function and session ID
        Log::info('Stripe checkout success function started. Session ID: ' . $sessionId);

        try {
            // Retrieve the session
            $session = \Stripe\Checkout\Session::retrieve($sessionId);
            Log::info('Stripe session retrieved.', ['session' => $session]);

            if (!$session) {
                Log::error('Session not found.', ['session_id' => $sessionId]);
                throw new NotFoundHttpException();
            }

            // Retrieve the customer
            // $customer = \Stripe\Customer::retrieve($session->customer);
            // Log::info('Customer retrieved.', ['customer' => $customer]);

            // Retrieve the order by session ID
            $order = Order::where('session_id', $session->id)->first();
            if (!$order) {
                Log::error('Order not found for session.', ['session_id' => $session->id]);
                throw new NotFoundHttpException();
            }

            Log::info('Order retrieved.', ['order' => $order]);

            // Update order status if unpaid
            if ($order->status === 'unpaid') {
                $order->status = 'paid';
                $order->save();
                Log::info('Order status updated to paid.', ['order_id' => $order->id]);
            }

            // Clear the cart
            if (Auth::check()) {
                Cart::where('user_id', Auth::id())->delete();
                Log::info('Cart cleared for user.', ['user_id' => Auth::id()]);
            } else {
                session()->forget('cart');
                Log::info('Session cart cleared.');
            }

            // Render success view
            // return view('checkout.success'/*, compact('customer')*/);
            return redirect()->route('my-purchases');
        } catch (\Exception $e) {
            Log::error('Error occurred in success function.', context: ['error' => $e->getMessage()]);
            throw new NotFoundHttpException();
        }
    }

    public function cancel()
    {
        return view('checkout.cancel')->withErrors(['error' => 'Payment was cancelled.']);
    }

    public function webhook()
    {
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response('', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response('', 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;

                $order = Order::where('session_id', $session->id)->first();
                if ($order && $order->status === 'unpaid') {
                    $order->status = 'paid';
                    $order->save();
                    // Send email to customer
                }

            // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response('');
    }
}
