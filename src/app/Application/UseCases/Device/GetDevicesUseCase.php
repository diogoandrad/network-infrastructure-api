<?php

namespace App\Application\UseCases\Device;

use App\Domain\Repositories\DeviceRepositoryInterface;

class GetDevicesUseCase
{
    public function __construct(
        private DeviceRepositoryInterface $repository
    ) {}

    public function execute(): array
    {
        return $this->repository->getAll();
    }
}
