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

class CheckoutController extends Controller
{
    // STRIPE
    public function checkout(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
        ]);
        $shippingAddress = [
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'zip' => $request->input('zip'),
        ];

        $cartItems = Auth::check() ? Auth::user()->cart()->with('item')->get() : collect(session()->get('cart', []));
        $lineItems = [];
        $lineItemDetails = [];
        $totalPrice = 0;

        foreach ($cartItems as $cartItem) {
            $itemPrice = is_array($cartItem) ? $cartItem['price'] * 100 : $cartItem->item->price * 100;
            $quantity = is_array($cartItem) ? $cartItem['quantity'] : $cartItem->quantity;
            $totalPrice += $itemPrice * $quantity;

            $lineItemDetails[] = [
                'id' => is_array($cartItem) ? $cartItem['id'] : $cartItem->item->id,
                'quantity' => $quantity,
            ];

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'myr',
                    'product_data' => [
                        'name' => is_array($cartItem) ? $cartItem['name'] : $cartItem->item->name,
                        'images' => is_array($cartItem) ? [asset($cartItem['photo'])] : [asset($cartItem->item->photo)],
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
            $existingOrder->line_items = json_encode($lineItemDetails);
            $existingOrder->shipping_address = json_encode($shippingAddress);
            $existingOrder->save();
        } else {
            Order::create([
                'user_id' => Auth::id(),
                'status' => 'unpaid',
                'total_price' => $totalPrice / 100,
                'session_id' => $session->id,
                'line_items' => json_encode($lineItemDetails),
                'shipping_address' => json_encode($shippingAddress),
            ]);
        }

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        Stripe::setApiKey(apiKey: env('STRIPE_SECRET_KEY'));
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
        $order = Order::where('user_id', Auth::id())->where('status', 'unpaid')->latest()->first();
        if ($order) {
            $order->delete();
        }

        return redirect()->route('cart')->with('message', 'Payment was canceled. Your cart is still intact.');
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

    // If user hasn't paid
    public function pay($orderId)
    {
        Stripe::setApiKey(apiKey: env('STRIPE_SECRET_KEY'));

        $order = Order::findOrFail($orderId);
        $lineItems = json_decode($order->line_items, true);

        $stripeLineItems = [];
        foreach ($lineItems as $item) {
            $product = Item::find($item['id']);
            if ($product) {
                $stripeLineItems[] = [
                    'price_data' => [
                        'currency' => 'myr',
                        'product_data' => [
                            'name' => $product->name,
                        ],
                        'unit_amount' => $product->price * 100,
                    ],
                    'quantity' => $item['quantity'],
                ];
            }
        }

        $session = \Stripe\Checkout\Session::create([
            'line_items' => $stripeLineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
        ]);

        return redirect($session->url);
    }
}
