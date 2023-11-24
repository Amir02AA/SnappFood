<?php

namespace App\Classes;

use App\Models\Material;
use Illuminate\Support\Facades\Auth;

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
        if ($situation) {$carts = Auth::user()->restaurant->carts()->where([
            ['status', '=', $situation],
            ['paid_date', '!=', null]
        ]);
        } else{
            $carts = Auth::user()->restaurant->carts()->where([
                ['status', '!=', OrderStatus::Received],
                ['paid_date', '!=', null]
            ]);
        }
        return $carts->get();

    }
}
