<?php

namespace Empiricus\Infra\Shared\Password;

use Empiricus\Domain\Shared\Password\PasswordManagerInterface;
use Throwable;

class PasswordManager implements PasswordManagerInterface
{
    /**
     * Crypt password
     *
     * @param string $password password
     * @return string crypt password
     */
    public function crypt(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }

    /**
     * decrypt password
     *
     * @param string $passwordDecrypt Password decrypt
     * @param string $passwordCrypt password crypt
     * @return void
     * @throws Throwable
     */
    public function verify(string $passwordDecrypt, string $passwordCrypt): void
    {
        if (password_verify($passwordDecrypt, $passwordCrypt)) {
            throw new \DomainException('Invalid password.');
        }
    }
}
