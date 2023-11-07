<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\FoodTier;
use App\Models\OffCodes;
use App\Models\RestaurantTier;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@admin',
            'phone' => '09354501122',
            'password' => 'admin', // password
            'role' => 3
        ]);
        \App\Models\User::create([
            'name' => 'Salar',
            'email' => 'salar@sales',
            'phone' => '09354501133',
            'password' => '123456', // password
            'role' => 2
        ]);

        \App\Models\User::factory(3)->create();

        RestaurantTier::insert([
            ['name' => 'Irani'],
            ['name' => 'International'],
            ['name' => 'Fast Food'],
        ]);

        FoodTier::insert([
            ['name' => 'American Pizza'],
            ['name' => 'Italian Pizza'],
            ['name' => 'Kabab'],
        ]);

        OffCodes::insert([
            ['percent' => 20, 'code' => uniqid()],
            ['percent' => 50, 'code' => uniqid()],
            ['percent' => 70, 'code' => uniqid()],
        ]);

        $this->call([
            AddressSeeder::class,
            RestaurantSeeder::class,
            FoodSeeder::class
        ]);
    }
}
