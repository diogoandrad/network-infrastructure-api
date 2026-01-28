<?php

namespace App\Application\UseCases\Network;

use App\Domain\Repositories\NetworkRepositoryInterface;

class GetNetworksUseCase
{
    public function __construct(
        private NetworkRepositoryInterface $repository
    ) {}

    public function execute(): array
    {
        return $this->repository->getAll();
    }
}
