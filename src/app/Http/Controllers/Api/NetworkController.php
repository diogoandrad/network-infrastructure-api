<?php

namespace App\Http\Controllers\Api;

use App\Application\UseCases\Network\ListNetworksUseCase;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class NetworkController extends Controller
{
    public function index(ListNetworksUseCase $useCase): JsonResponse
    {
        $networks = $useCase->execute();

        return response()->json($networks);
    }
}
