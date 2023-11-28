<?php

namespace App\Classes;

use App\Models\Cart;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class SalesHelper
{
    public static function getMaterials(array $materials)
    {
        return array_map(function ($material) {
            return Material::query()->firstOrCreate([
                'id' => $material
            ], [
                'name' => $material
            ])->id;
        }, $materials);
    }

    public static function getSortedOrders(?int $situation = null)
    {
        if ($situation) {
            $carts = Auth::user()->restaurant->carts()->where([
                ['status', '=', $situation],
                ['paid_date', '!=', null]
            ]);
        } else {
            $carts = Auth::user()->restaurant->carts()->where([
                ['status', '!=', OrderStatus::Received],
                ['paid_date', '!=', null]
            ]);
        }
        return $carts->get();
    }

    public static function getSortedOrdersByDate($from, $to, bool $isAdmin = false)
    {
        $to = $to ?? now()->toDateString();
        $from = $from ?? Date::create(2020)->toDateString();
        $query = ($isAdmin) ? Cart::query() : Auth::user()->restaurant->carts();
        $carts = $query
            ->where('status', '=', OrderStatus::Received)
            ->where('paid_date', '>=', $from)
            ->where('paid_date', '<=', $to);
        return $carts;
    }
}
