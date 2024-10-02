<?php

namespace Model;
use PDO;

class OrderProduct extends Model
{
    public function insert(int $orderId, int $productId, int $amount)
    {
        $stmt = $this->pdo->prepare("INSERT INTO orders_products (order_id, product_id, amount) VALUES (:order_id, :product_id, :amount)");
        $stmt->execute(['order_id' => $orderId, 'product_id' => $productId, 'amount' => $amount]);
    }
}