<?php

namespace App\Http\Controllers\api;

use App\Classes\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\GetRestaurantsRequest;
use App\Http\Resources\restaurant\FoodResource;
use App\Http\Resources\restaurant\RestaurantResource;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(GetRestaurantsRequest $request)
    {
        $validated = $request->validated();
        $restaurants = UserHelper::getSortedRestaurants(@$validated['is_open'], @$validated['type']);
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
        $food = FoodResource::collection($restaurant->food)->collection
            ->groupBy(function (FoodResource $item) {
                return $item->foodTier->name;
            });

        return response()->json([
            'food' => $food
        ]);
    }
}
