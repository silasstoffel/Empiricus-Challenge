<?php

namespace Empiricus\Domain\Users;

interface UserRepositoryInterface
{
    public function find(string $id, $showPasswordAsNull = false): ?User;

    public function findAll($showPasswordAsNull = false): array;

    public function save(User $user, ?string $id = null): User;

    public function delete(string $id): void;
}
