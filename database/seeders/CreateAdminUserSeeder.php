<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Empiricus\Infra\Shared\Password\PasswordManager;

class CreateAdminUserSeeder extends Seeder
{

    public function run()
    {
        $userId = '25c7181f-ac18-42a7-bdc5-77f8c1086f02';

        if (!User::find($userId)) {
            $passwordManager = new PasswordManager();
            $password =  $passwordManager->crypt('empiricus');

            $user = new User;
            $user->id = $userId;
            $user->name = 'Empiricus Manager';
            $user->email = 'manager@empiricus.com.br';
            $user->role = 'admin';
            $user->avatar_url = 'https://media-exp1.licdn.com/dms/image/C4E0BAQFohx9TfH3oKQ/company-logo_200_200/0/1639485203157?e=1648684800&v=beta&t=POmaJYbekbOwDqD_Vp4vVNHNNnF0SzKxjvRh9Hp1-1g';
            $user->city = 'Sao Paulo';
            $user->password_hash = $password;

            $user->save();
        }
    }
}
