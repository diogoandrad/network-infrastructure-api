<?php

namespace Tests\Feature;

use App\Models\Device;
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
        $response = $this->postJson('/api/devices', [
            'network_id': '01KG1RSX8PYXYVVFKC07Q8ZC88',
            'name' => 'Test Device',
            'description' => 'Test description',
            'ip_addresses' => ['218.225.86.190'],
            'mac_address' => 'D9:FC:1C:08:B8:E8',
            'device_type': 'switch',
            'os': 'macOS',
            'status' => 'online',
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'network_id': '01KG1RSX8PYXYVVFKC07Q8ZC88',
                'name' => 'Test Device',
                'description' => 'Test description',
                'ip_addresses' => ['218.225.86.190'],
                'mac_address' => 'D9:FC:1C:08:B8:E8',
                'device_type': 'switch',
                'os': 'macOS',
                'status' => 'online',
            ]);

        $this->assertDatabaseCount('devices', 1);
    }

    /** @test */
    public function name_is_required()
    {
        $response = $this->postJson('/api/devices', [
            'network_id': '01KG1RSX8PYXYVVFKC07Q8ZC88',
            'description' => 'No name',
            'ip_addresses' => ['218.225.86.190'],
            'mac_address' => 'D9:FC:1C:08:B8:E8',
            'device_type': 'server',
            'os': 'macOS',
            'status' => 'offline',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name']);
    }

    /** @test */
    public function description_can_be_null()
    {
        $response = $this->postJson('/api/devices', [
            'network_id': '01KG1RSX8PYXYVVFKC07Q8ZC88',
            'name' => 'Device without description',
            'description' => null,
            'ip_addresses' => ['218.225.86.190'],
            'mac_address' => 'D9:FC:1C:08:B8:E8',
            'device_type': 'server',
            'os': 'macOS',
            'status' => 'offline',
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'description' => null,
            ]);
    }

    /** @test */
    public function it_gets_a_device_by_id()
    {
        $device = Device::factory()->create();

        $response = $this->getJson("/api/devices/{$device->id}");

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $device->id,
                'network_id' => $device->network_id,
                'name' => $device->name,
                'description' => $device->description,
                'ip_addresses' => $device->ip_addresses,
                'mac_address' => $device->mac_address,
                'device_type' => $device->device_type,
                'os' => $device->os,
                'status' => $device->status,
            ]);
    }

    /** @test */
    public function it_returns_404_when_device_not_found()
    {
        $response = $this->getJson('/api/devices/01INVALIDULID');

        $response->assertStatus(404);
    }

    /** @test */
    public function it_updates_a_device()
    {
        $device = Device::factory()->create();

        $response = $this->putJson("/api/devices/{$device->id}", [
            'network_id': '01KG1RSX8PYXYVVFKC07Q8ZC88',
            'name' => 'Updated name',
            'description' => null,
            'ip_addresses' => ['218.225.86.190'],
            'mac_address' => 'D9:FC:1C:08:B8:E8',
            'device_type': 'switch',
            'os': 'macOS',
            'status' => 'offline',
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'network_id': '01KG1RSX8PYXYVVFKC07Q8ZC88',
                'name' => 'Updated name',
                'description' => null,
                'ip_addresses' => ['218.225.86.190'],
                'mac_address' => 'D9:FC:1C:08:B8:E8',
                'device_type': 'switch',
                'os': 'macOS',
                'status' => 'offline',
            ]);
    }

    /** @test */
    public function it_deletes_a_device()
    {
        $device = Device::factory()->create();

        $response = $this->deleteJson("/api/devices/{$device->id}");

        $response->assertStatus(204);

        $this->assertDatabaseCount('devices', 0);
    }
}
