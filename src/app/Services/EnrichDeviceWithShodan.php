<?php

namespace App\Services;

use App\Models\Device;
use App\Integrations\Shodan\ShodanClient;
use App\Integrations\Shodan\ShodanMapper;

class EnrichDeviceWithShodan
{
    public function __construct(
        private ShodanClient $client
    ) {}

    public function execute(Device $device): void
    {
        foreach ($device->ip_addresses as $ip) {
            $response = $this->client->host($ip);
            // $data = ShodanMapper::map($response);

            $device->update([
                'shodan_data' => $response,
            ]);

            break;
        }
    }
}
