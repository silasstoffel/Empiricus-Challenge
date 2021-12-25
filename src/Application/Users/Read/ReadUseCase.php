<?php

namespace Empiricus\Application\Users\Read;

use Empiricus\Domain\Users\User;
use Empiricus\Domain\Users\UserRepositoryInterface;

class ReadUseCase
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    /**
     * Find by ID
     * @param string $id
     *
     * @return ?User
     */
    public function execute(string $id): ?User
    {
        return $this->repository->find($id);
    }
}
