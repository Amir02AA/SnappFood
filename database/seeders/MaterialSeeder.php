<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Material::create(['name' => 'rice']);
        Material::create(['name' => 'chicken']);
        Material::create(['name' => 'beef']);
        Material::create(['name' => 'cheese']);
        Material::create(['name' => 'pepper']);
    }
}
