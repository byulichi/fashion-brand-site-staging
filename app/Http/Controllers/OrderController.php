<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();

        // dd($orders);
        // Example of filtering orders
        //$allOrders = $orders;
        //$toReceive = $orders->where('status', 'to_receive');
        //$completed = $orders->where('status', 'completed');

        return view('products.my-purchases', compact('orders'/*'allOrders', 'toReceive', 'completed'*/));
    }
}
