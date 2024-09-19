<?php

require_once './../Model/Model.php';
class UserProduct extends Model
{
    public function getIdProduct(int $productId): array|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = :product_id");
        $stmt->execute(['product_id' => $productId]);
        $result = $stmt->fetch();

        return $result;
    }
    public function existProduct(int $productId, int $userId): array|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user_products WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
        $result = $stmt->fetch();
        return $result;
    }
    public function addProduct(int $userId, int $productId, int $amount)
    {
        $stmt = $this->pdo->prepare("INSERT INTO user_products (user_id, product_id, amount) VALUES (:user_id, :product_id, :amount);");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'amount' => $amount]);
    }

    public function updateAmount(int $userId, int $productId, int $amount)
    {
        //$pdo = new PDO("pgsql:host=db;port=5432;dbname=dbname", "dbuser", "dbpwd");

        $stmt = $this->pdo->prepare("UPDATE user_products SET amount = amount + :amount WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['amount' => $amount, 'user_id' => $userId, 'product_id' => $productId]);
    }

    public function getAllByUserId(int $userId): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user_products WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function clearCart()
    {
        $stmt = $this->pdo->prepare("DELETE FROM user_products WHERE user_id = :userId");
        $stmt->execute(['userId' => $userId]);
    }
}