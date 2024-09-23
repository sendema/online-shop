<?php

namespace Controller;

use Model\UserProduct;
use Model\Product;

class CartController
{
    public function addProduct()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        }
        $errors = $this->validate($_POST);
        $userId = $_SESSION['user_id'];
        if (empty($errors)) {
            $productId = $_POST['product_id'];
            $amount = $_POST['amount'];
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
    public function deleteProduct()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        }
        $errors = $this->validateDelete($_POST);
        $userId = $_SESSION['user_id'];
        if (empty($errors)) {
            $productId = $_POST['product_id'];
            $amount = $_POST['amount'];
            $userProductModel = new UserProduct();
            $userProductModel->deleteProduct($userId, $productId, $amount);
        }
        header("Location: /cart");
    }
    public function getAddProduct()
    {
        require_once './../View/get_add_product.php';
    }
    private function validate(array $data)
    {
            $errors = [];
            if (isset($data['product_id'])) {
                $productId = $data['product_id'];
                if (empty($productId)) {
                    $errors['product_id'] = 'Id товара не может быть пустым.';
                } else {
                    $userProductModel = new UserProduct();
                    $result = $userProductModel->getIdProduct($data['product_id']);
                    if (empty($result)) {
                        $errors['product_id'] = 'Product_id не существует.';
                    }
                }
            } else {
                $errors['product_id'] = 'Product_id не указан.';
            }
            if (isset($data['amount'])) {
                $amount = $data['amount'];
                if (empty($amount) || $amount <= 0) {
                    $errors['amount'] = 'Количество товара должно быть больше 0.';
                }
            } else {
                $errors['amount'] = 'Amount не указан.';
            }
            return $errors;
    }
    private function validateDelete(array $data) {
        $errors = [];
        if (isset($data['product_id'])) {
            $productId = $data['product_id'];
            if (empty($productId)) {
                $errors['product_id'] = 'Id товара не может быть пустым.';
            }
        } else {
            $errors['product_id'] = 'Product_id не указан.';
        }
        return $errors;
    }
    public function getCart()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        }

        $userId = $_SESSION['user_id'];

        $userProductModel = new UserProduct();
        $userProducts = $userProductModel->getAllByUserId($userId);

        $productModel = new Product();
        $products = [];
        foreach ($userProducts as $userProduct) {
            $product = $productModel->getOneByProductId($userProduct['product_id']);
            $product['amount'] = $userProduct['amount'];

            $products[] = $product;
        }

        require_once './../View/cart.php';
    }
}