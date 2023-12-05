<?php

namespace App\Classes;

use App\Models\Material;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class SalesHelper
{
    public static function getMaterials(array $materials)
    {
        return array_map(function ($material) {
            return Material::query()->firstOrCreate(
                ['id' => $material], ['name' => $material])
                ->id;
        }, $materials);
    }

    public static function getSortedOrders(?int $situation = null)
    {
        $ordersQuery = Auth::user()->restaurant->orders();
        $ordersQuery = ($situation) ? $ordersQuery->where('status', $situation)
            : $ordersQuery->where('status', '!=', OrderStatus::Received);

        return $ordersQuery->get();
    }

    public static function getSortedOrdersByDate(?string $from, ?string $to, bool $isAdmin = false)
    {
        $to = $to ?? now()->addDay()->toDateString();
        $from = $from ?? Date::create(2020)->toDateString();
        $query = ($isAdmin) ? Order::query() : Auth::user()->restaurant->orders();
        $carts = $query
            ->where('status', '=', OrderStatus::Received)
            ->where('paid_date', '>=', $from)
            ->where('paid_date', '<=', $to);
        return $carts;
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



}
