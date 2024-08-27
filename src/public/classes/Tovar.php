<?php

class Tovar
{
    public function catalog()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /get_login.php");
        }

        $pdo = new PDO("pgsql:host=db;port=5432;dbname=dbname", "dbuser", "dbpwd");

        $stmt = $pdo->query("SELECT * FROM products");

        $products = $stmt->fetchAll();

        require_once './get_catalog.php';
    }
}