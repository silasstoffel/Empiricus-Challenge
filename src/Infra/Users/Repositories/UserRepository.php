<?php

namespace Empiricus\Infra\Users\Repositories;

use App\Models\User as UserEloquent;
use Empiricus\Domain\Users\User;
use Empiricus\Domain\Users\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    public function find(string $id, $showPasswordAsNull = false): ?User
    {
        $user = UserEloquent::find($id);
        if ($user) {
            $password = $showPasswordAsNull ? null : $user->password_hash;
            return new User(
                $user->id,
                $user->name,
                $user->email,
                $user->role,
                $user->city,
                $password,
                $user->avatar_url,
                $user->created_at,
                $user->updated_at,
            );
        }

        return null;
    }

    public function save(User $user, ?string $id = null): User
    {
        $model     = new UserEloquent();
        $model->id = $user->id;

        if (strlen($id)) {
            $model = UserEloquent::find($id);
            if (!$model) {
                throw new \DomainException('Record not found.');
            }
        }

        $model->name       = $user->name;
        $model->email      = $user->email;
        $model->role       = $user->role;
        $model->city       = $user->city;
        $model->avatar_url = $user->avatarUrl;

        if (strlen($user->password)) {
            $model->password_hash = $user->password;
        }

        $model->save();

        $data = $this->adaptResult($model, $user->password);

        return User::fromArray($data);
    }

    /**
     * Find all users
     *
     * @param bool $showPasswordAsNull show password as null. Default false
     *
     * @return User[]
     */
    public function findAll($showPasswordAsNull = false): array
    {
        $results = [];
        $users   = UserEloquent::all();
        foreach ($users as $user) {
            $results[] = User::fromArray(
                array_merge(
                    $this->adaptResult($user, $user->password),
                    $showPasswordAsNull ? ['password' => null] : []
                )
            );
        }
        return $results;
    }

    private function adaptResult($model, string $password = null): array
    {
        $pwd = is_null($password) ? $model->password_hash : $password;
        return array_merge(
            $model->toArray(),
            [
                'password'  => $pwd, 'avatarUrl' => $model->avatar_url,
                'createdAt' => $model->created_at, 'updatedAt' => $model->updated_at,
            ]
        );
    }

    public function delete(string $id): void
    {
        $user = UserEloquent::find($id);
        if (!$user) {
            throw new \DomainException('User not found');
        }

        $user->delete();
    }

    public function findByEmail(string $email, $showPasswordAsNull = false): ?User
    {
        $user = UserEloquent::where('email', $email)->first();
        if ($user) {
            $password = $showPasswordAsNull ? null : $user->password_hash;
            return new User(
                $user->id,
                $user->name,
                $user->email,
                $user->role,
                $user->city,
                $password,
                $user->avatar_url,
                $user->created_at,
                $user->updated_at,
            );
        }

        return null;
    }
}
