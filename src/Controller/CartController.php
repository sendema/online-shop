<?php

namespace Controller;
use Model\UserProduct;
use Model\Product;
use Request\AddProductRequest;
use Request\DeleteProductRequest;
use Service\AuthService;
use Service\CartService;

class CartController
{
    private AuthService $authService;
    private CartService $cartService;
    private UserProduct $userProductModel;

    public function __construct()
    {
        $this->authService = new AuthService();
        $this->cartService = new CartService();
        $this->userProductModel = new UserProduct();
    }
    public function addProduct(AddProductRequest $request)
    {
        $authService = new AuthService();
        if (!$authService->check()) {
            header("Location: /login");
        }

        $errors = $request->validate();
        $userId = $authService->getCurrentUser()->getId();

        if (empty($errors)) {
            $productId = $request->getProductId();
            $amount = $request->getAmount();

            $this->cartService->addProduct($userId, $productId, $amount);
        }
        header("Location: /catalog");
    }
    public function deleteProduct(DeleteProductRequest $request)
    {
        $authService = new AuthService();
        if (!$authService->check()) {
            header("Location: /login");
        }
        $errors = $request->validateDelete();
        $userId = $authService->getCurrentUser()->getId();

        if (empty($errors)) {
            $productId = $request->getProductId();
            $amount = $request->getAmount();
            $this->userProductModel->deleteProduct($userId, $productId, $amount);
        }
        header("Location: /cart");
    }
    public function getAddProduct()
    {
        require_once './../View/get_add_product.php';
    }
    public function getCart()
    {
        $authService = new AuthService();
        if (!$authService->check()) {
            header("Location: /login");
        }
        $userId = $authService->getCurrentUser()->getId();

        $productModel = new Product();
        $products = $productModel->getAllProductsByUserId($userId);

        require_once './../View/cart.php';
    }
}