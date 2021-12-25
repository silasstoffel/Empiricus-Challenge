<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use Empiricus\Application\Users\Create\CreateUseCase;
use Empiricus\Application\Users\Create\CreateDTO;
use Empiricus\Application\Users\ReadAll\ReadAllUseCase;


class UserController extends Controller
{
    public function __construct(
        private CreateUseCase $createUseCase,
        private ReadAllUseCase $readAllUseCase
    ) {
    }

    public function index(): JsonResponse
    {
        $users = $this->readAllUseCase->execute();
        return $this->toJsonResponse($users);
    }

    public function show(string $id): JsonResponse
    {
        return $this->toJsonResponse(['message' => 'message']);
    }

    public function store(Request $request): JsonResponse
    {
        $user = $this->createUseCase->execute(
            CreateDTO::fromArray($request->all())
        );

        return $this->toJsonResponse($user->toArray(true), 201);
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
