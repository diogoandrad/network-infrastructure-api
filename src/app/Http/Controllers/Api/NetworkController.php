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

use OpenApi\Attributes as OA;

class NetworkController extends Controller
{
    #[OA\Get(
        path: '/api/networks',
        tags: ['Networks'],
        summary: 'List networks',
        responses: [
            new OA\Response(
                response: 200,
                description: 'OK',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(
                        ref: '#/components/schemas/Network'
                    )
                )
            )
        ]
    )]
    public function index(GetNetworksUseCase $useCase): JsonResponse
    {
        $networks = $useCase->execute();

        return response()->json($networks);
    }

    #[OA\Get(
        path: '/api/networks/{id}',
        tags: ['Networks'],
        summary: 'Get network by id',
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
                    ref: '#/components/schemas/Network'
                )
            ),
            new OA\Response(response: 404, description: 'Not found')
        ]
    )]
    public function show(string $id, GetNetworkByIdUseCase $useCase): JsonResponse
    {
        $network = $useCase->execute($id);

        if (!$network) {
            return response()->json(['message' => 'Network not found'], 404);
        }

        return response()->json($network);
    }

    #[OA\Post(
        path: '/api/networks',
        tags: ['Networks'],
        summary: 'Create network',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: '#/components/schemas/CreateNetworkRequest'
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'OK',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Network'
                )
            ),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function store(StoreNetworkRequest $request, CreateNetworkUseCase $useCase): JsonResponse
    {
        $network = $useCase->execute($request->validated());

        return response()->json($network, 201);
    }

    #[OA\Put(
        path: '/api/networks/{id}',
        tags: ['Networks'],
        summary: 'Update network',
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
                ref: '#/components/schemas/UpdateNetworkRequest'
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'OK',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Network'
                )
            ),
            new OA\Response(response: 422, description: 'Validation error'),
            new OA\Response(response: 404, description: 'Not found')
        ]
    )]
    public function update(
        string $id,
        UpdateNetworkRequest $request,
        UpdateNetworkUseCase $useCase
    ): JsonResponse {
        $network = $useCase->execute($id, $request->validated());

        if (!$network) {
            return response()->json(['message' => 'Network not found'], 404);
        }

        return response()->json($network);
    }

    #[OA\Delete(
        path: '/api/networks/{id}',
        tags: ['Networks'],
        summary: 'Delete network',
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
    public function destroy(string $id, DeleteNetworkUseCase $useCase): JsonResponse
    {
        $deleted = $useCase->execute($id);

        if (!$deleted) {
            return response()->json(['message' => 'Network not found'], 404);
        }

        return response()->json(null, 204);
    }
}