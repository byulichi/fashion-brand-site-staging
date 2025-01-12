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
use Illuminate\Support\Facades\File;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Auth::check() ? Auth::user()->cart()->with('item')->get() : collect(session()->get('cart', []));
        $totalPrice = 0;

        foreach ($cartItems as $cartItem) {
            $itemPrice = is_array($cartItem) ? $cartItem['price'] : $cartItem->item->price;
            $quantity = is_array($cartItem) ? $cartItem['quantity'] : $cartItem->quantity;
            $totalPrice += $itemPrice * $quantity;
        }

        $states = json_decode(File::get(resource_path('data/malaysian_states.json')));
        $shippingPrices = json_decode(File::get(resource_path('data/shipping_prices.json')), true);

        return view('products.checkout.checkout', compact('cartItems', 'totalPrice', 'states', 'shippingPrices'));
    }
    // STRIPE
    public function checkout(Request $request)
    {
        // dd($request->all());

        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        // Validate billing information for Stripe (as needed by Stripe)
        $request->validate([
            'billing_name' => 'required|string|max:255',
            'billing_address' => 'required|string|max:255',
            'billing_city' => 'required|string|max:255',
            'billing_state' => 'required|string|max:255',
            'billing_postcode' => 'required|string|max:20',
            'delivery_method' => 'required|string|in:pickup,shipping', // Validate delivery method
        ]);

        // Extract billing information for Stripe
        $billingDetails = [
            'name' => $request->input('billing_name'),
            'address' => [
                'line1' => $request->input('billing_address'),
                'city' => $request->input('billing_city'),
                'state' => $request->input('billing_state'),
                'postal_code' => $request->input('billing_postcode'),
                'country' => 'MY', // Assuming store is primarily in Malaysia
            ],
        ];

        // Extract delivery information for the order table
        $deliveryDetails = [
            'delivery_name' => $request->input('delivery_name'),
            'delivery_phone' => $request->input('delivery_contact_number'),
            'delivery_address' => $request->input('delivery_street_address'),
            'delivery_city' => $request->input('delivery_city'),
            'delivery_state' => $request->input('delivery_state'),
            'delivery_postcode' => $request->input('delivery_postcode'),
            'delivery_method' => $request->input('delivery_method'),
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
            'customer_creation' => 'if_required', // Create a customer if one doesn't exist
            'shipping_address_collection' => [
                'allowed_countries' => ['MY'], // Specify allowed shipping countries
            ],
            'billing_address_collection' => 'required', // Make billing address required
        ]);

        $existingOrder = Order::where('user_id', Auth::id())->where('status', 'unpaid')->first();

        $orderData =
            [
                'user_id' => Auth::id(),
                'status' => 'unpaid',
                'total_price' => $totalPrice / 100,
                'session_id' => $session->id,
                'line_items' => json_encode($lineItemDetails),
                'billing_details' => json_encode($billingDetails), // Store billing details
            ] + $deliveryDetails; // Merge delivery details

        if ($existingOrder) {
            $existingOrder->fill($orderData);
            $existingOrder->save();
        } else {
            Order::create($orderData);
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
