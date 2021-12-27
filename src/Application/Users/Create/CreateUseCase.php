<?php

namespace Empiricus\Application\Users\Create;

use Empiricus\Application\Users\UserDTO;
use Empiricus\Domain\Shared\Password\PasswordManagerInterface;
use Empiricus\Domain\Shared\PrimaryKey\PrimaryKeyCreatorInterface;
use Empiricus\Domain\Users\User;
use Empiricus\Domain\Users\UserRepositoryInterface;

class CreateUseCase
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private PrimaryKeyCreatorInterface $primaryKeyCreator,
        private PasswordManagerInterface $passwordManager
    ) {
    }

    public function execute(UserDTO $dto): User
    {
        if (!strlen(trim($dto->password))) {
            throw new \InvalidArgumentException("Password is required.");
        }

        $this->checkPermission($dto);
        $this->checkUser($dto);

        $data             = array_merge(
            $dto->toArray(), ['id' => $this->primaryKeyCreator->create()]
        );
        $data['password'] = $this->passwordManager->crypt($dto->password);

        return $this->repository->save(User::fromArray($data));
    }

    private function checkPermission(UserDTO $dto): void
    {
        if (!$dto->createdUserId) {
            throw new \InvalidArgumentException("createdUserId is required.");
        }

        $user = $this->repository->find($dto->createdUserId);

        if (!$user) {
            throw new \InvalidArgumentException("Created user id defined not exists.");
        }

        if ($user->role !== 'admin') {
            throw new \DomainException("You don't have permission to create users.");
        }
    }

    private function checkUser(UserDTO $dto): void
    {
        $user = $this->repository->findByEmail($dto->email);

        if (!is_null($user)) {
            throw new \DomainException("E-mail already exists.");
        }
    }
}
