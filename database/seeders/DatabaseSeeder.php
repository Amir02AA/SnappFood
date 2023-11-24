<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\FoodTier;
use App\Models\OffCode;
use App\Models\RestaurantTier;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
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

        OffCode::insert([
            ['percent' => 20, 'code' => uniqid()],
            ['percent' => 50, 'code' => uniqid()],
            ['percent' => 70, 'code' => uniqid()],
        ]);

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            AddressSeeder::class,
            RestaurantSeeder::class,
            MaterialSeeder::class,
            FoodSeeder::class,
        ]);
    }
}
