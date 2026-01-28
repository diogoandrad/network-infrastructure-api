<?php

namespace App\Domain\Entities;

class Device
{
    public function __construct(
        public readonly string $id,
        public string $network_id,
        public string $name,
        public string $description,
        public string $ip_addresses,
        public string $mac_address,
        public string $device_type,
        public string $os,
        public string $status
    ) {}

    public function offline(): void
    {
        $this->status = 'offline';
    }
}
