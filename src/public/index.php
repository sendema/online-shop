<?php

use Core\App;
use Core\Container;
use Service\Logger\LoggerDbService;
use Service\Logger\LoggerFileService;

$autoloader = function (string $className) {
    $modifiedClassName = str_replace('\\', '/', $className);
    $path = __DIR__ . "/../$modifiedClassName.php";

    if (file_exists($path)) {
        require_once $path;
        return true;
    }
    return false;
};

spl_autoload_register($autoloader);

$container = new Core\Container();
$loggerService = new LoggerFileService();

$container->set(\Controller\CartController::class, function (Container $container) {
    $cartService = new \Service\CartService();
    $authService = $container->get(\Service\Auth\AuthServiceInterface::class);

    return new \Controller\CartController($cartService, $authService);
});
$container->set(\Controller\OrderController::class, function (Container $container) {
    $authService = $container->get(\Service\Auth\AuthServiceInterface::class);
    $orderService = new \Service\OrderService();

    return new \Controller\OrderController($authService, $orderService);
});
$container->set(\Controller\UserController::class, function (Container $container) {
    $authService = $container->get(\Service\Auth\AuthServiceInterface::class);

    return new \Controller\UserController($authService);
});
$container->set(\Controller\ProductController::class, function (Container $container) {
    $authService = $container->get(\Service\Auth\AuthServiceInterface::class);
    $reviewService = new \Service\ReviewService();

    return new \Controller\ProductController($authService, $reviewService);
});
$container->set(\Service\Auth\AuthServiceInterface::class, function () {
    return new \Service\Auth\AuthSessionService();
});
$container->set(\Service\Logger\LoggerServiceInterface::class, function () {
    return new \Service\Logger\LoggerFileService();
});

$app = new App($container, $loggerService);
$app->createRoute('/login', 'GET', \Controller\UserController::class, 'getLogin');
$app->createRoute('/login', 'POST', \Controller\UserController::class, 'login', \Request\LoginRequest::class);
$app->createRoute('/registrate', 'GET', \Controller\UserController::class, 'getRegistrate');
$app->createRoute('/registrate', 'POST', \Controller\UserController::class, 'registrate', \Request\RegistrateRequest::class);
$app->createRoute('/catalog', 'GET', \Controller\ProductController::class, 'catalog');
$app->createRoute('/addProduct', 'GET', \Controller\CartController::class, 'getAddProduct');
$app->createRoute('/addProduct', 'POST', \Controller\CartController::class, 'addProduct', \Request\AddProductRequest::class);
$app->createRoute('/deleteProduct', 'POST', \Controller\CartController::class, 'deleteProduct', \Request\DeleteProductRequest::class);
$app->createRoute('/cart', 'GET', \Controller\CartController::class, 'getCart');
$app->createRoute('/order', 'GET', \Controller\OrderController::class, 'getOrderPage');
$app->createRoute('/order', 'POST', \Controller\OrderController::class, 'order', \Request\OrderRequest::class);
$app->createRoute('/myOrders', 'GET', \Controller\OrderController::class, 'myOrders');
$app->createRoute('/orderDetails', 'POST', \Controller\OrderController::class, 'orderDetails', \Request\OrderDetailsRequest::class);
$app->createRoute('/productInfo', 'POST', \Controller\ProductController::class, 'productInfo', \Request\ProductInfoRequest::class);
$app->createRoute('/addReview', 'POST', \Controller\ProductController::class, 'addReview', \Request\AddReviewRequest::class);
$app->run();




