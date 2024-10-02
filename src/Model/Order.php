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

    public function create(string $name, string $phone, string $address, string $comment): ?self
    {
        $stmt = $this->pdo->prepare("INSERT INTO orders (name, phone, address, comment) VALUES (:name, :phone, :address, :comment) RETURNING id");
        $stmt->execute(['name' => $name, 'phone' => $phone, 'address' => $address, 'comment' => $comment]);
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

        return $obj;
    }
    public function getId(): int
    {
        return $this->id;
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
}