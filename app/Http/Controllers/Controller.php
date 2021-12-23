<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;

abstract class Controller extends BaseController
{
    protected function toJsonResponse(?array $data = null, int $httpCode = 200): JsonResponse
    {
        return response()->json($data, $httpCode);
    }

}
