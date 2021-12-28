<?php

namespace Empiricus\Application\Users\Update;

use Empiricus\Application\Users\UserDTO;
use Empiricus\Application\Users\UserRole;
use Empiricus\Domain\Shared\Password\PasswordManagerInterface;
use Empiricus\Domain\Users\User;
use Empiricus\Domain\Users\UserRepositoryInterface;

class UpdateUseCase
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private PasswordManagerInterface $passwordManager
    ) {
    }

    public function execute(UserDTO $user): void
    {
        $this->checkPermission($user);
        $this->checkUser($user);

        $data = $user->toArray();

        if (isset($data['password']) && strlen($data['password'])) {
            $data['password'] = $this->passwordManager->crypt($data['password']);
        }

        $this->repository->save(User::fromArray($data), $data['id']);
    }

    private function checkPermission(UserDTO $dto): void
    {
        if (!strlen(trim($dto->userIdAction))) {
            throw new \InvalidArgumentException("User (userIdAction) is required.");
        }

        $role = new UserRole($this->repository);

        if (!$role->isAdmin($dto->userIdAction)) {
            throw new \DomainException("You don't have permission to update users.");
        }
    }

    private function checkUser(UserDTO $dto): void
    {
        $user = $this->repository->findByEmail($dto->email);

        if (!is_null($user) && $user->id !== $dto->id) {
            throw new \DomainException("E-mail already exists.");
        }
    }

}
