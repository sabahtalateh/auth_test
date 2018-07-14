<?php

namespace app\model;

class User extends Model
{
    public $id;

    public $email;

    public $password;

    public $avatar;

    public $confirmationToken;

    /**
     * @return string
     */
    function getTable(): string
    {
        return 'users';
    }
}