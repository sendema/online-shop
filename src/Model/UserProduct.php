<?php
class UserProduct
{
    public function getIdProduct(int $product_id): array|false
    {
        $pdo = new PDO("pgsql:host=db;port=5432;dbname=dbname", "dbuser", "dbpwd");

        $stmt = $pdo->prepare("SELECT * FROM products WHERE id_product = :id_product");
        $stmt->execute(['product_id' => $product_id]);
        $result = $stmt->fetch();

        return $result;
    }
    public function existProduct(int $product_id): array|false
    {
        $pdo = new PDO("pgsql:host=db;port=5432;dbname=dbname", "dbuser", "dbpwd");

        $stmt = $pdo->prepare("SELECT * FROM user_products WHERE product_id = :product_id");
        $stmt->execute(['product_id' => $product_id]);
        $result = $stmt->fetch();

        return $result;
    }
    public function addProduct(int $user_id, int $product_id, int $amount)
    {
        $pdo = new PDO("pgsql:host=db;port=5432;dbname=dbname", "dbuser", "dbpwd");

        $stmt = $pdo->prepare("INSERT INTO user_products (user_id, product_id, amount) VALUES (:user_id, :product_id, :amount)");
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id, 'amount' => $amount]);
    }
    public function updateAmount(int $user_id, int $product_id, int $amount)
    {
        $pdo = new PDO("pgsql:host=db;port=5432;dbname=dbname", "dbuser", "dbpwd");

        $stmt = $pdo->prepare("UPDATE user_products SET amount = amount + :amount WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['amount' => $amount, 'user_id' => $user_id, 'product_id' => $product_id]);
    }
}