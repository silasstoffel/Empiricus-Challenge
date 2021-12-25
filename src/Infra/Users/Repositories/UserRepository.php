<?php

namespace Empiricus\Infra\Users\Repositories;

use App\Models\User as UserEloquent;
use Empiricus\Domain\Users\User;
use Empiricus\Domain\Users\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    public function find(string $id): ?User
    {
        $user = UserEloquent::find($id);
        if ($user) {
            return new User(
                $user->id,
                $user->name,
                $user->email,
                $user->role,
                $user->city,
                $user->password_hash,
                $user->avatar_url,
                $user->created_at,
                $user->updated_at,
            );
        }

        return null;
    }

    public function save(User $user, ?string $id = null): User
    {
        $model = new UserEloquent();
        $model->id = $user->id;

        if (strlen($id)) {
            $model = UserEloquent::find($id);
            if (!$model) {
                throw new \DomainException('Record not found.');
            }
        }

        $model->name          = $user->name;
        $model->email         = $user->email;
        $model->role          = $user->role;
        $model->city          = $user->city;
        $model->avatar_url    = $user->avatarUrl;

        if (strlen($user->password)) {
            $model->password_hash = $user->password;
        }

        $model->save();

        $data = $this->adaptResult($model, $user->password);

        return User::fromArray($data);
    }

    /**
     * Find all users
     * @return User[]
     */
    public function findAll(): array
    {
        $results = [];
        $users = UserEloquent::all();
        foreach ($users as $user) {
            $results[] = User::fromArray($this->adaptResult($user, $user->password));
        }
        return $results;
    }

    private function adaptResult($model, string $password = null): array
    {
        $pwd = is_null($password) ? $model->password_hash : $password;
        return array_merge(
            $model->toArray(),
            ['password' => $pwd, 'avatarUrl' => $model->avatar_url]
        );
    }
}
