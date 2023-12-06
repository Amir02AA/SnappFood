<?php

namespace App\Http\Controllers\salesman;

use App\Classes\AdminHelper;
use App\Classes\SalesHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShowFoodRequest;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Models\Food;
use App\Models\FoodTier;
use App\Models\Material;
use App\Models\OffFood;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(ShowFoodRequest $request)
    {
        $foods = SalesHelper::foodInOrder(
            $request->validated('price_filter'),
            $request->validated('tier_filter')
        )->paginate(5);

        return view('sales.food.index',compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tiers = FoodTier::all();
        $materials = Material::all();
        return view('sales.food.create', compact('tiers','materials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFoodRequest $request)
    {
        $validated = $request->validated();
        $materialIds = SalesHelper::getMaterials($validated['materials']);
        $validated['restaurant_id'] = Auth::user()->restaurant->id;
        Food::query()->create(array_filter($validated))->materials()->sync($materialIds);
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
        $tiers = FoodTier::all();
        $materials = Material::all();
        return view('sales.food.edit', compact('food', 'tiers','materials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodRequest $request, Food $food)
    {
        $validated = $request->validated();
        $percent = $validated['percent'];

        OffFood::query()->updateOrCreate(['id' => $food->off->id,], [
            'percent' => $percent,
        ]);
        $food->update($validated);
        return redirect()->route('sales.food.edit', $food);
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
