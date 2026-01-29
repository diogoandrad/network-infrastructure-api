<?php

namespace Tests\Feature;

use App\Models\Network;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NetworkApiTest extends TestCase
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
    public function it_creates_a_network()
    {
        $response = $this->postJson('/api/networks', [
            'name' => 'Test Network',
            'description' => 'Test description',
            'cidr' => '198.219.150.192/22',
            'location' => 'Paris',
            'status' => 'active',
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'name' => 'Test Network',
                'description' => 'Test description',
                'cidr' => '198.219.150.192/22',
                'location' => 'Paris',
                'status' => 'active',
            ]);

        $this->assertDatabaseCount('networks', 1);
    }

    /** @test */
    public function name_is_required()
    {
        $response = $this->postJson('/api/networks', [
            'description' => 'No name',
            'cidr' => '198.219.150.192/22',
            'location' => 'London',
            'status' => 'inactive',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name']);
    }

    /** @test */
    public function description_can_be_null()
    {
        $response = $this->postJson('/api/networks', [
            'name' => 'Network without description',
            'description' => null,
            'cidr' => '198.219.150.192/22',
            'location' => 'Toronto',
            'status' => 'inactive',
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'description' => null,
            ]);
    }

    /** @test */
    public function it_gets_a_network_by_id()
    {
        $network = Network::factory()->create();

        $response = $this->getJson("/api/networks/{$network->id}");

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $network->id,
                'name' => $network->name,
                'description' => $network->description,
                'cidr' => $network->cidr,
                'location' => $network->location,
                'status' => $network->status,
            ]);
    }

    /** @test */
    public function it_returns_404_when_network_not_found()
    {
        $response = $this->getJson('/api/networks/01INVALIDULID');

        $response->assertStatus(404);
    }

    /** @test */
    public function it_updates_a_network()
    {
        $network = Network::factory()->create();

        $response = $this->putJson("/api/networks/{$network->id}", [
            'name' => 'Updated name',
            'description' => null,
            'cidr' => '198.219.150.192/22',
            'location' => 'Toronto',
            'status' => 'inactive',
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'Updated name',
                'description' => null,
                'cidr' => '198.219.150.192/22',
                'location' => 'Toronto',
                'status' => 'inactive',
            ]);
    }

    /** @test */
    public function it_deletes_a_network()
    {
        $network = Network::factory()->create();

        $response = $this->deleteJson("/api/networks/{$network->id}");

        $response->assertStatus(204);

        $this->assertDatabaseCount('networks', 0);
    }
}
