<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::query()->inRandomOrder()->first();
        return [
            'name' => fake()->title,
            'address' => fake()->address(),
            'lang' => fake()->numerify('##.###'),
            'long' => fake()->numerify('##.###'),
            'vahed' => fake()->numberBetween(1,10),
            'addressable_type' => $user::class,
            'addressable_id' => $user->id
        ];
    }
}
