<?php

namespace App\Application\UseCases\Network;

use App\Domain\Repositories\NetworkRepositoryInterface;

class CreateNetworkUseCase
{
    public function __construct(
        private NetworkRepositoryInterface $repository
    ) {}

    public function execute(array $data): array
    {
        return $this->repository->create($data);
    }
}
