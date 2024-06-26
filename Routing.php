<?php

require_once 'src/controllers/AppController.php';
require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/UserController.php';
require_once 'src/controllers/ProductController.php';
require_once 'src/controllers/ClientController.php';
require_once 'src/controllers/OrderController.php';
require_once 'src/controllers/ReportController.php';

class Router
{

    public static $routes;
    public static $middlewares;

    public static function get($url, $view, $middleware=[])
    {
        self::$routes[$url] = $view;

        if (!empty($middleware)) {
            self::$middlewares[$url] = $middleware;
        }
    }

    public static function post($url, $view, $middleware=[])
    {
        self::$routes[$url] = $view;

        if (!empty($middleware)) {
            self::$middlewares[$url] = $middleware;
        }
    }

    public static function run($url)
    {
        $urlParts = explode("/", $url);
        $action = $urlParts[0];

        if (!array_key_exists($action, self::$routes)) {
            AppController::redirect('notFound', 404, TRUE);
        }

        $controller = self::$routes[$action];
        $object = new $controller;
        $action = $action ?: 'index';

        $id = $urlParts[1] ?? '';
        
        $wrapped = self::wrapMiddleware($action, $object, $action);
        $wrapped(['input' => $id]);
    }

    private static function wrapMiddleware($url, $object, $action) {
        $actionMiddleware = self::$middlewares[$url] ?? [];
        $method = [$object, $action];

        $wrapped = array_reduce(
            $actionMiddleware,
            function($next, $middleware) {
                return function ($input) use ($next, $middleware) {
                    return $middleware($input, $next);
                };
            },
            function ($input) use ($method) {
                return call_user_func($method, $input);
            }
        );

        return $wrapped;
    }
}