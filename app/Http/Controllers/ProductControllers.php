<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Type;

class ProductController extends Controller
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Type;

class ProductController extends Controller
{
    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('products.show', compact('item'));
    }

    public function index(Request $request)
    {
        $sort = $request->query('sort', 'latest');
        $type = $request->query('type');

        $query = Item::query();

        if ($type) {
            $query->whereHas('type', function ($q) use ($type) {
                $q->where('name', $type);
            });
        }

        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'latest':
            default:
                $query->orderBy('id', 'asc');
                break;
        }

        $items = $query->get();
        $types = Type::all();

        return view('products.index', compact('items', 'types', 'type'));
    }
}
