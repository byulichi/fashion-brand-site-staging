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
            $existingCartItem = Cart::where('user_id', Auth::id())->where('item_id', $itemId)->first();

            if ($existingCartItem) {
                $existingCartItem->increment('quantity');
            } else {
                $cart = new Cart();
                $cart->user_id = Auth::id();
                $cart->item_id = $itemId;
                $cart->quantity = 1;
                $cart->save();
            }
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$itemId])) {
                $cart[$itemId]['quantity']++;
            } else {
                $item = Item::find($itemId);
                if ($item) {
                    $cart[$itemId] = [
                        'id' => $itemId,
                        'type_id' => $item->type_id,
                        'name' => $item->name,
                        'price' => $item->price,
                        'quantity' => 1,
                        'photo' => $item->photo,
                    ];
                }
            }
            session()->put('cart', $cart);
        }

        $item = Item::find($itemId);
        if ($item) {
            $request->session()->flash('item_added', [
                'id' => $itemId,
                'type_id' => $item->type_id,
                'name' => $item->name,
                'price' => number_format($item->price, 2),
                'photo' => $item->photo,
            ]);
        }

        if ($request->input('action') === 'checkout') {
            return redirect()->route('cart');
        } else {
            return redirect()->route('products', array_merge($request->only(['sort', 'type'])));
        }
    }
    public function update($itemId, Request $request)
    {
        if ($request->input('quantity', 1) <= 0) {
            return $this->remove($itemId, $request);
        }

        if (Auth::check()) {
            $cartItem = Cart::where('user_id', Auth::id())->where('id', $itemId)->firstOrFail();
            $cartItem->quantity = $request->input('quantity', 1);
            $cartItem->save();
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$itemId])) {
                $cart[$itemId]['quantity'] = $request->input('quantity', 1);
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
}
