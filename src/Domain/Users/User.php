<?php

namespace Empiricus\Domain\Users;

class User
{
    private $roles = ['admin', 'customer', 'analist', 'crm'];
    public readonly string $role;
    public readonly string $email;
    public readonly string $name;
    public readonly string $city;
    public readonly ?string $avatarUrl;

    public function __construct(
        public readonly ?string $id,
        string $name,
        string $email,
        string $role,
        string $city,
        public readonly ?string $password,
        ?string $avatarUrl = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
    ) {
        if (!in_array($role, $this->roles)) {
            throw new \InvalidArgumentException('Argument role is not valid.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Argument email is not valid.');
        }

        if (!strlen(trim($name))) {
            throw new \InvalidArgumentException('Argument name is required.');
        }

        if (!strlen(trim($city))) {
            throw new \InvalidArgumentException('Argument city is required.');
        }

        if (strlen(trim($avatarUrl)) && !filter_var($avatarUrl, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('Avatar URL is not valid.');
        }

        $this->role      = $role;
        $this->email     = $email;
        $this->name      = $name;
        $this->city      = $city;
        $this->avatarUrl = $avatarUrl;
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
