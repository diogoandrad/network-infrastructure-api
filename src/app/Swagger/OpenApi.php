<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

#[OA\OpenApi(
    info: new OA\Info(
        title: 'Network Infrastructure API',
        version: '1.0.0',
        description: 'API documentation'
    ),
    tags: [
        new OA\Tag(name: 'Networks', description: 'Network management'),
        new OA\Tag(name: 'Devices', description: 'Device management'),
    ]
)]
class OpenApi {}
