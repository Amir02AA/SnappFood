<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurantSib = Restaurant::create([
            'name' => 'sib 360',
            'phone' => '021222222',
            'account' => '225564488',
            'user_id' => 2,
            'send_cost' => 10000
        ]);
        $restaurantSib->address()->create([
            'name' => 'sib360',
            'address' => fake()->address(),
            'lang' => fake()->numerify('##.###'),
            'long' => fake()->numerify('##.###'),
        ]);

        $restaurantSib->tiers()->sync([1, 2]);

        $restaurantShila = Restaurant::create([
            'name' => 'Shila',
            'phone' => '021222223',
            'account' => '225564487',
            'user_id' => 3,
            'send_cost' => 20000

        ]);
        $restaurantShila->address()->create([
            'name' => 'Shila',
            'address' => fake()->address(),
            'lang' => fake()->numerify('##.###'),
            'long' => fake()->numerify('##.###'),
        ]);
        $restaurantShila->tiers()->sync([3]);
    }
}
