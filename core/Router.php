<?php

namespace app\core;

/**
 * Class Router
 * @package app\core
 */

class Router
{
    protected array $routes = [];
    public Request $request;
    public Response $response;

    /**
     * Router constructor.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @param $path
     * @param $callback
     */
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * @return array|false|mixed|string|string[]
     */
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            $this->response->setStatusCode(404);

            return $this->renderView("_404");
        }

        if (is_string($callback)) {

            return $this->renderView($callback);
         }

         if (is_array($callback)) {

            $callback[0] = new $callback[0]();
         }

         return call_user_func($callback);
    }

    /**
     * @param $views
     * @param array $params
     * @return array|false|string|string[]
     */
    public function renderView($views, array $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($views, $params);
        return str_replace('{{content}}',$viewContent,$layoutContent);
    }

    /**
     * @return false|string
     */
    protected function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_DIR .  "/views/layouts/main.php";
        return ob_get_clean();
    }

    /**
     * @param $view
     * @param $params
     * @return false|string
     */
    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR .  "/views/$view.php";
        return ob_get_clean();
    }

}