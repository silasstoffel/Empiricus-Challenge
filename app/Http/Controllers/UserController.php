<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        return $this->toJsonResponse(['message' => 'message']);
    }

    public function show(string $id): JsonResponse
    {
        return $this->toJsonResponse(['message' => 'message']);
    }

    public function store(): JsonResponse
    {
        return $this->toJsonResponse([], 201);
    }

    public function update(string $id): JsonResponse
    {
        return $this->toJsonResponse(null, 204);
    }

    public function delete(string $id): JsonResponse
    {
        return $this->toJsonResponse(null, 204);
    }

}
