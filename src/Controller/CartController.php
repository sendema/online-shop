<?php

namespace Controller;
use Model\UserProduct;
use Model\Product;
use Request\AddProductRequest;
use Request\DeleteProductRequest;

class CartController
{
    public function addProduct(AddProductRequest $request)
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        }
        $errors = $request->validate();
        $userId = $_SESSION['user_id'];
        if (empty($errors)) {
            $productId = $request->getProductId();
            $amount = $request->getAmount();
            $userProductModel = new UserProduct();
            $result = $userProductModel->existProduct($productId, $userId,);
            if (empty($result)) {
                $userProductModel = new UserProduct();
                $userProductModel->addProduct($userId, $productId, $amount);
            } else {
                $userProductModel = new UserProduct();
                $userProductModel->updateAmount($userId, $productId, $amount);
            }
        }
        header("Location: /catalog");
    }
    public function deleteProduct(DeleteProductRequest $request)
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        }
        $errors = $request->validateDelete();
        $userId = $_SESSION['user_id'];
        if (empty($errors)) {
            $productId = $request->getProductId();
            $amount = $request->getAmount();
            $userProductModel = new UserProduct();
            $userProductModel->deleteProduct($userId, $productId, $amount);
        }
        header("Location: /cart");
    }
    public function getAddProduct()
    {
        require_once './../View/get_add_product.php';
    }
    public function getCart()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        }

        $userId = $_SESSION['user_id'];

        $productModel = new Product();
        $products = $productModel->getAllProductsByUserId($userId);

        require_once './../View/cart.php';
    }
}