<?php

namespace App\Classes;

use App\Models\Restaurant;
use App\Models\RestaurantTier;

class UserHelper
{
    public static function getSortedRestaurants(?bool $isOpen = null, ?string $tier = null)
    {
        $restaurants = Restaurant::all();
        if ($isOpen !== null) {
            $restaurants = $restaurants->intersect(
                Restaurant::query()->where('is_open', $isOpen)->get()
            );
        }
        if ($tier) {
            $restaurants = $restaurants->intersect(
                RestaurantTier::query()->where('name', $tier)->first()?->restaurants
            );
        }
        return $restaurants;
    }
}
