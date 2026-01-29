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

use OpenApi\Attributes as OA;

class DeviceController extends Controller
{
    #[OA\Get(
        path: '/api/devices',
        tags: ['Devices'],
        summary: 'List devices',
        responses: [
            new OA\Response(
                response: 200,
                description: 'OK',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(
                        ref: '#/components/schemas/Device'
                    )
                )
            )
        ]
    )]
    public function index(GetDevicesUseCase $useCase): JsonResponse
    {
        $devices = $useCase->execute();

        return response()->json($devices);
    }

    #[OA\Get(
        path: '/api/devices/{id}',
        tags: ['Devices'],
        summary: 'Get device by id',
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'string')
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'OK',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Device'
                )
            ),
            new OA\Response(response: 404, description: 'Not found')
        ]
    )]
    public function show(string $id, GetDeviceByIdUseCase $useCase): JsonResponse
    {
        $device = $useCase->execute($id);

        if (!$device) {
            return response()->json(['message' => 'Device not found'], 404);
        }

        return response()->json($device);
    }

    #[OA\Post(
        path: '/api/devices',
        tags: ['Devices'],
        summary: 'Create device',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: '#/components/schemas/CreateDeviceRequest'
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'OK',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Device'
                )
            ),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function store(StoreDeviceRequest $request, CreateDeviceUseCase $useCase): JsonResponse
    {
        $device = $useCase->execute($request->validated());

        EnrichDeviceWithShodanJob::dispatch($device['id']);

        return response()->json($device, 201);
    }

    #[OA\Put(
        path: '/api/devices/{id}',
        tags: ['Devices'],
        summary: 'Update device',
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'string')
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: '#/components/schemas/UpdateDeviceRequest'
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'OK',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Device'
                )
            ),
            new OA\Response(response: 422, description: 'Validation error'),
            new OA\Response(response: 404, description: 'Not found')
        ]
    )]
    public function update(
        string $id,
        UpdateDeviceRequest $request,
        UpdateDeviceUseCase $useCase
    ): JsonResponse {
        $device = $useCase->execute($id, $request->validated());

        if (!$device) {
            return response()->json(['message' => 'Device not found'], 404);
        }

        return response()->json($device);
    }

    #[OA\Delete(
        path: '/api/devices/{id}',
        tags: ['Devices'],
        summary: 'Delete device',
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'string')
            )
        ],
        responses: [
            new OA\Response(response: 204, description: 'No content'),
            new OA\Response(response: 404, description: 'Not found')
        ]
    )]
    public function destroy(string $id, DeleteDeviceUseCase $useCase): JsonResponse
    {
        $deleted = $useCase->execute($id);

        if (!$deleted) {
            return response()->json(['message' => 'Device not found'], 404);
        }

        return response()->json(null, 204);
    }
}
