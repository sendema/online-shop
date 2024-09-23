<?php
class App
{
    private array $routes = [
        '/login' => [
            'GET' => [
                'class' => 'Controller\UserController',
                'method' => 'getLogin',
            ],
            'POST' => [
                'class' => 'Controller\UserController',
                'method' => 'login',
            ],
        ],
        '/registrate' => [
            'GET' => [
                'class' => 'Controller\UserController',
                'method' => 'getRegistrate',
            ],
            'POST' => [
                'class' => 'Controller\UserController',
                'method' => 'registrate',
            ],
        ],
        '/catalog' => [
            'GET' => [
                'class' => 'Controller\ProductController',
                'method' => 'catalog',
            ],
        ],
        '/addProduct' => [
            'GET' => [
                'class' => 'Controller\CartController',
                'method' => 'getAddProduct',
            ],
            'POST' => [
                'class' => 'Controller\CartController',
                'method' => 'addProduct',
            ],
        ],
        '/deleteProduct' => [
            'POST' => [
                'class' => 'Controller\CartController',
                'method' => 'deleteProduct',
            ],
        ],
        '/cart' => [
            'GET' => [
                'class' => 'Controller\CartController',
                'method' => 'getCart',
            ],
        ],
        '/order' => [
            'GET' => [
                'class' => 'Controller\OrderController',
                'method' => 'getOrder',
            ],
            'POST' => [
                'class' => 'Controller\OrderController',
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