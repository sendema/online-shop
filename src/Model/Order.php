<?php

class Order
{
    public function create(string $name, string $phone, string $address, string $comment)
    {
        $pdo = new PDO("pgsql:host=db;port=5432;dbname=dbname", "dbuser", "dbpwd");

        $stmt = $pdo->prepare("INSERT INTO orders (name, phone, address, comment) VALUES (:name, :phone, :address, :comment) RETURNING id");
        $stmt->execute(['name' => $name, 'phone' => $phone, 'address' => $address, 'comment' => $comment]);
        $result = $stmt->fetchColumn();
        return $result;
    }
}