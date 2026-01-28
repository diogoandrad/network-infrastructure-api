<?php

namespace App\Http\Controllers\Api;

use App\Application\UseCases\Device\GetDevicesUseCase;
use App\Application\UseCases\Device\GetDeviceByIdUseCase;
use App\Application\UseCases\Device\CreateDeviceUseCase;
use App\Application\UseCases\Device\UpdateDeviceUseCase;
use App\Application\UseCases\Device\DeleteDeviceUseCase;

use App\Http\Requests\Device\StoreDeviceRequest;
use App\Http\Requests\Device\UpdateDeviceRequest;

use App\Http\Controllers\Controller;
use App\Jobs\EnrichDeviceWithShodanJob;
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

    public function store(StoreDeviceRequest $request, CreateDeviceUseCase $useCase): JsonResponse
    {
        $device = $useCase->execute($request->validated());

        EnrichDeviceWithShodanJob::dispatch($device['id']);

        return response()->json($device, 201);
    }

    public function update(string $id, UpdateDeviceRequest $request, UpdateDeviceUseCase $useCase): JsonResponse
    {
        $device = $useCase->execute($id, $request->validated());

        if (!$device)
            return response()->json(['message' => 'Device not found'], 404);

        return response()->json($device);
    }

    public function destroy(string $id, DeleteDeviceUseCase $useCase): JsonResponse
    {
        $deleted = $useCase->execute($id);

        if (!$deleted)
            return response()->json(['message' => 'Device not found'], 404);

        return response()->json(null, 204);
    }
}
