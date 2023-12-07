<?php

namespace App\Classes;

use App\Models\Cart;
use App\Models\Food;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\RestaurantTier;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserHelper
{
    public static function getSortedRestaurantsQuery(?bool $isOpen = null, ?string $tier = null): Builder|null
    {
        $restaurants = Restaurant::all();
        if ($isOpen) {
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

    public static function getNearRestaurantsQuery(null|Collection|Builder $restaurants = null, float $radios = 10): Builder|false
    {
        if (!$restaurants) $restaurants = Restaurant::query();
        if ($restaurants instanceof Collection) $restaurants = $restaurants->toQuery();
        $userAddress = Auth::user()->current_address;
        return $restaurants->has('address')->whereRelation('address', [
            ['lang', '<=', $userAddress?->lang + $radios],
            ['lang', '>=', $userAddress?->lang - $radios],
            ['long', '<=', $userAddress?->long + $radios],
            ['long', '>=', $userAddress?->long - $radios],
        ]);
    }

    public static function createOrderForCart(Cart $cart)
    {
        $order = Order::query()->create([
            'user_id' => $cart->user_id,
            'restaurant_id' => $cart->restaurant_id,
            'address_id' => $cart->address_id,
            'total_price' => $cart->total_fee,
            'total_discount' => $cart->total_off,
            'send_cost' => $cart->restaurant->send_cost
        ]);
        $cart->food->map(function (Food $food) use ($order) {
            $order->food()->attach($food->id, ['count' => $food->pivot->count]);
        });
        $cart->food()->detach();
        return $order->refresh();
    }

    public static function cartFoodPivotUpdate(Cart $cart, int $foodId, int $count)
    {
        DB::table('cart_food')->updateOrInsert(
            ['cart_id' => $cart->id, 'food_id' => $foodId],
            ['count' => $count + $cart->food()->find($foodId)?->pivot->count]
        );
    }

    public static function afterCartUpdateCheck(Cart $cart): bool
    {
        if ($cart->food->isEmpty()) {
            $cart->delete();
            return false;
        }
        return true;
    }
}
