<?php

namespace app\controller;


use app\response\RedirectResponse;

class Controller
{
    /**
     * @param string $template
     * @param array  $variables
     *
     * @return string
     * @throws \Exception
     */
    public function render(string $template, array $variables)
    {
        $file = $_SERVER['DOCUMENT_ROOT'].'/../src/view/'.strtolower($template).'.php';

        if (file_exists($file)) {
            extract($variables);
            ob_start();
            include($file);
            $content = ob_get_contents();
            ob_end_clean();

            return $content;
        } else {
            throw new \Exception('Template '.$template.' not found!');
        }
    }

    /**
     * @return bool
     */
    public function isPost(): bool
    {
        return !empty($_POST);
    }

    public function redirect(string $url)
    {
        return new RedirectResponse($url);
    }

    public function getPostParameter(string $name): string
    {
        return $_POST[$name] ?? "";
    }
}