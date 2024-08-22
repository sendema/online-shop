<?php

class UserLogin {
    private $errors = [];
public function validateLog(array $data)
{
    //$errors = [];

    if (isset($data['username'])) {
        $username = $data['username'];
        if (empty($username)) {
            $errors['username'] = 'Заполните поле Username.';
        }
    } else {
        $errors['username'] = 'Username не указан.';
    }

    if (isset($data['password'])) {
        $password = $data['password'];
        if (empty($password)) {
            $errors['password'] = 'Заполните поле Password.';
        }
    } else {
        $errors['password'] = 'Password не указан.';
    }
    return $errors;
}

$errors = validateLog($_POST);

if (empty($errors)) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $pdo = new PDO("pgsql:host=db;port=5432;dbname=dbname", "dbuser", "dbpwd");

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $username]);
    $result = $stmt->fetch();

    if (empty($result)) {
        $errors['username'] = 'Email or Password incorrect';
    } else {
        if (password_verify($password, $result['password'])) {
            session_start();
            $_SESSION['user_id'] = $result['id'];
            header("Location: /catalog.php");
        } else {
            $errors['password'] = 'Email or Password incorrect';
        }
    }
}

require_once './get_login.php';

?>