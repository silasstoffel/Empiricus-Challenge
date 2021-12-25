<?php

namespace Empiricus\Application\Users;

use Empiricus\Application\Users\Create\CreateDTO;

class UserDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $role,
        public readonly string $city,
        public readonly string $password,
        public readonly ?string $avatarUrl = null,
    ) {
    }

    public static function fromArray(array $data): UserDTO
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
            ],
            $data
        );

        return new CreateDTO(
            $data['id'],
            $data['name'],
            $data['email'],
            $data['role'],
            $data['city'],
            $data['password'],
            $data['avatarUrl']
        );
    }

    public function toArray(): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'email'     => $this->email,
            'role'      => $this->role,
            'avatarUrl' => $this->avatarUrl,
            'city'      => $this->city,
            'password'  => $this->password,
        ];
    }
}
