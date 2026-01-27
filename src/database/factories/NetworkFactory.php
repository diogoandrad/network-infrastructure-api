<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Network>
 */
class NetworkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => (string) Str::ulid(),
            'name' => fake()->company(),
            'description' => fake()->sentence(),
            'cidr' => fake()->ipv4() . '/' . fake()->numberBetween(16, 30),
            'location' => fake()->city(),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
