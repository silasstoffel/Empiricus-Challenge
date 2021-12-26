<?php

namespace App\Http\Controllers;

use Empiricus\Application\Users\UserDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use Empiricus\Application\Users\Create\CreateUseCase;
use Empiricus\Application\Users\ReadAll\ReadAllUseCase;
use Empiricus\Application\Users\Delete\DeleteUseCase;
use Empiricus\Application\Users\Read\ReadUseCase;
use Empiricus\Application\Users\Update\UpdateUseCase;


class UserController extends Controller
{
    public function __construct(
        private CreateUseCase $createUseCase,
        private ReadAllUseCase $readAllUseCase,
        private ReadUseCase $readUseCase,
        private DeleteUseCase $deleteUseCase,
        private UpdateUseCase $updateUseCase
    ) {
    }

    public function index(): JsonResponse
    {
        $users = $this->readAllUseCase->execute(true);
        return $this->toJsonResponse($users);
    }

    public function show(string $id): JsonResponse
    {
        $user = $this->readUseCase->execute($id);

        if (is_null($user)) {
            return $this->toJsonResponse(null, 404);
        }

        return $this->toJsonResponse($user->toArray(true));
    }

    public function store(Request $request): JsonResponse
    {
        $user = $this->createUseCase->execute(
            UserDTO::fromArray($request->all())
        );

        return $this->toJsonResponse($user->toArray(true), 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $request['id'] = $id;
        $this->updateUseCase->execute(
            UserDTO::fromArray($request->all())
        );

        return $this->toJsonResponse(null, 204);
    }

    public function delete(string $id): JsonResponse
    {
        $this->deleteUseCase->execute($id);
        return $this->toJsonResponse(null, 204);
    }
}
