<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\restaurant\RestaurantResource;
use App\Models\Food;
use App\Models\Restaurant;
use App\Models\RestaurantTier;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $restaurants = Restaurant::all();
        $validated = ($request->validate([
            'is_open' => ['boolean'],
            'type' => ['string'],
        ]));
        if (isset($validated['is_open'])) {
            $restaurants =
                Restaurant::query()->where('is_open', $validated['is_open'])->get();

        }
        if (isset($validated['type'])) {
            $restaurants =
                RestaurantTier::query()->where('name', $validated['type'])->first()->restaurants;

        }

        return response()->json([
            'restaurants' => RestaurantResource::collection($restaurants)
        ]);
    }

    public function show(Restaurant $restaurant)
    {
        return response()->json([
            'restaurant' => new RestaurantResource($restaurant)
        ]);
    }

    public function food(Restaurant $restaurant)
    {
        $food = $restaurant->food()->get()->groupBy(function (Food $item) {
            return $item->foodTier->name;
        })->toArray();
        return response()->json([
            'food' => $food
        ]);
    }
}
