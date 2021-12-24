<?php

namespace Empiricus\Domain\Shared\Password;

interface PasswordManagerInterface
{
    /**
     * Crypt password
     *
     * @param string $password uncrypt password
     * @return string crypt password
     */
    public function crypt(string $password): string;

    /**
     * Verify password
     *
     * @param string $passwordDecrypt Password decrypt
     * @param string $passwordCrypt password crypt
     * @return void
     * @throws Exception
     */
    public function verify(string $passwordDecrypt, string $passwordCrypt): void;
}
