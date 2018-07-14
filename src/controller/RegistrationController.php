<?php

namespace app\controller;

use app\file_uploader\Uploader;
use app\mail\RegistrationMailer;
use app\model\User;
use app\orm\Repository;
use app\password_hashing\BlowFish;
use app\response\Response;
use app\response\ResponseInterface;
use app\service\registration\RegistrationService;

class RegistrationController extends Controller
{
    protected $fileUploader;

    /**
     * RegistrationController constructor.
     */
    public function __construct()
    {
        $this->fileUploader = new Uploader();
    }

    /**
     * @return ResponseInterface
     * @throws \Exception
     */
    public function register(): ResponseInterface
    {
        if ($this->isPost()) {

            $registrationService = new RegistrationService(
                new Uploader(),
                Repository::getInstance(),
                BlowFish::getInstance(),
                RegistrationMailer::getInstance()
            );

            $avatar = null;

            if (!empty($_FILES['avatar']['name'])) {
                $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/uploads';
                $uploadTo = $uploadDir.time().basename($_FILES['avatar']['name']);
                $uploadFrom = $_FILES['avatar']['tmp_name'];
                $this->fileUploader->upload($uploadFrom, $uploadTo);
                $avatar = $uploadTo;
            }

            $registrationService->registerUser(
                $this->getPostParameter('email'),
                $this->getPostParameter('password'),
                $avatar
            );

            return $this->redirect("/register");
        } else {
            return new Response($this->render('registration/register', []));
        }
    }

    /**
     * @return ResponseInterface
     * @throws \Exception
     */
    public function login(): ResponseInterface
    {
        if ($this->isPost()) {
            return new Response($this->render('registration/login', []));
        } else {
            return new Response($this->render('registration/login', []));
        }
    }
}