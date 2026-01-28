<?php

namespace App\Application\UseCases\Device;

use App\Domain\Repositories\DeviceRepositoryInterface;

class GetDeviceByIdUseCase
{
    public function __construct(
        private DeviceRepositoryInterface $repository
    ) {}

    public function execute(string $id): ?array
    {
        return $this->repository->getById($id);
    }
}
