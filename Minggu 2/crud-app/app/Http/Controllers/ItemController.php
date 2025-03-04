<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        return view('items.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        
        //Item::create($request->all());
        //return redirect()->route('items.index');

        //Hanya masukkan atribut yang diizinkan
         Item::create($request->only(['name','description']));
        return redirect()->route('items.index')->with('success', 'Item added succesfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('items.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        //Item::update($request->all());
        //return redirect()->route('items.index');

        //Hanya masukkan atribut yang diizinkan
         $item->update($request->only(['name','description']));
        return redirect()->route('items.index')->with('success', 'Item updated succesfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //return redirect()->route('items.index');
        $item->delete();
        return redirect()->route('items.index')->with('success','Item deleted succesfully.');
    }
}
