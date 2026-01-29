<?php

namespace App\Swagger\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Device',
    type: 'object',
    properties: [
        new OA\Property(property: 'id', type: 'string', example: '01KG1RSX20ZBFM6DQF4A9G8AWU'),
        new OA\Property(property: 'network_id', type: 'string', example: '01KG1RSX20ZBFM6DQF4A9G6OSM'),
        new OA\Property(property: 'name', type: 'string', example: 'Office Device'),
        new OA\Property(property: 'description', type: 'string', example: 'Main office device'),
        new OA\Property(property: 'ip_addresses', type: 'array', items: new OA\Items(type: 'string', format: 'ipv4'), example: ['218.225.86.190']),
        new OA\Property(property: 'mac_address', type: 'string', example: 'D9:FC:1C:07:B8:E8'),
        new OA\Property(property: 'device_type', type: 'string', example: 'server'),
        new OA\Property(property: 'os', type: 'string', example: 'macOS'),
        new OA\Property(property: 'status', type: 'string', example: 'online'),
        new OA\Property(property: 'created_at', type: 'string', example: '2026-01-28T07:41:35.000000Z'),
        new OA\Property(property: 'updated_at', type: 'string', example: '2026-01-28T08:42:36.000000Z'),
    ]
)]
class DeviceSchema {}

#[OA\Schema(
    schema: 'CreateDeviceRequest',
    type: 'object',
    properties: [
        new OA\Property(property: 'network_id', type: 'string', example: '01KG1RSX20ZBFM6DQF4A9G6OSM'),
        new OA\Property(property: 'name', type: 'string', example: 'Office Device'),
        new OA\Property(property: 'description', type: 'string', example: 'Main office device'),
        new OA\Property(property: 'ip_addresses', type: 'array', items: new OA\Items(type: 'string', format: 'ipv4'), example: ['218.225.86.190']),
        new OA\Property(property: 'mac_address', type: 'string', example: 'D9:FC:1C:07:B8:E8'),
        new OA\Property(property: 'device_type', type: 'string', example: 'server'),
        new OA\Property(property: 'os', type: 'string', example: 'macOS'),
        new OA\Property(property: 'status', type: 'string', example: 'online'),
    ]
)]
class CreateDeviceRequestSchema {}

#[OA\Schema(
    schema: 'UpdateDeviceRequest',
    type: 'object',
    properties: [
        new OA\Property(property: 'network_id', type: 'string', example: '01KG1RSX20ZBFM6DQF4A9G6OSM'),
        new OA\Property(property: 'name', type: 'string', example: 'Office Device'),
        new OA\Property(property: 'description', type: 'string', example: 'Main office device'),
        new OA\Property(property: 'ip_addresses', type: 'array', items: new OA\Items(type: 'string', format: 'ipv4'), example: ['218.225.86.190']),
        new OA\Property(property: 'mac_address', type: 'string', example: 'D9:FC:1C:07:B8:E8'),
        new OA\Property(property: 'device_type', type: 'string', example: 'server'),
        new OA\Property(property: 'os', type: 'string', example: 'macOS'),
        new OA\Property(property: 'status', type: 'string', example: 'online'),
    ]
)]
class UpdateDeviceRequestSchema {}
