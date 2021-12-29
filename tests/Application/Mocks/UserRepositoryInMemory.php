<?php

namespace Tests\Application\Mocks;

use Empiricus\Domain\Users\User;
use Empiricus\Domain\Users\UserRepositoryInterface;

class UserRepositoryInMemory implements UserRepositoryInterface
{
    /**
     * @var User[]
     */
    private static array $records = [];

    public function find(string $id, $showPasswordAsNull = false): ?User
    {
        $user = current(
            array_filter(self::$records, function (User $data) use ($id) {
                return $data->id === $id;
            })
        );
        return $user ? $user : null;
    }

    public function findByEmail(string $email, $showPasswordAsNull = false): ?User
    {
        $user = current(
            array_filter(self::$records, function (User $data) use ($email) {
                return $data->email === $email;
            })
        );
        return $user ? $user : null;
    }

    public function findAll($showPasswordAsNull = false): array
    {
        return self::$records;
    }

    public function save(User $user, ?string $id = null): User
    {
        if (strlen($id)) {
            foreach (self::$records as $k => $record) {
                if ($record->id === $id) {
                    self::$records[$k] = $record;
                    return $user;
                }
            }
        }
        self::$records[] = $user;
        return $user;
    }

    public function delete(string $id): void
    {
        $records = [];
        foreach (self::$records as $record) {
            if ($record->id !== $id) {
                $records[] = $record;
            }
        }
        self::$records = $records;
    }

    public function deleteAll(): void
    {
        self::$records = [];
    }
}
