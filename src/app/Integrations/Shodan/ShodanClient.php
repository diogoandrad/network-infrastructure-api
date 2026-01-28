<?php

namespace App\Integrations\Shodan;

use Illuminate\Support\Facades\Http;

class ShodanClient
{
    // Mock scenario
    public function host(string $ip): array
    {
        if (!config('services.shodan.enabled')) {
            return $this->fakeResponse($ip);
        }

        return Http::get(...)->throw()->json();
    }

    private function fakeResponse(string $ip): array
    {
        return [
            'ip_str' => $ip,
            'hostnames' => ['device.local'],
            'isp' => 'Fake ISP',
            'country_name' => 'Brazil',
            'city' => 'São Paulo',
            'latitude' => -23.55,
            'longitude' => -46.63,
            'ports' => [22, 80, 443],
            'last_update' => now()->subDays(2)->toIso8601String(),
        ];
    }

    // Real scenario
    // public function host(string $ip): array
    // {
    //     return Http::timeout(5)
    //         ->get(config('services.shodan.base_url') . "/shodan/host/{$ip}", [
    //             'key' => config('services.shodan.key'),
    //         ])
    //         ->throw()
    //         ->json();
    // }
}
