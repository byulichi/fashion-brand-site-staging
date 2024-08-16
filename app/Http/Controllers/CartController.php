<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;


class CartController extends Controller
{
    public function index()
    {
        $cartItems = Auth::user()->cart()->with('item')->get();
        return view('cart.index', compact('cartItems'));
    }
}
