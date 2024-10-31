<?php

namespace Service;

use Model\Order;
use Model\OrderProduct;
use Model\UserProduct;
use Model\Model;
use Service\Logger\LoggerFileService;

class OrderService
{
    public function create(string $name, string $phone, string $address, string $comment, int $userId): bool
    {
        $result = UserProduct::getAllByUserId($userId);
        Model::getPdo()->beginTransaction();
        try {
            $order = Order::create($name, $phone, $address, $comment, $userId);
            foreach ($result as $userProduct) {
                OrderProduct::insert($order->getId(), $userProduct->getProductId(), $userProduct->getAmount());
            }
            UserProduct::clearCart($userId);

            Model::getPdo()->commit();

            return true;
        } catch (\Throwable $exception) {
            Model::getPdo()->rollback();

            $loggerService = new LoggerFileService();
            $loggerService->error($exception);

            return false;
        }
    }
}