<?php

namespace Empiricus\Application\Users\Delete;

use Empiricus\Domain\Users\UserRepositoryInterface;

class DeleteUseCase
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    public function execute(string $id): void
    {
        $this->repository->delete($id);
    }
}
