<?php

namespace App\Domain\Repositories;

interface NetworkRepositoryInterface
{
    public function getAll(): array;
    public function getById(string $id): ?array;
    public function create(array $data): array;
}
