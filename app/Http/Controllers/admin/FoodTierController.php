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
            'food' => FoodTier::paginate(5)
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
        $validated = $request->validate([
            'name' => ['bail','required','string','between:4,20','unique:food_tiers']
        ]);
        FoodTier::create($validated);
        return redirect()->route('admin.food.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodTier $food)
    {
        return redirect()->route('admin.food.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodTier $food)
    {
        return view('admin.food.edit', compact('food'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FoodTier $food)
    {
        $validated = $request->validate([
            'name' => ['bail','required','string','between:4,20','unique:food_tiers']
        ]);
        $food->update($validated);
        return redirect()->route('admin.food.edit',['food' => $food]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodTier $food)
    {
        $food->delete();
        return redirect()->route('admin.food.index');
    }
}
