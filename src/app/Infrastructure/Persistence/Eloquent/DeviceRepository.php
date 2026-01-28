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
        $network = Device::create($data);

        return $network->toArray();
    }

    public function update(string $id, array $data): ?array
    {
        $network = Device::find($id);

        if (!$network) return null;

        $network->update($data);

        return $network->toArray();
    }

    public function delete(string $id): bool
    {
        $network = Device::find($id);

        if (!$network) return false;

        return (bool) $network->delete();
    }
}
