<?php

namespace Database\Seeders;

use App\Models\Device;
use App\Models\Network;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Device::factory(4)->create();
        
        // Network::factory(10)->create();

        // Network::factory()->create([
        //     'id' => '01KFYTVZYD2TCY05S7MCTQG52F',
        //     'name' => 'Johns Lesch',
        //     'description' => 'Similique nihil qui accusantium',
        //     'cidr' => '210.136.138.15/16',
        //     'location' => 'Toronto',
        //     'status' => 'active',
        // ]);
    }
}
