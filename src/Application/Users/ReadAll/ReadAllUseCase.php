<?php

namespace Empiricus\Application\Users\ReadAll;

use Empiricus\Domain\Users\User;
use Empiricus\Domain\Users\UserRepositoryInterface;

class ReadAllUseCase
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    /**
     * Find all users
     * @return User[]
     */
    public function execute($showPasspordAsNull = true): array
    {
        return $this->repository->findAll($showPasspordAsNull);
    }
}
