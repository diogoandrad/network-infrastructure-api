<?php

namespace App\Integrations\Shodan;

class ShodanMapper
{
    public static function map(array $data): array
    {
        return [
            'hostnames' => $data['hostnames'] ?? [],
            'isp' => $data['isp'] ?? null,
            'country' => $data['country_name'] ?? null,
            'city' => $data['city'] ?? null,
            'latitude' => $data['latitude'] ?? null,
            'longitude' => $data['longitude'] ?? null,
            'open_ports' => $data['ports'] ?? [],
            'last_seen_at' => $data['last_update'] ?? null,
        ];
    }
}
