<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;

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
            'photo' => $item->photo
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

    public function checkout()
    {
        Stripe::setApiKey(env('STRIPE_SK'));
        // \Stripe\Stripe::setApiKey(env('STRIPE_SK'));

        $cartItems = Auth::check() ? Auth::user()->cart()->with('item')->get() : collect(session()->get('cart', []));
        $lineItems = [];
        $totalPrice = 0;
        foreach ($cartItems as $cartItem) {
            // is_array($cartItem) ? dd([asset($cartItem['photo'])]) : dd([asset($cartItem->photo)]); Only works in production(deployed), else it will pass   0 => "http://127.0.0.1:8000/images/○○/○○.JPG"

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
                    'unit_amount' => is_array($cartItem) ? $cartItem['price'] * 100 : $cartItem->item->price * 100,
                ],
                'quantity' => is_array($cartItem) ? $cartItem['quantity'] : $cartItem->quantity,
            ];
        }

        $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true),
            'cancel_url' => route('checkout.cancel', [], true),
        ]);

        // Save session into orders table DB
        $order = new Order();
        $order->status = 0; // unpaid
        $order->total_price = $totalPrice / 100; // Store price as a decimal (not in cents)
        $order->session_id = $session->id;
        $order->save();

        return redirect($session->url);
    }

    public function success()
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('cart');
        }

        return view('checkout.success')->with('success', 'Payment successful! Thank you for your purchase.');
    }

    public function cancel()
    {
        return view('checkout.cancel')->withErrors(['error' => 'Payment was cancelled.']);
    }
}
