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
use Service\AuthService;
use Service\LoggerService;
use Service\OrderService;

class OrderController
{
    private AuthService $authService;
    private OrderService $orderService;

    public function __construct()
    {
        $this->authService = new AuthService();
        $this->orderService = new OrderService();
    }

    public function getOrderPage()
    {
        require_once './../View/get_order_page.php';
    }

    public function myOrders()
    {
        $authService = new AuthService();
        if (!$authService->check()) {
            header("Location: /login");
        }
        $userId = $authService->getCurrentUser()->getId();

        $orderModel = new Order();
        $orders = $orderModel->getUserOrders($userId);

        require_once './../View/get_my_orders.php';
    }

    public function orderDetails(OrderDetailsRequest $request)
    {
        $authService = new AuthService();
        if (!$authService->check()) {
            header("Location: /login");
        }
        $userId = $authService->getCurrentUser()->getId();

        $errors = $request->validate();

        if (empty($errors)) {
            $orderId = $request->getOrderId();

            $orderModel = new Order();
            $orderDetails = $orderModel->getOrderDetails($orderId);
        }

        require_once './../View/get_order_details.php';
    }

    public function order(OrderRequest $request)
    {
        $authService = new AuthService();
        if (!$authService->check()) {
            header("Location: /login");
        }
        $userId = $authService->getCurrentUser()->getId();

        $errors = $request->validate();

        if (empty($errors)) {
            $name = $request->getName();
            $phone = $request->getPhone();
            $address = $request->getAddress();
            $comment = $request->getComment();

            $orderService = new OrderService();
            $result = $orderService->create($name, $phone, $address, $comment, $userId);

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

//            //BEGIN; получить объект PDO и вызвать метод beginTrans
//
//            $userProductModel = new UserProduct();
//            $result = $userProductModel->getAllByUserId($userId);
//            $orderModel = new Order();
//
//            try {
//                Model::getPdo()->beginTransaction();
//                $order = $orderModel->create($name, $phone, $address, $comment, $userId);
//                $orderId = $order->getId();
//
//                foreach ($result as $userProduct) {
//                    $orderProductModel = new OrderProduct();
//                    $orderProductModel->insert($orderId, $userProduct->getProductId(), $userProduct->getAmount());
//                }
//                $userProductModel->clearCart($userId);
//                //commit через объект PDO вызвать метод commit
//                //throw new \Exception();
//                Model::getPdo()->commit();
//            } catch (\Throwable $exception) {
//                Model::getPdo()->rollback();
//                $logger = new LoggerService();
//                $logger->error($exception);
//                // ROLLBACK откатить
//            }
//            header("Location: /myOrders");
//        }
//        require_once './../View/get_order_page.php';
//    }

