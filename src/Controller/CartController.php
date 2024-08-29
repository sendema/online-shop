<?php
class CartController
{
    public function cart()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /get_login.php");
        }
        $errors = $this->validate($_POST);
        $user_id = $_SESSION['user_id'];
        if (empty($errors)) {
            $product_id = $_POST['product_id'];
            $amount = $_POST['amount'];
            $userProductModel = new UserProduct();
            $result = $userProductModel->existProduct($product_id);
            if (empty($result)) {
                $userProductModel = new UserProduct();
                $userProductModel->addProduct($user_id, $product_id, $amount);
            } else {
                $userProductModel = new UserProduct();
                $userProductModel->updateAmount($user_id, $product_id, $amount);
            }
        }
        require_once './../View/get_add_product.php';
    }
    private function validate(array $data)
    {
        {
            $errors = [];
            if (isset($data['product_id'])) {
                $product_id = $data['product_id'];
                if (empty($product_id)) {
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
    }
}