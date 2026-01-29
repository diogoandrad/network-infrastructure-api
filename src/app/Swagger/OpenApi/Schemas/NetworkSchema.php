<?php

namespace App\Swagger\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Network',
    type: 'object',
    properties: [
        new OA\Property(property: 'id', type: 'string', example: '01KG1RSX20ZBFM6DQF4A9G8AEZ'),
        new OA\Property(property: 'name', type: 'string', example: 'Office Network'),
        new OA\Property(property: 'description', type: 'string', example: 'Main office network'),
        new OA\Property(property: 'cidr', type: 'string', example: '198.219.150.192/22'),
        new OA\Property(property: 'location', type: 'string', example: 'Toronto'),
        new OA\Property(property: 'status', type: 'string', example: 'active'),
        new OA\Property(property: 'created_at', type: 'string', example: '2026-01-28T07:41:35.000000Z'),
        new OA\Property(property: 'updated_at', type: 'string', example: '2026-01-28T08:42:36.000000Z'),
    ]
)]
class NetworkSchema {}

#[OA\Schema(
    schema: 'CreateNetworkRequest',
    type: 'object',
    properties: [
        new OA\Property(property: 'name', type: 'string', example: 'Office Network'),
        new OA\Property(property: 'description', type: 'string', example: 'Main office network'),
        new OA\Property(property: 'cidr', type: 'string', example: '198.219.150.192/22'),
        new OA\Property(property: 'location', type: 'string', example: 'Toronto'),
        new OA\Property(property: 'status', type: 'string', example: 'active'),
    ]
)]
class CreateNetworkRequestSchema {}

#[OA\Schema(
    schema: 'UpdateNetworkRequest',
    type: 'object',
    properties: [
        new OA\Property(property: 'name', type: 'string', example: 'Office Network'),
        new OA\Property(property: 'description', type: 'string', example: 'Main office network'),
        new OA\Property(property: 'cidr', type: 'string', example: '198.219.150.192/22'),
        new OA\Property(property: 'location', type: 'string', example: 'Toronto'),
        new OA\Property(property: 'status', type: 'string', example: 'active'),
    ]
)]
class UpdateNetworkRequestSchema {}
