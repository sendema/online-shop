<?php

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestUri === '/login') {
    if ($requestMethod === 'GET') {
        require_once './../Controller/UserController.php';
        $userController = new UserController();
        $userController->getLogin();
    } elseif ($requestMethod === 'POST') {
        require_once './../Controller/UserController.php';
        $userController = new UserController();
        $userController->login();
    } else {
        echo "$requestMethod не поддерживается для uri $requestUri";
    }
} elseif ($requestUri === '/registrate') {
    require_once './../Controller/UserController.php';
    $userController = new UserController();
    $userController->registrate();
} elseif ($requestUri === '/catalog') {
    if ($requestMethod === 'GET') {
        require_once './../Controller/ProductController.php';
        $productController = new ProductController();
        $productController->catalog();
    } else {
        echo "$requestMethod не поддерживается для uri $requestUri";
    }
} elseif ($requestUri === '/addProduct') {
    if ($requestMethod === 'GET') {
        require_once './../Controller/CartController.php';
        $cartController = new CartController();
        $cartController->getAddProduct();
    } elseif ($requestMethod === 'POST') {
        require_once './../Controller/CartController.php';
        $cartController = new CartController();
        $cartController->addProduct();
    } else {
        echo "$requestMethod не поддерживается для uri $requestUri";
    }
} elseif ($requestUri === '/cart') {
    if ($requestMethod === 'GET') {
        require_once './../Controller/CartController.php';
        $cartController = new CartController();
        $cartController->getCart();
    }
} else {
    http_response_code(404);
    require_once '../View/404.php';
}
