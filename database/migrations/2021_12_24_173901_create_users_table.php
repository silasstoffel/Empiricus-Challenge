<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 80)->nullable(false);
            $table->string('email', 80)->nullable(false)
                ->unique('user_mail_unique');
            $table->string('role', 30)->nullable(false);
            $table->string('avatar_url')->nullable();
            $table->string('city', 80)->nullable(false);
            $table->string('password_hash')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
