<?php

namespace Controller;
use Model\Product;
use Service\Auth\AuthServiceInterface;

class ProductController
{
    private AuthServiceInterface  $authService;
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }
    public function catalog()
    {
        if (!$this->authService->check()) {
            header("Location: /login");
        }

        $products = Product::getAll();

        require_once './../View/get_catalog.php';
    }
}