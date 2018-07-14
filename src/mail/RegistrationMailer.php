<?php

namespace app\mail;

use app\model\User;
use PHPMailer\PHPMailer\PHPMailer;

class RegistrationMailer implements MailerInterface
{
    private static $INSTANCE = null;

    /**
     * @return MailerInterface
     */
    public static function getInstance(): MailerInterface
    {
        if (null === self::$INSTANCE) {
            self::$INSTANCE = new RegistrationMailer();
        }

        return self::$INSTANCE;
    }

    /**
     * @param User $user
     *
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function sendTo(User $user)
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mailbot991@gmail.com';
        $mail->Password = 'A12312312';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('mailbot991@gmail.com', 'mailbot');
        $mail->addAddress($user->email, $user->email);

        $mail->isHTML(true);
        $mail->Subject = 'Welcome komrad';
        $mail->Body = "Here is your confirnation token {$user->confirmationToken}";
        $mail->send();

    }
}