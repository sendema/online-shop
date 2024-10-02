<?php

namespace Controller;
use Model\Product;

class ProductController
{
    public function catalog()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        }

        $productModel = new Product();
        $products = $productModel->getAll();

        require_once './../View/get_catalog.php';
    }
}