<?php

namespace app\password_hashing;

interface PasswordHashInterface
{
    /**
     * @param string $value
     *
     * @return string
     */
    function hash(string $value): string;

    /**
     * @param string $password
     * @param string $hash
     *
     * @return bool
     */
    public function verify(string $password, string $hash): bool;
}