<?php

namespace App\Classes;

use App\Models\Material;

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
}
