<?php

namespace app\controller;

use app\response\Response;
use app\response\ResponseInterface;

class IndexController extends Controller
{
    /**
     * @return ResponseInterface
     * @throws \Exception
     */
    public function index(): ResponseInterface
    {
        return new Response($this->render('index', []));
    }
}