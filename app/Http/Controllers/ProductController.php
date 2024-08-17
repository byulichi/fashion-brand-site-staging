<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->query('sort', 'latest');

        switch ($sort) {
            case 'price_asc':
                $items = Item::orderBy('price', 'asc')->get();
                break;
            case 'price_desc':
                $items = Item::orderBy('price', 'desc')->get();
                break;
            case 'latest':
            default:
                $items = Item::orderBy('id', 'asc')->get();
                break;
        }

        return view('products.index', compact('items'));
    }
}
