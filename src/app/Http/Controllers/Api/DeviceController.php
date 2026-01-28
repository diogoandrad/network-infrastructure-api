<?php

namespace App\Http\Controllers\Api;

use App\Application\UseCases\Device\GetDevicesUseCase;
use App\Application\UseCases\Device\GetDeviceByIdUseCase;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class DeviceController extends Controller
{
    public function index(GetDevicesUseCase $useCase): JsonResponse
    {
        $devices = $useCase->execute();

        return response()->json($devices);
    }

    public function show(string $id, GetDeviceByIdUseCase $useCase): JsonResponse
    {
        $device = $useCase->execute($id);

        if (!$device)
            return response()->json(['message' => 'Device not found'], 404);

        return response()->json($device);
    }
}
