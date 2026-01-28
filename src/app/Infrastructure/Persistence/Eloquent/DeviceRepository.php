<?php

namespace App\Infrastructure\Persistence\Eloquent;

use App\Domain\Repositories\DeviceRepositoryInterface;
use App\Models\Device;

class DeviceRepository implements DeviceRepositoryInterface
{
    public function getAll(): array
    {
        return Device::query()
            ->orderBy('created_at')
            ->get()
            ->toArray();
    }

    public function getById(string $id): ?array
    {
        return Device::query()
            ->where('id', $id)
            ->first()
            ?->toArray();
    }
}
