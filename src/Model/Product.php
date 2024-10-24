<?php

namespace Model;
use PDO;
class Product extends Model
{
    private int $id;
    private string $title;
    private string $description;
    private float $price;
    private string $image;
    private int $amount;
    public function getAll(): ?array
    {
        $stmt = self::getPdo()->query("SELECT * FROM products");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($results === false) {
            return null;
        }
        $products = [];
        foreach ($results as $row) {
            $obj = new self();
            $obj->id = $row['id'];
            $obj->title = $row['title'];
            $obj->description = $row['description'];
            $obj->price = $row['price'];
            $obj->image = $row['image'];
            $products[] = $obj;
        }
        return $products;
    }
    public function getAllProductsByUserId(int $userId): ?array
    {
        $stmt = self::getPdo()->prepare("SELECT products.*, user_products.amount FROM user_products JOIN products ON user_products.product_id = products.id WHERE user_products.user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $result = $stmt->fetchAll();

        if ($result === false) {
            return null;
        }

        $products = [];
        foreach ($result as $row) {
            $product = new Product();
            $product->id = $row['id'];
            $product->title = $row['title'];
            $product->price = $row['price'];
            $product->amount = $row['amount'];
            $product->image = $row['image'];
            $product->description = $row['description'];
            $products[] = $product;
        }
        return $products;
    }
    public function getAllByOrderId(int $orderId): ?array
    {
        $stmt = self::getPdo()->prepare("SELECT products.id, products.title, products.price, products.image, orders_products.amount
                                        FROM products JOIN orders_products ON products.id = orders_products.product_id WHERE orders_products.order_id = :order_id");

    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function getPrice(): float
    {
        return $this->price;
    }
    public function getImage(): string
    {
        return $this->image;
    }
    public function getAmount(): int
    {
        return $this->amount;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}