<?php

namespace Database\Factories;

use App\Models\Network;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
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
            'network_id' => Network::factory(),
            'name' => fake()->word() . '-' . fake()->numberBetween(100, 999),
            'description' => fake()->sentence(),

            'ip_addresses' => fake()->randomElements([
                fake()->ipv4(),
                fake()->ipv4(),
                fake()->ipv6(),
            ], fake()->numberBetween(1, 3)),

            'mac_address' => fake()->unique()->macAddress(),

            'device_type' => fake()->randomElement([
                'router',
                'switch',
                'server',
                'firewall',
                'other',
            ]),

            'os' => fake()->randomElement([
                'Linux',
                'Windows Server',
                'macOS',
                null,
            ]),

            'status' => fake()->randomElement(['online', 'offline']),
        ];
    }
}
