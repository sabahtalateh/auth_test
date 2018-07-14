<?php

namespace app\service\registration;

use app\file_uploader\Uploader;
use app\mail\MailerInterface;
use app\model\User;
use app\orm\Repository;
use app\password_hashing\PasswordHashInterface;

class RegistrationService
{
    /**
     * @var Uploader
     */
    private $fileUploader;

    /**
     * @var Repository
     */
    private $repository;

    /**
     * @var PasswordHashInterface
     */
    private $passwordHash;
    /**
     * @var MailerInterface
     */
    private $registrationMailer;

    /**
     * RegistrationService constructor.
     *
     * @param Uploader              $fileUploader
     * @param Repository            $repository
     * @param PasswordHashInterface $passwordHash
     * @param MailerInterface       $registrationMailer
     */
    public function __construct(
        Uploader $fileUploader,
        Repository $repository,
        PasswordHashInterface $passwordHash,
        MailerInterface $registrationMailer
    ) {
        $this->fileUploader = $fileUploader;
        $this->repository = $repository;
        $this->passwordHash = $passwordHash;
        $this->registrationMailer = $registrationMailer;
    }


    /**
     * @param string      $email
     * @param string      $password
     * @param null|string $avatar
     *
     * @return User
     * @throws \Exception
     */
    public function registerUser(string $email, string $password, ?string $avatar = null): User
    {
        $user = new User();
        $user->email = $email;
        $user->password = $this->passwordHash->hash($password);
        $user->avatar = $avatar;
        $user->confirmationToken = $this->generateConfirmationToken();
        $this->repository->save($user);

        $this->registrationMailer->sendTo($user);

        return $user;
    }

    /**
     * @return string
     */
    private function generateConfirmationToken(): string
    {
        return uniqid();
    }
}