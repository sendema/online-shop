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
    private int $userId;
    private int $orderId;
    private string $productId;
    private string $amount;
    private string $image;
    private string $title;

    public function create(string $name, string $phone, string $address, string $comment, int $userId): ?self
    {
        $stmt = self::getPdo()->prepare("INSERT INTO orders (name, phone, address, comment, user_id) VALUES (:name, :phone, :address, :comment, :userId) RETURNING id");
        $stmt->execute(['name' => $name, 'phone' => $phone, 'address' => $address, 'comment' => $comment, 'userId' => $userId]);
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
        $obj->userId = $userId;

        return $obj;
    }
    public function getUserOrders(int $userId): ?array
    {
        $stmt = self::getPdo()->prepare("SELECT orders.id, orders.name, orders.phone, orders.address, orders.comment, orders_products.product_id, orders_products.amount
                                            FROM orders 
                                            JOIN orders_products ON orders.id = orders_products.order_id
                                            WHERE orders.user_id = :user_id
                                            ORDER BY orders.id ASC");
        $stmt->execute(['user_id' => $userId]);
        $result = $stmt->fetchAll();
        if ($result === false) {
            return null;
        }
        $orders = [];
        foreach ($result as $row) {
            $order = new Order();
            $order->id = $row['id'];
            $order->name = $row['name'];
            $order->phone = $row['phone'];
            $order->address = $row['address'];
            $order->comment = $row['comment'];
            $order->productId = $row['product_id'];
            $order->amount = $row['amount'];
            $orders[] = $order;
        }
        return $orders;
    }
    public function getOrderDetails(int $orderId): ?array
    {
        $stmt = self::getPdo()->prepare("SELECT orders.id, orders_products.product_id, orders_products.amount, products.title, products.image
                                        FROM orders JOIN orders_products ON orders.id = orders_products.order_id
                                        JOIN products ON orders_products.product_id = products.id
                                        WHERE orders.id = :order_id");
        $stmt->execute(['order_id' => $orderId]);
        $result = $stmt->fetchAll();
        if ($result === false) {
            return null;
        }
        $orderDetails = [];
        foreach ($result as $row) {
            $order = new Order();
            $order->id = $row['id'];
            //$order->orderId = $row['order_id'];
            $order->productId = $row['product_id'];
            $order->amount = $row['amount'];
            $order->title = $row['title'];
            $order->image = $row['image'];
            $orderDetails[] = $order;
        }

        return $orderDetails;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getOrderId(): int
    {
        return $this->orderId;
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
    public function getUserId(): int
    {
        return $this->userId;
    }
    public function getProductId(): int
    {
        return $this->productId;
    }
    public function getAmount(): int
    {
        return $this->amount;
    }
    public function getImage(): string
    {
        return $this->image;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
}