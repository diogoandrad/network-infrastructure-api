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
}
