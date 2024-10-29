<?php

namespace Controller;
use Model\UserProduct;
use Model\Product;
use Request\AddProductRequest;
use Request\DeleteProductRequest;
use Service\Auth\AuthSessionService;
use Service\Auth\AuthServiceInterface;
use Service\CartService;

class CartController
{
    private AuthServiceInterface $authService;
    private CartService $cartService;

    public function __construct(
        CartService $cartService,
        AuthServiceInterface $authService)
    {
        $this->authService = $authService;
        $this->cartService = $cartService;
    }
    public function addProduct(AddProductRequest $request)
    {
        //$authService = new AuthService();
        if (!$this->authService->check()) {
            header("Location: /login");
        }

        $errors = $request->validate();
        //$userId = $this->authService->getCurrentUser()->getId();

        if (empty($errors)) {
            $productId = $request->getProductId();
            $amount = $request->getAmount();

            $this->cartService->addProduct($userId, $productId, $amount);
        }
        header("Location: /catalog");
    }
    public function deleteProduct(DeleteProductRequest $request)
    {
        if (!$this->authService->check()) {
            header("Location: /login");
        }
        $errors = $request->validateDelete();
        $userId = $this->authService->getCurrentUser()->getId();

        if (empty($errors)) {
            $productId = $request->getProductId();
            $amount = $request->getAmount();
            UserProduct::deleteProduct($userId, $productId, $amount);
        }
        header("Location: /cart");
    }
    public function getAddProduct()
    {
        require_once './../View/get_add_product.php';
    }
    public function getCart()
    {
        if (!$this->authService->check()) {
            header("Location: /login");
        }
        $userId = $this->authService->getCurrentUser()->getId();

        $products = Product::getAllProductsByUserId($userId);

        require_once './../View/cart.php';
    }
}