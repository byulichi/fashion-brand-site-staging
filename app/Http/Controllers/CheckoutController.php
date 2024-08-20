<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve the cart items
        $cartItems = Auth::check() ? Auth::user()->cart()->with('item')->get() : collect(session()->get('cart', []));

        // Pass the cart items to the view
        return view('checkout.index', compact('cartItems'));
    }

    public function processCheckout(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $cartItems = Auth::check() ? Auth::user()->cart()->with('item')->get() : collect(session()->get('cart', []));

        $totalAmount = $cartItems->sum(function ($cartItem) {
            return is_array($cartItem)
                ? $cartItem['price'] * $cartItem['quantity']
                : $cartItem->item->price * $cartItem->quantity;
        });

        try {
            $customer = Customer::create([
                'email' => $request->input('email'),
                'source' => $request->input('stripeToken'),
            ]);

            $charge = Charge::create([
                'customer' => $customer->id,
                'amount' => $totalAmount * 100,
                'currency' => 'myr',
                'description' => 'Order from Fashion Brand Site',
            ]);

            if (Auth::check()) {
                Cart::where('user_id', Auth::id())->delete();
            } else {
                session()->forget('cart');
            }

            return redirect()->route('products')->with('success', 'Payment successful! Thank you for your purchase.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
