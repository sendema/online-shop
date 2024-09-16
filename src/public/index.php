<?php

require_once './../Controller/UserController.php';
require_once './../Controller/ProductController.php';
require_once './../Controller/CartController.php';
require_once './../Controller/OrderController.php';

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestUri === '/login') {
    if ($requestMethod === 'GET') {
        $userController = new UserController();
        $userController->getLogin();
    } elseif ($requestMethod === 'POST') {
        $userController = new UserController();
        $userController->login();
    } else {
        echo "$requestMethod не поддерживается для uri $requestUri";
    }
} elseif ($requestUri === '/registrate') {
    if ($requestMethod === 'GET') {
        $userController = new UserController();
        $userController->getRegistrate();
    } elseif ($requestMethod === 'POST') {
        $userController = new UserController();
        $userController->registrate();
    } else {
        echo "$requestMethod не поддерживается для uri $requestUri";
    }
} elseif ($requestUri === '/catalog') {
    if ($requestMethod === 'GET') {
        $productController = new ProductController();
        $productController->catalog();
    } else {
        echo "$requestMethod не поддерживается для uri $requestUri";
    }
} elseif ($requestUri === '/addProduct') {
    if ($requestMethod === 'GET') {
        $cartController = new CartController();
        $cartController->getAddProduct();
    } elseif ($requestMethod === 'POST') {
        $cartController = new CartController();
        $cartController->addProduct();
    } else {
        echo "$requestMethod не поддерживается для uri $requestUri";
    }
} elseif ($requestUri === '/cart') {
    if ($requestMethod === 'GET') {
        $cartController = new CartController();
        $cartController->getCart();
    } else {
        echo "$requestMethod не поддерживается для uri $requestUri";
    }
} elseif ($requestUri === '/order') {
    if ($requestMethod === 'GET') {
        $orderController = new OrderController();
        $orderController->getOrder();
    } elseif ($requestMethod === 'POST') {
        $orderController = new OrderController();
        $orderController->order();
    } else {
        echo "$requestMethod не поддерживается для uri $requestUri";
    }
} else {
    http_response_code(404);
    require_once '../View/404.php';
}
