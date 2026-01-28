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

    public function create(array $data): array
    {
        $device = Device::create($data);

        return $device->toArray();
    }

    public function update(string $id, array $data): ?array
    {
        $device = Device::find($id);

        if (!$device) return null;

        $device->update($data);

        return $device->toArray();
    }

    public function delete(string $id): bool
    {
        $device = Device::find($id);

        if (!$device) return false;

        return (bool) $device->delete();
    }
}
