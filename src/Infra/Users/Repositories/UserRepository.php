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

        $data = array_merge(
            $model->toArray(),
            ['password' => $user->password, 'avatarUrl' => $model->avatar_url]
        );

        return User::fromArray($data);
    }
}
