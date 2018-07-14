<?php

namespace app\password_hashing;

class BlowFish implements PasswordHashInterface
{
    private static $INSTANCE = null;

    /**
     * @return PasswordHashInterface
     */
    public static function getInstance(): PasswordHashInterface
    {
        if (null === self::$INSTANCE) {
            self::$INSTANCE = new BlowFish();
        }

        return self::$INSTANCE;
    }

    /**
     * Repository constructor.
     */
    private function __construct()
    {
    }

    /**
     * @param string $value
     *
     * @return string
     */
    public function hash(string $value): string
    {
        return password_hash($value, PASSWORD_BCRYPT);
    }

    /**
     * @param string $password
     * @param string $hash
     *
     * @return bool
     */
    public function verify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

}