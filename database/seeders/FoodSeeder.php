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

        Food::create([
            'name' => 'Beef gorme',
            'price' => '300000',
            'food_tier_id' => 1,
            'restaurant_id' => 1
        ])->materials()->sync([1,2]);

        Food::create([
            'name' => 'sezar salad',
            'price' => '150000',
            'food_tier_id' => 3,
            'restaurant_id' => 2
        ])->materials()->sync([1,3]);

        Food::create([
            'name' => 'greek salad',
            'price' => '200000',
            'food_tier_id' => 3,
            'restaurant_id' => 2
        ])->materials()->sync([2,3]);
    }
}
