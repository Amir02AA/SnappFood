<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FoodTier;
use Illuminate\Http\Request;

class FoodTierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.food.index', [
            'food' => FoodTier::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.food.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([]);
        FoodTier::create($validated);
        return redirect()->route('admin.food.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodTier $foodTier)
    {
        return view('admin.food.show', compact('foodTier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodTier $foodTier)
    {
        return view('admin.food.edit', compact('foodTier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FoodTier $foodTier)
    {
        $validated = $request->validate([]);
        $foodTier->update($validated);
        return redirect()->route('admin.food.edit')->with($foodTier);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodTier $foodTier)
    {
        $foodTier->delete();
        return redirect()->route('admin.food.index');
    }
}
