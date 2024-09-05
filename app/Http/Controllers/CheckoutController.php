<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $cartItems = Auth::check() ? Auth::user()->cart()->with('item')->get() : collect(session()->get('cart', []));

        return view('checkout.index', compact('cartItems'));
    }

    public function processCheckout(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Retrieve cart items
        $cartItems = Auth::check() ? Auth::user()->cart()->with('item')->get() : collect(session()->get('cart', []));

        $totalAmount = $cartItems->sum(function ($cartItem) {
            return is_array($cartItem)
                ? $cartItem['price'] * $cartItem['quantity']
                : $cartItem->item->price * $cartItem->quantity;
        }) * 100;

        // Prepare line items for Stripe checkout
        $lineItems = $cartItems->map(function ($cartItem) {
            return [
                'price_data' => [
                    'currency' => 'myr',
                    'product_data' => [
                        'name' => is_array($cartItem) ? $cartItem['name'] : $cartItem->item->name,
                    ],
                    'unit_amount' => is_array($cartItem) ? $cartItem['price'] * 100 : $cartItem->item->price * 100,
                ],
                'quantity' => is_array($cartItem) ? $cartItem['quantity'] : $cartItem->quantity,
            ];
        })->toArray();

        try {
            // Create a Stripe checkout session
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('checkout.success'),  // Success URL
                'cancel_url' => route('checkout.cancel'),   // Cancel URL
            ]);

            // Redirect to the Stripe checkout page
            return redirect()->away($session->url);

        } catch (ApiErrorException $e) {
            // Return error message if something goes wrong
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function success()
    {
        // Handle success scenario (e.g., clear cart)
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('cart');
        }

        // Return success view
        return view('checkout.success')->with('success', 'Payment successful! Thank you for your purchase.');
    }

    public function cancel()
    {
        // Handle cancel scenario
        return view('checkout.cancel')->withErrors(['error' => 'Payment was cancelled.']);
    }

    public function test(): RedirectResponse
{
    //Stripe::setApiKey(env('STRIPE_SECRET'));
    Stripe::setApiKey(config('stripe.test.sk'));

    $session = Session::create([
        'line_items'  => [
            [
                'price_data' => [
                    'currency'     => 'gbp',
                    'product_data' => [
                        'name' => 'T-shirt',
                    ],
                    'unit_amount'  => 500,
                ],
                'quantity'   => 1,
            ],
        ],
        'mode'        => 'payment',
        'success_url' => route('checkout.success'),
        'cancel_url'  => route('checkout.cancel'),
    ]);

    return redirect()->away($session->url);
}

}
