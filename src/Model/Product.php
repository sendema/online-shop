<?php
class Product
{
    public function getAll(): array|false
    {
        $pdo = new PDO("pgsql:host=db;port=5432;dbname=dbname", "dbuser", "dbpwd");

        $stmt = $pdo->query("SELECT * FROM products");

        $products = $stmt->fetchAll();

        return $products;
    }
    public function getOneByProductId(int $productId): array|false
    {
        $pdo = new PDO("pgsql:host=db;port=5432;dbname=dbname", "dbuser", "dbpwd");

        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $productId]);
        $result = $stmt->fetch();

        return $result;
    }
}