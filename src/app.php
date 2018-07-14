<?php

namespace app;

use app\response\RedirectResponse;
use app\response\ResponseInterface;
use PDO;

class app
{
    private $routes = [
        '/' => [\app\controller\IndexController::class, 'index'],
        '/register' => [\app\controller\RegistrationController::class, 'register'],
        '/login' => [\app\controller\RegistrationController::class, 'login'],
    ];

    /**
     * @throws \Exception
     */
    public function run()
    {


        $uri = explode('?', $_SERVER['REQUEST_URI'])[0];
        if ($this->routes[$uri]) {
            $controllerName = $this->routes[$uri][0];
            $methodName = $this->routes[$uri][1];
            $controller = new $controllerName;
            $response = call_user_func([$controller, $methodName]);
            if (!($response instanceof ResponseInterface)) {
                throw new \Exception("Controller {$controllerName}::{$methodName} does not return Response Iterface");
            }
            http_response_code($response->getCode());
            if ($response instanceof RedirectResponse) {
                header("Location:{$response->getUrl()}");
            }
            echo $response->getBody();
        }
    }
}