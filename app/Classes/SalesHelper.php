<?php

namespace App\Classes;

use App\Models\Food;
use App\Models\Material;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class SalesHelper
{
    public static function getMaterialIds(array $materials)
    {
        return array_map(function ($material) {
            return Material::query()->firstOrCreate(
                ['id' => $material], ['name' => $material])
                ->id;
        }, $materials);
    }

    public static function getSortedOrders(?int $situation = null)
    {
        $query = Auth::user()->restaurant->orders();
        $query = ($situation) ? $query->where('status', $situation)
            : $query->where('status', '!=', OrderStatus::Received);

        return $query->get();
    }

    public static function getSortedOrdersByDate(?string $from, ?string $to, bool $isAdmin = false)
    {
        $to = $to ?? now()->addDay()->toDateString();
        $from = $from ?? Date::create(2020)->toDateString();
        $query = ($isAdmin) ? Order::query() : Auth::user()->restaurant->orders();
        $orders = $query
            ->where('status', '=', OrderStatus::Received)
            ->where('paid_date', '>=', $from)
            ->where('paid_date', '<=', $to);
        return $orders;
    }

    public static function manageDayTimeUpdating(string $openTime , string $closeTime , string $days)
    {
        $query = Auth::user()->restaurant->schedules();
        $query = match ($days){
            'all' => $query,
            'not_friday' => $query->where('day','!=','7'),
            default => $query->where('day',$days)
        };
        $query->update([
            'start_time' => $openTime,
            'end_time' => $closeTime
        ]);
    }

    public static function manageDayTimeClosing(string $day)
    {
        $query = Auth::user()->restaurant->schedules();
        $query->where('day',$day)->update([
            'start_time' => null,
            'end_time' => null
        ]);
    }

    public static function foodInOrder(string $priceOrder = 'asc', int $tier = null)
    {
        $restaurantId = Auth::user()->restaurant->id;
        $query = Auth::user()->restaurant->food();
        return ($tier) ?
            $query->where('food_tier_id' , $tier)->orderBy('price', $priceOrder)
            :$query->orderBy('price',$priceOrder);
    }
}
