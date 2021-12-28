<?php

namespace Empiricus\Application\Users;

use Empiricus\Domain\Users\UserRepositoryInterface;

class UserRole
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    public function isAdmin(string $userId): bool
    {
        if (!strlen(trim($userId))) {
            throw new \InvalidArgumentException("User (userIdAction) is required.");
        }

        $user = $this->repository->find($userId);

        if ($user && $user->role === 'admin') {
            return true;
        }

        return false;
    }
}
