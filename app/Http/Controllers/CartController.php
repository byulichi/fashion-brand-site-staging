<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Item;

class CartController extends Controller
{
    public function add(Request $request, $itemId)
    {
        $cart = new Cart();
        $cart->user_id = Auth::id();
        $cart->item_id = $itemId;
        $cart->quantity = 1;
        $cart->save();

        return redirect()->route('cart');
    }

    public function index()
    {
        $cartItems = Auth::user()->cart()->with('item')->get(); // Get user's item
        return view('products.shoppingcart', compact('cartItems'));
    }

    public function update($itemId, Request $request)
    {
        $cartItem = Cart::findOrFail($itemId);
        $quantity = $request->input('quantity', 1);

        if ($quantity < 1) {
            $quantity = 1;
        }

        $cartItem->quantity = $quantity;
        $cartItem->save();

        return redirect()->route('cart')->with('success', 'Cart updated successfully.');
    }

    public function remove($itemId)
    {
        $cartItem = Cart::findOrFail($itemId);
        $cartItem->delete();

        return redirect()->route('cart')->with('success', 'Item removed from cart.');
    }

}
