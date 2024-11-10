<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the items.
     */
    public function index()
    {
        $items = Item::all();
        $types = Type::all();

        return view('products.index', compact('items', 'types'));
    }

    /**
     * Show the form for creating a new item.
     */
    public function create()
    {
        $types = Type::all();
        return view('products.staffonly.create', compact('types'));
    }

    /**
     * Store a newly created item in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type_id' => 'required|exists:types,id',
            'price' => 'required|numeric|min:0',
            'photo' => 'nullable|image|max:2048',
        ]);

        $item = new Item();
        $item->name = $request->input('name');
        $item->type_id = $request->input('type_id');
        $item->price = $request->input('price');

        if ($request->hasFile('photo')) {
            $item->photo = $request->file('photo')->store('items', 'public');
        }

        $item->save();

        return redirect()->back()->with('success', 'Item added successfully.');
    }

    /**
     * Show the form for editing the specified item.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified item in storage.
     */
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'type_id' => 'required|exists:types,id',
            'price' => 'required|numeric|min:0',
            'photo' => 'nullable|image|max:2048',
        ]);

        $item->name = $request->input('name');
        $item->type_id = $request->input('type_id');
        $item->price = $request->input('price');

        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($item->photo) {
                Storage::disk('public')->delete($item->photo);
            }
            // Store the new photo
            $item->photo = $request->file('photo')->store('items', 'public');
        }

        $item->save();

        return redirect()->back()->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified item from storage.
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        // Delete the associated photo if it exists
        if ($item->photo) {
            Storage::disk('public')->delete($item->photo);
        }

        $item->delete();

        return redirect()->back()->with('success', 'Item deleted successfully.');
    }
}
