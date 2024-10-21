<?php

namespace Model;
use PDO;

class OrderProduct extends Model
{
    private int $id;
    private int $orderId;
    private int $productId;
    private int $amount;

    public function insert(int $orderId, int $productId, int $amount)
    {
        $stmt = self::getPdo()->prepare("INSERT INTO orders_products (order_id, product_id, amount) VALUES (:order_id, :product_id, :amount)");
        $stmt->execute(['order_id' => $orderId, 'product_id' => $productId, 'amount' => $amount]);
    }
    public function getByOrderId(int $orderId): ?array
    {
        $stmt = self::getPdo()->prepare("SELECT * FROM orders_products WHERE order_id = :orderId");
        $stmt->execute(['orderId' => $orderId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result === false) {
            return null;
        }

        $orderProducts = [];
        foreach ($result as $row) {
            $orderProduct = new OrderProduct();
            $orderProduct->id = $row['id'];
            $orderProduct->orderId = $row['order_id'];
            $orderProduct->productId = $row['product_id'];
            $orderProduct->amount = $row['amount'];
            $orderProducts[] = $orderProduct;
        }
        return $orderProducts;
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