<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::create([
             'name' => 'admin',
             'email' => 'admin@example.com',
             'password' => '$10$VWzjF14epWIiGyW14pWvfei3x6le/VenKG6dK8NELOX4ngFq8bYRW', // admin
             'role' => 3
         ]);
    }
}
