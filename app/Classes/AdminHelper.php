<?php

namespace App\Classes;

use App\Models\Food;
use Illuminate\Support\Facades\Auth;

class AdminHelper
{
    public static function foodInOrder(string $priceOrder = 'asc', int $tier = null, int $paginate = 5)
    {
        $restaurantId = Auth::user()->restaurant->id;

        return (!$tier) ?
            Food::query()->where(['restaurant_id' => $restaurantId, 'food_tier_id' => $tier])
                ->orderBy('price', $priceOrder)->paginate($paginate)
            :Food::query()->where('restaurant_id',$restaurantId)
                ->orderBy('price',$priceOrder)->paginate($paginate);
    }
}
