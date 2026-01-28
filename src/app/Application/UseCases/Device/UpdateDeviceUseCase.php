<?php

namespace App\Application\UseCases\Device;

use App\Domain\Repositories\DeviceRepositoryInterface;

class UpdateDeviceUseCase
{
    public function __construct(
        private DeviceRepositoryInterface $repository
    ) {}

    public function execute(string $id, array $data): ?array
    {
        return $this->repository->update($id, $data);
    }
}
