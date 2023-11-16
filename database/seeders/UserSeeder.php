<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin',
            'phone' => '09354501122',
            'password' => '$2y$10$N/.nrZh5JmIE0c/LvL33I.0BO9Eo/Nk7tWTpkG7mZr7rBqwRXQPO6', // admin
        ])->assignRole('admin');

        User::create([
            'name' => 'Salar',
            'email' => 'salar@sales',
            'phone' => '09354501133',
            'password' => '123456', // password
        ])->assignRole('sales');

        User::create([
            'name' => 'Salar2',
            'email' => 'salar2@sales',
            'phone' => '09354501123',
            'password' => '123456'
        ])->assignRole('sales');

        User::factory(3)->create()->transform(function (User $user){
            $user->assignRole('customer');
        });
    }
}
