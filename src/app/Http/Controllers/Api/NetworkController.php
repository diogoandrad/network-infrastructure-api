<?php

namespace App\Http\Controllers\Api;

use App\Application\UseCases\Network\GetNetworksUseCase;
use App\Application\UseCases\Network\GetNetworkByIdUseCase;
use App\Application\UseCases\Network\CreateNetworkUseCase;
use App\Application\UseCases\Network\UpdateNetworkUseCase;
use App\Application\UseCases\Network\DeleteNetworkUseCase;

use App\Http\Requests\Network\StoreNetworkRequest;
use App\Http\Requests\Network\UpdateNetworkRequest;

use App\Http\Controllers\Controller;
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

    public function update(string $id, UpdateNetworkRequest $request, UpdateNetworkUseCase $useCase): JsonResponse
    {
        $network = $useCase->execute($id, $request->validated());

        if (!$network)
            return response()->json(['message' => 'Network not found'], 404);

        return response()->json($network);
    }

    public function destroy(string $id, DeleteNetworkUseCase $useCase): JsonResponse
    {
        $deleted = $useCase->execute($id);

        if (!$deleted)
            return response()->json(['message' => 'Network not found'], 404);

        return response()->json(null, 204);
    }
}
