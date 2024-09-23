<?php

namespace Model;
use PDO;
class User extends Model
{
    public function getOneByEmail(string $email): array|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function create(string $name, string $email, string $password)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :psw)");
        $stmt->execute(['name' => $name, 'email' => $email, 'psw' => $password]);
    }

}