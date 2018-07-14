<?php

namespace app\mail;

use app\model\User;

interface MailerInterface
{
    /**
     * @return MailerInterface
     */
    public static function getInstance(): MailerInterface;

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function sendTo(User $user);
}