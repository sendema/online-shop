<?php

namespace Model;
use PDO;
class Product extends Model
{
    private int $id;
    private string $title;
    private string $description;
    private float $price;
    private int $amount;
    private string $image;

    public function getAll(): ?array
    {
        $stmt = $this->pdo->query("SELECT * FROM products");
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
    public function getOneByProductId(int $productId): ?self
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $productId]);
        $result = $stmt->fetch();

        if ($result === false) {
            return null;
        }
        $obj = new self();
        $obj->id = $result['id'];
        $obj->title = $result['title'];
        $obj->description = $result['description'];
        $obj->price = $result['price'];
        $obj->image = $result['image'];

        return $obj;
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
    public function setAmount(int $amount)
    {
        return $this->amount = $amount;
    }
    public function getAmount(): int
    {
        return $this->amount;
    }
    public function getImage(): string
    {
        return $this->image;
    }
}