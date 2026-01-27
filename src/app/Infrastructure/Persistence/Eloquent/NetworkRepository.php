<?php

namespace App\Infrastructure\Persistence\Eloquent;

use App\Domain\Repositories\NetworkRepositoryInterface;
use App\Models\Network;

class NetworkRepository implements NetworkRepositoryInterface
{
    public function getAll(): array
    {
        return Network::query()
            ->select([
                'id',
                'name',
                'description',
                'cidr',
                'location',
                'status',
                'created_at',
                'updated_at',
            ])
            ->orderBy('created_at')
            ->get()
            ->toArray();
    }
}
