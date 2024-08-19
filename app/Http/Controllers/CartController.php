<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Item;

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
            // Handle cart for guest users
            $cart = session()->get('cart', []);

            if (isset($cart[$itemId])) {
                $cart[$itemId]['quantity']++;
            } else {
                $item = Item::find($itemId);
                $cart[$itemId] = [
                    'name' => $item->name,
                    'price' => $item->price,
                    'quantity' => 1,
                    'image' => 'https://via.placeholder.com/400x600', // Replace with actual image path
                ];
            }

            session()->put('cart', $cart);
        }

        $item = Item::find($itemId);
        $request->session()->flash('item_added', [
            'name' => $item->name,
            'price' => number_format($item->price, 2),
            'image' => 'https://via.placeholder.com/400x600', // Replace with actual image path
        ]);

        if ($request->input('action') === 'checkout') {
            return redirect()->route('cart');
        } else {
            return redirect()->route('products');
        }
    }

    public function update($itemId, Request $request)
    {
        if (Auth::check()) {
            // Authenticated user
            $cartItem = Cart::where('user_id', Auth::id())->where('item_id', $itemId)->firstOrFail();
            $quantity = $request->input('quantity', 1);

            $cartItem->quantity = max(1, $quantity);
            $cartItem->save();
        } else {
            // Guest user
            $cart = session()->get('cart', []);
            if (isset($cart[$itemId])) {
                $quantity = max(1, $request->input('quantity', 1));
                $cart[$itemId]['quantity'] = $quantity;
                session()->put('cart', $cart);
            }
        }

        return redirect()->route('cart')->with('success', 'Cart updated successfully.');
    }

    public function remove($itemId)
    {
        if (Auth::check()) {
            // Authenticated user
            $cartItem = Cart::where('user_id', Auth::id())->where('item_id', $itemId)->firstOrFail();
            $cartItem->delete();
        } else {
            // Guest user
            $cart = session()->get('cart', []);
            if (isset($cart[$itemId])) {
                unset($cart[$itemId]);
                session()->put('cart', $cart);
            }
        }

        return redirect()->route('cart')->with('success', 'Item removed from cart.');
    }
}
