<?php

namespace App\Domain\Repositories;

interface DeviceRepositoryInterface
{
    public function getAll(): array;
    public function getById(string $id): ?array;
}
