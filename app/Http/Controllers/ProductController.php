<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ProductController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('products.index', compact('items'));
    }
}
