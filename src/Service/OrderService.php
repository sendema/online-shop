<?php

namespace Service;

use Model\Order;
use Model\OrderProduct;
use Model\UserProduct;
use Model\Model;

class OrderService
{
    private UserProduct $userProduct;
    private Order $order;
    private OrderProduct $orderProduct;
    public function __construct()
    {
        $this->userProduct = new UserProduct();
        $this->order = new Order();
        $this->orderProduct = new OrderProduct();
    }
    public function create(string $name, string $phone, string $address, string $comment, int $userId): bool
    {
        $result = $this->userProduct->getAllByUserId($userId);
        Model::getPdo()->beginTransaction();
        try {
            $order = $this->order->create($name, $phone, $address, $comment, $userId);
            foreach ($result as $userProduct) {
                $this->orderProduct->insert($order->getId(), $userProduct->getProductId(), $userProduct->getAmount());
            }
            $this->userProduct->clearCart($userId);

            Model::getPdo()->commit();

            return true;
        } catch (\Throwable $exception) {
            Model::getPdo()->rollback();

            $logger = new LoggerService();
            $logger->error($exception);

            return false;
        }
    }
}