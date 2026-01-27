<?php

namespace App\Http\Controllers\Api;

use App\Application\UseCases\Device\ListDevicesUseCase;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class DeviceController extends Controller
{
    public function index(ListDevicesUseCase $useCase): JsonResponse
    {
        $devices = $useCase->execute();

        return response()->json($devices);
    }
}
