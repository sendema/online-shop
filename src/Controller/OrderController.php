<?php

namespace Controller;
use Model\Model;
use Model\Order;
use Model\OrderProduct;
use Model\Product;
use Model\UserProduct;
use mysql_xdevapi\Exception;
use Request\OrderRequest;
use Service\LoggerService;

class OrderController
{
    public function getOrderPage()
    {
        require_once './../View/get_order_page.php';
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

            //BEGIN; получить объект PDO и вызвать метод beginTrans

            $userProductModel = new UserProduct();
            $result = $userProductModel->getAllByUserId($userId);
            $orderModel = new Order();

            try {
                Model::getPdo()->beginTransaction();
                $order = $orderModel->create($name, $phone, $address, $comment);
                $orderId = $order->getId();

                foreach ($result as $userProduct) {
                    $orderProductModel = new OrderProduct();
                    $orderProductModel->insert($orderId, $userProduct->getProductId(), $userProduct->getAmount());
                }
                $userProductModel->clearCart($userId);
                //commit через объект PDO вызвать метод commit
                //throw new \Exception();
                Model::getPdo()->commit();
            } catch (\Throwable $exception) {
                Model::getPdo()->rollback();
                $logger = new LoggerService();
                $logger->error($exception);
                // ROLLBACK откатить
            }
            header("Location: /orderDetails");
        }
        require_once './../View/get_order_page.php';
    }
}
