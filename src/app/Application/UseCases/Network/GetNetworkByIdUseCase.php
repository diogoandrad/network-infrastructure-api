<?php

namespace App\Application\UseCases\Network;

use App\Domain\Repositories\NetworkRepositoryInterface;

class GetNetworkByIdUseCase
{
    public function __construct(
        private NetworkRepositoryInterface $repository
    ) {}

    public function execute(string $id): ?array
    {
        return $this->repository->getById($id);
    }
}
