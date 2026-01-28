<?php

namespace App\Jobs;

use App\Models\Device;
use App\Services\EnrichDeviceWithShodan;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class EnrichDeviceWithShodanJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(
        public string $deviceId
    ) {}

    public function handle(EnrichDeviceWithShodan $service): void
    {
        $device = Device::findOrFail($this->deviceId);
        $service->execute($device);
    }
}
