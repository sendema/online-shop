<?php

namespace Controller;
use http\Env\Request;
use Model\Model;
use Model\Order;
use Model\OrderProduct;
use Model\Product;
use Model\UserProduct;
use mysql_xdevapi\Exception;
use Request\OrderDetailsRequest;
use Request\OrderRequest;
use Service\Auth\AuthServiceInterface;
use Service\LoggerService;
use Service\OrderService;

class OrderController
{
    private AuthServiceInterface $authService;
    private OrderService $orderService;

    public function __construct(
        AuthServiceInterface $authService,
        OrderService $orderService)
    {
        $this->authService = $authService;
        $this->orderService = $orderService;
    }

    public function getOrderPage()
    {
        require_once './../View/get_order_page.php';
    }

    public function myOrders()
    {
        if (!$this->authService->check()) {
            header("Location: /login");
        }
        $userId = $this->authService->getCurrentUser()->getId();

        $orders = Order::getUserOrders($userId);

        require_once './../View/get_my_orders.php';
    }

    public function orderDetails(OrderDetailsRequest $request)
    {
        if (!$this->authService->check()) {
            header("Location: /login");
        }
        $userId = $this->authService->getCurrentUser()->getId();

        $errors = $request->validate();

        if (empty($errors)) {
            $orderId = $request->getOrderId();

            $orderDetails = Order::getOrderDetails($orderId);
        }

        require_once './../View/get_order_details.php';
    }

    public function order(OrderRequest $request)
    {
        if (!$this->authService->check()) {
            header("Location: /login");
        }
        $userId = $this->authService->getCurrentUser()->getId();

        $errors = $request->validate();

        if (empty($errors)) {
            $name = $request->getName();
            $phone = $request->getPhone();
            $address = $request->getAddress();
            $comment = $request->getComment();

            $result = $this->orderService->create($name, $phone, $address, $comment, $userId);

            if ($result) {
                header("Location: /myOrders");
            } else {
                http_response_code(500);
                require_once './../View/500.php';
            }
        }
        require_once './../View/get_order_page.php';
    }
}
