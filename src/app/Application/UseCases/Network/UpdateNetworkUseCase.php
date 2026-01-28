<?php

namespace App\Application\UseCases\Network;

use App\Domain\Repositories\NetworkRepositoryInterface;

class UpdateNetworkUseCase
{
    public function __construct(
        private NetworkRepositoryInterface $repository
    ) {}

    public function execute(string $id, array $data): ?array
    {
        return $this->repository->update($id, $data);
    }
}
