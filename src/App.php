<?php

use Controller\CartController;
use Controller\UserController;

class App
{
    private array $routes = [
        '/login' => [
            'GET' => [
                'class' => \Controller\UserController::class,
                'method' => 'getLogin',
            ],
            'POST' => [
                'class' => \Controller\UserController::class,
                'method' => 'login',
                'request' => \Request\LoginRequest::class,
            ],
        ],
        '/registrate' => [
            'GET' => [
                'class' => \Controller\UserController::class,
                'method' => 'getRegistrate',
            ],
            'POST' => [
                'class' => \Controller\UserController::class,
                'method' => 'registrate',
                'request' => \Request\RegistrateRequest::class,
            ],
        ],
        '/catalog' => [
            'GET' => [
                'class' => \Controller\ProductController::class,
                'method' => 'catalog',
            ],
        ],
        '/addProduct' => [
            'GET' => [
                'class' => \Controller\CartController::class,
                'method' => 'getAddProduct',
            ],
            'POST' => [
                'class' => \Controller\CartController::class,
                'method' => 'addProduct',
                'request' => \Request\AddProductRequest::class,
            ],
        ],
        '/deleteProduct' => [
            'POST' => [
                'class' => \Controller\CartController::class,
                'method' => 'deleteProduct',
                'request' => \Request\DeleteProductRequest::class,
            ],
        ],
        '/cart' => [
            'GET' => [
                'class' => \Controller\CartController::class,
                'method' => 'getCart',
            ],
        ],
        '/order' => [
            'GET' => [
                'class' => \Controller\OrderController::class,
                'method' => 'getOrder',
            ],
            'POST' => [
                'class' => \Controller\OrderController::class,
                'method' => 'order',
                'request' => \Request\OrderRequest::class,
            ],
        ],
    ];

    public function run()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        if ($requestMethod === 'POST') {
            $requestData = $_POST;
        }

        if (isset($this->routes[$requestUri])) {
            $route = $this->routes[$requestUri];
            if (isset($route[$requestMethod])) {
                $controllerName = $route[$requestMethod]['class'];
                $methodName = $route[$requestMethod]['method'];
                $controller = new $controllerName();
                if (isset($route[$requestMethod]['request'])) {
                    $requestClass = $route[$requestMethod]['request'];
                    $request = new $requestClass($requestMethod, $requestUri, $requestData);
                    $controller->$methodName($request);
                } else {
                    $controller->$methodName();
                }
            } else {
                echo "$requestMethod не поддерживается для $route";
            }
        } else {
            http_response_code(404);
            require_once '../View/404.php';
        }
    }
}