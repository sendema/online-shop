<?php

namespace Controller;
use Model\Order;
use Model\OrderProduct;
use Model\UserProduct;
use PDO;
use Request\OrderRequest;

class OrderController
{
    public function getOrder()
    {
        require_once './../View/get_order.php';
    }
    public function order(OrderRequest $request)
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        }
        $userId = $_SESSION['user_id'];
        $errors = $request->validate();
        if (empty($errors)) {
            $name = $request->getName();
            $phone = $request->getPhone();
            $address = $request->getAddress();
            $comment = $request->getComment();

            $orderModel = new Order();
            $order = $orderModel->create($name, $phone, $address, $comment);
            $orderId = $order->getId();

            $orderModel = new UserProduct();
            $result = $orderModel->getAllByUserId($userId);

            //$pdo = new PDO("pgsql:host=db;port=5432;dbname=dbname", "dbuser", "dbpwd");

            foreach ($result as $userProduct) {
                $orderProductModel = new OrderProduct();
                $orderProductModel->insert($orderId, $userProduct->getProductId(), $userProduct->getAmount());
            }

            $userProductModel = new UserProduct();
            $userProduct->clearCart($userId);

            header("Location: /catalog");
        }
        require_once './../View/get_order.php';
    }
}
