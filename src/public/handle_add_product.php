<?php
function validate(array $data)
{
    $errors = [];

    if (isset($data['product_id'])) {
        $product_id = $data['product_id'];
        if (empty($product_id)) {
            $errors['product_id'] = 'Id товара не может быть пустым.';
        } else {
            $pdo = new PDO("pgsql:host=db;port=5432;dbname=dbname", "dbuser", "dbpwd");
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM products WHERE id_product = :id_product");
            $stmt->execute(['id_product' => $product_id]);
            $result = $stmt->fetchColumn();
            if ($result <= 0) {
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

    $errors = validate($_POST);

    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: /get_login.php");
    }

    $user_id = $_SESSION['user_id'];

    if (empty($errors)) {

        $product_id = $_POST['product_id'];
        $amount = $_POST['amount'];

        $pdo = new PDO("pgsql:host=db;port=5432;dbname=dbname", "dbuser", "dbpwd");

        $stmt = $pdo->prepare("INSERT INTO user_products (user_id, product_id, amount) VALUES (:user_id, :product_id, :amount)");
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id, 'amount' => $amount]);
    }
/*function checkExistProduct() {
        $pdo = new PDO("pgsql:host=db;port=5432;dbname=dbname", "dbuser", "dbpwd");
        $stmt = $pdo->prepare("SELECT amount FROM user_products WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute('user_id' => $user_id, 'product_id' => $product_id);
        $existProduct = $stmt->fetch();
        if ()
    }*/

require_once './get_add_product.php';