<?php

namespace Model;
use PDO;
class Order extends Model
{
    public function create(string $name, string $phone, string $address, string $comment)
    {
        $stmt = $this->pdo->prepare("INSERT INTO orders (name, phone, address, comment) VALUES (:name, :phone, :address, :comment) RETURNING id");
        $stmt->execute(['name' => $name, 'phone' => $phone, 'address' => $address, 'comment' => $comment]);
        $result = $stmt->fetchColumn();
        return $result;
    }
}