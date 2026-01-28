<?php

namespace App\Infrastructure\Persistence\Eloquent;

use App\Domain\Repositories\NetworkRepositoryInterface;
use App\Models\Network;

class NetworkRepository implements NetworkRepositoryInterface
{
    public function getAll(): array
    {
        return Network::query()
            ->orderBy('created_at')
            ->get()
            ->toArray();
    }

    public function getById(string $id): ?array
    {
        return Network::query()
            ->where('id', $id)
            ->first()
            ?->toArray();
    }

    public function create(array $data): array
    {
        $network = Network::create($data);

        return $network->toArray();
    }

    public function update(string $id, array $data): ?array
    {
        $network = Network::find($id);

        if (!$network) return null;

        $network->update($data);

        return $network->toArray();
    }

    public function delete(string $id): bool
    {
        $network = Network::find($id);

        if (!$network) return false;

        return (bool) $network->delete();
    }
}
