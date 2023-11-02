<?php

namespace App\Http\Controllers\SalesMan;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sales.food.index', [
            'foods' => Food::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sales.food.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFoodRequest $request)
    {
        $validated = $request->validated();
        $validated['restaurant_id'] = Auth::user()->restaurant->id;
        Food::create(array_filter($validated));
        return redirect()->route('sales.food.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        return view('sales.food.show', compact('food'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food)
    {
        return view('sales.food.edit', compact('food'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodRequest $request, Food $food)
    {
        $validated = $request->validated();
        $food->update(array_filter($validated));
        return redirect()->route('sales.food.edit',$food);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        $food->delete();
        return redirect()->route('sales.food.index');
    }
}
