<?php

namespace App\Classes;

use App\Models\Restaurant;
use App\Models\RestaurantTier;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class UserHelper
{
    public static function getSortedRestaurantsQuery(?bool $isOpen = null, ?string $tier = null): Builder|null
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
        if ($restaurants->isEmpty()) return null;
        return $restaurants->toQuery();
    }

    public static function getNearRestaurantsQuery(null|Collection|Builder $restaurants, float $radios = 10): Builder|false
    {
        if (!$restaurants) return false;
        if ($restaurants instanceof Collection) $restaurants = $restaurants->toQuery();

        $userAddress = Auth::user()->current_address;
        return $restaurants->has('address')->whereRelation('address', [
            ['lang', '<=', $userAddress->lang + $radios],
            ['lang', '>=', $userAddress->lang - $radios],
            ['long', '<=', $userAddress->long + $radios],
            ['long', '>=', $userAddress->long - $radios],
        ]);
    }
}
