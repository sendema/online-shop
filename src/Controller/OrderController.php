<?php

require_once './../Model/User.php';
require_once './../Model/Order.php';
require_once './../Model/UserProduct.php';

class OrderController
{
    public function getOrder()
    {
        require_once './../View/get_order.php';
    }
    public function order()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        }
        $userId = $_SESSION['user_id'];
        $errors = $this->validate($_POST);
        if (empty($errors)) {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $comment = $_POST['comment'];

            $orderModel = new Order();
            $orderId = $orderModel->create($name, $phone, $address, $comment);

            $orderModel = new UserProduct();
            $result = $orderModel->getAllByUserId($userId);

            $pdo = new PDO("pgsql:host=db;port=5432;dbname=dbname", "dbuser", "dbpwd");

            foreach ($result as $userProduct) {
                $stmt = $pdo->prepare("INSERT INTO orders_products (order_id, product_id, amount) VALUES (:order_id, :product_id, :amount)");
                $stmt->execute(['order_id' => $orderId, 'product_id' => $userProduct['product_id'], 'amount' => $userProduct['amount']]);
            }

            //$orderModel = new UserProduct();
            //$orderModel->clearCart();
            $stmt = $pdo->prepare("DELETE FROM user_products WHERE user_id = :userId");
            $stmt->execute(['userId' => $userId]);

            header("Location: /catalog");
        }
        require_once './../View/get_order.php';
    }
    private function validate(array $data)
    {
        $errors = [];
        if (isset($data['name'])) {
            $name = $data['name'];
            if (empty($name)) {
                $errors['name'] = 'Имя не может быть пустым.';
            } elseif (strlen($name) < 3 || strlen($name) > 15 || preg_match("/[0-9]/", $name)) {
                $errors['name'] = 'Имя должно иметь от 3 до 15 символов, не включая цифр.';
            }
        } else {
            $errors['name'] = 'Name не указан.';
        }
        if (isset($data['phone'])) {
            $phone = $data['phone'];
            if (empty($phone)) {
                $errors['phone'] = 'Телефон не может быть пустым.';
            }
        } else {
            $errors['phone'] = 'Phone не указан.';
        }
        if (isset($data['address'])) {
            $address = $data['address'];
            if (empty($address)) {
                $errors['address'] = 'Адрес не может быть пустым.';
            }
        } else {
            $errors['address'] = 'Address не указан.';
        }
        return $errors;
    }
}
