<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Domain\Repositories\NetworkRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\NetworkRepository;

use App\Domain\Repositories\DeviceRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\DeviceRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            NetworkRepositoryInterface::class,
            NetworkRepository::class
        );

        $this->app->bind(
            DeviceRepositoryInterface::class,
            DeviceRepository::class
        );
    }
}
