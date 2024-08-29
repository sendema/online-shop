<?php
class ProductController
{
    public function catalog()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /get_login.php");
    }

    $productModel = new Product();
    $products = $productModel->getAll();

    require_once './../View/get_catalog.php';

    }
}