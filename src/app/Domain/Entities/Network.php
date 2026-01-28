<?php

namespace App\Domain\Entities;

class Network
{
    public function __construct(
        public readonly string $id,
        public string $name,
        public string $description,
        public string $cidr,
        public string $location,
        public string $status
    ) {}

    public function inactivate(): void
    {
        $this->status = 'inactive';
    }
}
