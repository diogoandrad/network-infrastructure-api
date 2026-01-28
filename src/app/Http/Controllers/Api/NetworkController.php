<?php

namespace App\Http\Controllers\Api;

use App\Application\UseCases\Network\GetNetworksUseCase;
use App\Application\UseCases\Network\GetNetworkByIdUseCase;
use App\Application\UseCases\Network\CreateNetworkUseCase;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNetworkRequest;
use Illuminate\Http\JsonResponse;

class NetworkController extends Controller
{
    public function index(GetNetworksUseCase $useCase): JsonResponse
    {
        $networks = $useCase->execute();

        return response()->json($networks);
    }

    public function show(string $id, GetNetworkByIdUseCase $useCase): JsonResponse
    {
        $network = $useCase->execute($id);

        if (!$network)
            return response()->json(['message' => 'Network not found'], 404);

        return response()->json($network);
    }

    public function store(StoreNetworkRequest $request, CreateNetworkUseCase $useCase): JsonResponse
    {
        $network = $useCase->execute($request->validated());

        return response()->json($network, 201);
    }
}
