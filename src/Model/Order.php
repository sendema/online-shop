<?php

namespace Model;
use PDO;
class Order extends Model
{
    private int $id;
    private string $name;
    private string $phone;
    private string $address;
    private string $comment;
    private int $productId;
    private string $amount;

    public function create(string $name, string $phone, string $address, string $comment): ?self
    {
        $stmt = self::getPdo()->prepare("INSERT INTO orders (name, phone, address, comment) VALUES (:name, :phone, :address, :comment) RETURNING id");
        $stmt->execute(['name' => $name, 'phone' => $phone, 'address' => $address, 'comment' => $comment]);
        $id = $stmt->fetchColumn();

        if ($id === false) {
            return null;
        }
        $obj = new self();
        $obj->id = $id;
        $obj->name = $name;
        $obj->phone = $phone;
        $obj->address = $address;
        $obj->comment = $comment;

        return $obj;
    }
    public function getOrderByOrderId(int $orderId): ?array
    {
        $stmt = self::getPdo()->prepare("SELECT orders.id, orders.name, orders.phone, orders.address, orders.comment, orders_products.product_id, orders_products.amount
                                            FROM orders 
                                            JOIN orders_products ON orders.id = orders_products.order_id
                                            WHERE orders.id = :order_id");
        $stmt->execute(['order_id' => $orderId]);
        $result = $stmt->fetchAll();
        print_r($result);
        if (!$result) {
            return null;
        }
        return $result;
//        $orders = [];
//        foreach ($result as $row) {
//            $order = new Order();
//            $order->userId = $row['user_id'];
//            $order->id = $row['order_id'];
//            $order->name = $row['name'];
//            $order->phone = $row['phone'];
//            $order->address = $row['address'];
//            $order->comment = $row['comment'];
//            $order->productId = $row['product_id'];
//            $order->amount = $row['amount'];
//            $orders[] = $order;
//        }
//        return $orders;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getPhone(): string
    {
        return $this->phone;
    }
    public function getAddress(): string
    {
        return $this->address;
    }
    public function getComment(): string
    {
        return $this->comment;
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