<?php

namespace App\Http\Controllers\api;

use App\Classes\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\GetRestaurantsRequest;
use App\Http\Resources\restaurant\FoodResource;
use App\Http\Resources\restaurant\RestaurantResource;
use \App\Http\Resources\RestaurantResource as SingleRestaurantResource;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index(GetRestaurantsRequest $request)
    {
        $this->authorize('viewAny',Restaurant::class);
        $validated = $request->validated();
        $restaurants = UserHelper::getSortedRestaurantsQuery(@$validated['is_open'], @$validated['type']);
        $restaurants = UserHelper::getNearRestaurantsQuery($restaurants,30);
        if (!$restaurants) return \response()->json(['massage' => 'not found'],404);
        return response()->json([
            'restaurants' => RestaurantResource::collection($restaurants->get())
        ]);
    }

    public function show(Restaurant $restaurant)
    {
        return response()->json([
            'restaurant' => new SingleRestaurantResource($restaurant),
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
