<?php

namespace Empiricus\Application\Users\Create;

use Empiricus\Application\Users\UserDTO;
use Empiricus\Domain\Shared\PrimaryKey\PrimaryKeyCreatorInterface;
use Empiricus\Domain\Users\User;
use Empiricus\Domain\Users\UserRepositoryInterface;
use Empiricus\Infra\Shared\Password\PasswordManager;

class CreateUseCase
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private PrimaryKeyCreatorInterface $primaryKeyCreator,
        private PasswordManager $passwordManager
    ) {
    }

    public function execute(UserDTO $dto): User
    {
        $data = array_merge(
            $dto->toArray(), ['id' => $this->primaryKeyCreator->create()]
        );
        $data['password'] = $this->passwordManager->crypt($dto->password);

        return $this->repository->save(User::fromArray($data));
    }
}
