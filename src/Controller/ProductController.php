<?php

namespace Controller;
use Model\Product;
use Service\AuthService;

class ProductController
{
    private AuthService  $authService;
    public function __construct()
    {
        $this->authService = new AuthService();
    }
    public function catalog()
    {
        $authService = new AuthService();
        if (!$authService->check()) {
            header("Location: /login");
        }

        $productModel = new Product();
        $products = $productModel->getAll();

        require_once './../View/get_catalog.php';
    }
}