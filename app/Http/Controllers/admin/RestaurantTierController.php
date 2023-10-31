<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\RestaurantTier;
use Illuminate\Http\Request;

class RestaurantTierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.restaurant.index', [
            'restaurant' => RestaurantTier::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.restaurant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([]);
        RestaurantTier::create($validated);
        return redirect()->route('admin.restaurant.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(RestaurantTier $restaurantTier)
    {
        return view('admin.restaurant.show', compact('restaurantTier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RestaurantTier $restaurantTier)
    {
        return view('admin.restaurant.edit', compact('restaurantTier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RestaurantTier $restaurantTier)
    {
        $validated = $request->validate([]);
        $restaurantTier->update($validated);
        return redirect()->route('admin.restaurant.edit')->with($restaurantTier);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RestaurantTier $restaurantTier)
    {
        $restaurantTier->delete();
        return redirect()->route('admin.restaurant.index');
    }
}
