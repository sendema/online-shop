<?php

require_once './../Controller/UserController.php';
require_once './../Controller/ProductController.php';
require_once './../Controller/CartController.php';
require_once './../Controller/OrderController.php';
class App
{
    private array $routes = [
        '/login' => [
            'GET' => [
                'class' => 'UserController',
                'method' => 'getLogin',
            ],
            'POST' => [
                'class' => 'UserController',
                'method' => 'login',
            ],
        ],
        '/registrate' => [
            'GET' => [
                'class' => 'UserController',
                'method' => 'getRegistrate',
            ],
            'POST' => [
                'class' => 'UserController',
                'method' => 'registrate',
            ],
        ],
        '/catalog' => [
            'GET' => [
                'class' => 'ProductController',
                'method' => 'catalog',
            ],
        ],
        '/addProduct' => [
            'GET' => [
                'class' => 'CartController',
                'method' => 'getAddProduct',
            ],
            'POST' => [
                'class' => 'CartController',
                'method' => 'addProduct',
            ],
        ],
        '/cart' => [
            'GET' => [
                'class' => 'CartController',
                'method' => 'getCart',
            ],
        ],
        '/order' => [
            'GET' => [
                'class' => 'OrderController',
                'method' => 'getOrder',
            ],
            'POST' => [
                'class' => 'OrderController',
                'method' => 'order',
            ],
        ],
    ];

    public function run()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$requestUri])) {
            $route = $this->routes[$requestUri];
            if (isset($route[$requestMethod])) {
                $controllerName = $route[$requestMethod]['class'];
                $methodName = $route[$requestMethod]['method'];

                $controller = new $controllerName();
                $controller->$methodName();
            } else {
                echo "$requestMethod не поддерживается для $route";
            }
        } else {
            http_response_code(404);
            require_once '../View/404.php';
        }
    }
}