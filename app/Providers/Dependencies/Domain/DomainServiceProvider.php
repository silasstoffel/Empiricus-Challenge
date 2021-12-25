<?php

declare(strict_types=1);

namespace App\Providers\Dependencies\Domain;

use Empiricus\Domain\Shared\Password\PasswordManagerInterface;
use Empiricus\Domain\Shared\PrimaryKey\PrimaryKeyCreatorInterface;
use Empiricus\Domain\Users\UserRepositoryInterface;
use Empiricus\Infra\Shared\Password\PasswordManager;
use Empiricus\Infra\Shared\PrimaryKey\UUIDCreator;
use Empiricus\Infra\Users\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

final class DomainServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->repositories();
        $this->common();
    }

    public function repositories(): void
    {
        $this->app->bind(UserRepositoryInterface::class, fn() => new UserRepository());
    }

    public function common(): void
    {
        $this->app->bind(
            PrimaryKeyCreatorInterface::class, fn() => new UUIDCreator()
        );

        $this->app->bind(
            PasswordManagerInterface::class, fn() => new PasswordManager()
        );
    }
}
