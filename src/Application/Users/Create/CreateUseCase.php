<?php

namespace Empiricus\Application\Users\Create;

use Empiricus\Application\Users\UserDTO;
use Empiricus\Application\Users\UserRole;
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
        if (!$dto->userIdAction) {
            throw new \InvalidArgumentException("User (UserIdAction) is required.");
        }

        $role = new UserRole($this->repository);

        if (!$role->isAdmin($dto->userIdAction)) {
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
