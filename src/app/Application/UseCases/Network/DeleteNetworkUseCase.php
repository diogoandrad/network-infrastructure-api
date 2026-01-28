<?php

namespace App\Application\UseCases\Network;

use App\Domain\Repositories\NetworkRepositoryInterface;

class DeleteNetworkUseCase
{
    public function __construct(
        private NetworkRepositoryInterface $repository
    ) {}

    public function execute(string $id): bool
    {
        return $this->repository->delete($id);
    }
}
