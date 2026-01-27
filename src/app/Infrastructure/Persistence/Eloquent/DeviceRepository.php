<?php

namespace App\Infrastructure\Persistence\Eloquent;

use App\Domain\Repositories\DeviceRepositoryInterface;
use App\Models\Device;

class DeviceRepository implements DeviceRepositoryInterface
{
    public function getAll(): array
    {
        return Device::query()
            ->select([
                'id',
                'name',
                'description',
                'ip_addresses',
                'mac_address',
                'device_type',
                'os',
                'status',
                'created_at',
                'updated_at',
            ])
            ->orderBy('created_at')
            ->get()
            ->toArray();
    }
}
