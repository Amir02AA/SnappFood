<?php

namespace App\Http\Controllers\api;

use App\Classes\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\restaurant\RestaurantResource;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $validated = ($request->validate([
            'is_open' => ['boolean'],
            'type' => ['string', 'max:20'],
        ]));

        return response()->json([
            'restaurants' => UserHelper::getSortedRestaurants($validated['is_open'], $validated['type'])
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
