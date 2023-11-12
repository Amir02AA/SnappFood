<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Food::create([
            'name' => 'Peperooni',
            'price' => '250000',
            'food_tier_id' => 1,
            'restaurant_id' => 1
        ])->materials()->sync([1,2,3]);
    }
}
