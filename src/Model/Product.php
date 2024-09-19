<?php

require_once './../Model/Model.php';
class Product extends Model
{
    public function getAll(): array|false
    {
        $stmt = $this->pdo->query("SELECT * FROM products");
        $products = $stmt->fetchAll();
        return $products;
    }
    public function getOneByProductId(int $productId): array|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $productId]);
        $result = $stmt->fetch();
        return $result;
    }
}