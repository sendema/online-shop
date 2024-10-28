<?php

namespace Model;
use PDO;

class OrderProduct extends Model
{
    private int $id;
    private int $orderId;
    private int $productId;
    private int $amount;

    public static function insert(int $orderId, int $productId, int $amount)
    {
        $stmt = self::getPdo()->prepare("INSERT INTO orders_products (order_id, product_id, amount) VALUES (:order_id, :product_id, :amount)");
        $stmt->execute(['order_id' => $orderId, 'product_id' => $productId, 'amount' => $amount]);
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getOrderId(): int
    {
        return $this->orderId;
    }
    public function getProductId(): int
    {
        return $this->productId;
    }
    public function getAmount(): int
    {
        return $this->amount;
    }
}