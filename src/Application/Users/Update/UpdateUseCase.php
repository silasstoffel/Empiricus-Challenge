<?php

namespace Empiricus\Application\Users\Update;

use Empiricus\Application\Users\UserDTO;
use Empiricus\Domain\Users\User;
use Empiricus\Domain\Users\UserRepositoryInterface;
use Empiricus\Infra\Shared\Password\PasswordManager;

class UpdateUseCase
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private PasswordManager $passwordManager
    ) {
    }

    public function execute(UserDTO $user): void
    {
        $data = $user->toArray();

        if (isset($data['password']) && strlen($data['password'])) {
            $data['password'] = $this->passwordManager->crypt($data['password']);
        }

        $this->repository->save(User::fromArray($data), $data['id']);
    }
}
