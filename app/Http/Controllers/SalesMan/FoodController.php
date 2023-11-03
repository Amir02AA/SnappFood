<?php

namespace App\Http\Controllers\SalesMan;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Models\Food;
use App\Models\FoodTier;
use App\Models\OffFood;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $priceFilter = request('price_filter') ?? 'asc';
        $tierId = request('tier_filter') ?? 0;
        $restaurantId = Auth::user()->restaurant->id;

        return ($tierId != 0) ?
            view('sales.food.index', [
                'foods' => Food::query()->where([
                    'restaurant_id' => $restaurantId ,
                    'food_tier_id' => $tierId
                ])
                    ->orderBy('price',$priceFilter)->paginate(5)
            ])
            :view('sales.food.index', [
                'foods' => Food::query()->where('restaurant_id',$restaurantId)
                    ->orderBy('price',$priceFilter)->paginate(5)
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tiers = FoodTier::all();
        return view('sales.food.create', compact('tiers'));
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
        $tiers = FoodTier::all();
        return view('sales.food.edit', compact('food', 'tiers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodRequest $request, Food $food)
    {
        $validated = $request->validated();
        $percent = $validated['percent'] ?? 0;
        unset($validated['percent']);

        OffFood::query()->updateOrCreate([
            'id' => $food->off->id ,
        ],[
            'percent' => $percent,
        ]);
        $food->update(array_filter($validated));
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
