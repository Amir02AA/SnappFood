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
        Restaurant::create([
            'name' => 'sib 360',
            'phone' => '021222222',
            'account' => '225564488',
            'user_id' => 2,
        ])->address()->create([
            'name' => 'sib360 address',
            'address' => fake()->address(),
            'lang' => fake()->numerify('##.###'),
            'long' => fake()->numerify('##.###'),
        ]);
    }
}
