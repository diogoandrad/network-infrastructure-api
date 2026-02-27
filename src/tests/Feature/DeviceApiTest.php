<?php

namespace Tests\Feature;

use App\Models\Device;
use App\Models\Network;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeviceApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withHeaders([
            'Accept' => 'application/json',
        ]);
    }

    /** @test */
    public function it_creates_a_device()
    {
        // Arrange
        $network = Network::factory()->create();

        $deviceData = Device::factory()->make([
            'network_id' => $network->id,
        ])->toArray();

        // Act
        $response = $this->postJson('/api/devices', $deviceData);

        // Assert
        $response->assertStatus(201);
    }

    /** @test */
    public function name_is_required()
    {
        // Arrange
        $network = Network::factory()->create();

        $deviceData = Device::factory()->make([
            'network_id' => $network->id,
        ])->toArray();

        unset($deviceData['name']);

        // Act
        $response = $this->postJson('/api/devices', $deviceData);

        // Assert
        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name']);
    }

    /** @test */
    public function description_can_be_null()
    {
        // Arrange
        $network = Network::factory()->create();

        $deviceData = Device::factory()->make([
            'network_id' => $network->id,
            'description' => null,
        ])->toArray();

        // Act
        $response = $this->postJson('/api/devices', $deviceData);

        // Assert
        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'description' => null,
            ]);

        $this->assertDatabaseHas('devices', [
            'id' => $response->json('id'),
            'description' => null,
        ]);
    }

    /** @test */
    public function it_gets_a_device_by_id()
    {
        // Arrange
        $network = Network::factory()->create();

        $device = Device::factory()->create([
            'network_id' => $network->id,
        ]);

        // Act
        $response = $this->getJson("/api/devices/{$device->id}");

        // Assert
        $response
            ->assertOk()
            ->assertJson([
                'data' => [
                    'id' => $device->id,
                    'network_id' => $device->network_id,
                    'name' => $device->name,
                    'description' => $device->description,
                    'ip_addresses' => $device->ip_addresses,
                    'mac_address' => $device->mac_address,
                    'device_type' => $device->device_type,
                    'os' => $device->os,
                    'status' => $device->status,
                ]
            ]);
    }

    /** @test */
    public function it_returns_404_when_device_not_found()
    {
        // Act
        $response = $this->getJson('/api/devices/01INVALIDULID');

        // Assert
        $response->assertStatus(404);
    }

    /** @test */
    public function it_updates_a_device()
    {
        // Arrange
        $network = Network::factory()->create();

        $device = Device::factory()->create([
            'network_id' => $network->id,
        ]);

        $updateData = Device::factory()->make([
            'network_id' => $network->id,
            'name' => 'Updated name',
            'description' => null,
            'device_type' => 'switch',
            'status' => 'offline',
        ])->toArray();

        // Act
        $response = $this->putJson("/api/devices/{$device->id}", $updateData);

        // Assert
        $response
            ->assertOk()
            ->assertJson([
                'data' => [
                    'id' => $device->id,
                    'name' => 'Updated name',
                    'description' => null,
                    'device_type' => 'switch',
                    'status' => 'offline',
                ]
            ]);

        $this->assertDatabaseHas('devices', [
            'id' => $device->id,
            'name' => 'Updated name',
            'description' => null,
            'device_type' => 'switch',
            'status' => 'offline',
        ]);
    }

    /** @test */
    public function it_returns_404_when_updating_non_existing_device()
    {
        // Act
        $response = $this->putJson('/api/devices/01INVALIDULID', [
            'name' => 'Test'
        ]);

        // Assert
        $response->assertNotFound();
    }

    /** @test */
    public function it_deletes_a_device()
    {
        // Arrange
        $device = Device::factory()->create();

        // Act
        $response = $this->deleteJson("/api/devices/{$device->id}");

        // Assert
        $response->assertStatus(204);
    }
}
