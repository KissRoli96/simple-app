<?php

namespace app\core;

class Controller
{
    /**
     * @param $view
     * @param array $params
     * @return array|false|string|string[]
     */
    public function render($view, array $params = [])
    {
        return Application::$app->router->renderView($view,$params);
    }


}