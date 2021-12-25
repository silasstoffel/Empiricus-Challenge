<?php

namespace Empiricus\Domain\Users;

class User
{
    public function __construct(
        public readonly ?string $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $role,
        public readonly string $city,
        public readonly ?string $password,
        public readonly ?string $avatarUrl = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        $data = array_merge(
            [
                'id'        => '',
                'name'      => '',
                'email'     => '',
                'role'      => '',
                'avatarUrl' => '',
                'city'      => '',
                'password'  => '',
                'createdAt' => null,
                'updatedAt' => null,
            ],
            $data
        );

        return new User(
            $data['id'],
            $data['name'],
            $data['email'],
            $data['role'],
            $data['city'],
            $data['password'],
            $data['avatarUrl'],
            $data['createdAt'],
            $data['updatedAt'],
        );
    }

    public function toArray($passwordAsNull = false): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'email'     => $this->email,
            'role'      => $this->role,
            'city'      => $this->city,
            'password'  => $passwordAsNull ? null : $this->password,
            'avatarUrl' => $this->avatarUrl,
        ];
    }
}
