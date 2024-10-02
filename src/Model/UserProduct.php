<?php

namespace Model;
use PDO;
class UserProduct extends Model
{
    private int $id;
    private int $userId;
    private int $productId;
    private int $amount;
    public function getIdProduct(int $productId): ?self
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = :product_id");
        $stmt->execute(['product_id' => $productId]);
        $result = $stmt->fetch();

        if ($result === false) {
            return null;
        }
        $obj = new self();
        $obj->id = $result["id"];

        return $obj;
    }
    public function existProduct(int $productId, int $userId): ?self
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user_products WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
        $result = $stmt->fetch();

        if ($result === false) {
            return null;
        }
        $obj = new self();
        $obj->id = $result["id"];
        $obj->userId = $result["user_id"];
        $obj->productId = $result["product_id"];
        $obj->amount = $result["amount"];

        return $obj;
    }
    public function addProduct(int $userId, int $productId, int $amount)
    {
        $stmt = $this->pdo->prepare("INSERT INTO user_products (user_id, product_id, amount) VALUES (:user_id, :product_id, :amount);");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'amount' => $amount]);
    }
    public function updateAmount(int $userId, int $productId, int $amount)
    {

        $stmt = $this->pdo->prepare("UPDATE user_products SET amount = amount + :amount WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['amount' => $amount, 'user_id' => $userId, 'product_id' => $productId]);
    }
    public function deleteProduct(int $userId, int $productId, int $amount)
    {
        $stmt = $this->pdo->prepare("SELECT amount FROM user_products WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
        $product = $stmt->fetch();
        if ($product && $product['amount'] >= $amount) {
            $newAmount = $product['amount'] - $amount;
            if ($newAmount > 0) {
                $stmt = $this->pdo->prepare("UPDATE user_products SET amount = :amount WHERE user_id = :user_id AND product_id = :product_id");
                $stmt->execute(['amount' => $newAmount, 'user_id' => $userId, 'product_id' => $productId]);
            } else {
                $stmt = $this->pdo->prepare("DELETE FROM user_products WHERE user_id = :user_id AND product_id = :product_id");
                $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
            }
        }
    }
    public function getAllByUserId(int $userId): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user_products WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $result = $stmt->fetchAll();

        if ($result === false) {
            return null;
        }
        $products = [];
        foreach ($result as $row) {
        $obj = new self();
        $obj->id = $row['id'];
        $obj->userId = $row['user_id'];
        $obj->productId = $row['product_id'];
        $obj->amount = $row['amount'];
        $products[] = $obj;
        }
        return $products;
    }
    public function clearCart(int $userId)
    {
        $stmt = $this->pdo->prepare("DELETE FROM user_products WHERE user_id = :userId");
        $stmt->execute(['userId' => $userId]);
    }
    public function getId(): int
    {
        return $this->id;
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
}