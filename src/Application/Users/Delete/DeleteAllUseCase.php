<?php

namespace Empiricus\Application\Users\Delete;

use Empiricus\Application\Users\UserRole;
use Empiricus\Domain\Users\UserRepositoryInterface;

class DeleteAllUseCase
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    public function execute($userIdAction): void
    {
        $role = new UserRole($this->repository);

        if (!$role->isAdmin($userIdAction)) {
            throw new \DomainException("You don't have permission to delete users.");
        }

        $this->repository->deleteAll();
    }
}
