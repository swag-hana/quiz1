<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\InventoryController;
use App\Models\InventoryModel;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventoryItems = InventoryModel::all();
        return view('inventory.index', compact('inventoryItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        InventoryModel::create($validated);

        return redirect(env('APP_URL') . '/inventory')

            ->with('success', 'Item added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $inventoryItem = InventoryModel::find($id);

        if (!$inventoryItem) {
            return redirect(env('APP_URL') . '/inventory')

                ->with('error', 'Item not found.');
        }

        return view('inventory.edit', compact('inventoryItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $inventoryItem = InventoryModel::find($id);

        if (!$inventoryItem) {
            return redirect(env('APP_URL') . '/inventory')
                ->with('error', 'Item not found.');
        }

        $inventoryItem->update($validated);

        return redirect(env('APP_URL') . '/inventory')
            ->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $inventoryItem = InventoryModel::find($id);

        if (!$inventoryItem){
            return redirect(env('APP_URL' . '/inventory'))
                ->with('error', 'Item not found');
        }
    }
}
