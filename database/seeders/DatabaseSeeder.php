<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CreateAdminUserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CreateAdminUserSeeder::class,
        ]);
    }
}
