<?php

class UserRegistration
{
    private $errors = [];
public function validate(array $data)
{
    //$errors = [];
    // Валидация name
    if (isset($data['name'])) {
        $name = $data['name'];
        if (empty($name)) {
            $this->errors['name'] = 'Заполните поле Name.';
        } elseif (strlen($name) < 3 || strlen($name) > 15 || preg_match("/[0-9]/", $name)) {
            $this->errors['name'] = 'Name должен иметь от 3 до 15 символов, не включая цифр.';
        }
    } else {
        $this->errors['name'] = 'Name не указан.';
    }

    // Валидация email
    if (isset($data['email'])) {
        $email = $data['email'];
        if (empty($email)) {
            $this->errors['email'] = 'Заполните поле Email.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Введите корректный email.';
        } else {
            $pdo = new PDO("pgsql:host=db;port=5432;dbname=dbname", "dbuser", "dbpwd");
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            if ($stmt->fetchColumn() > 0) {
                $this->errors['email'] = 'Email уже зарегистрирован в системе.';
            }
        }
    } else {
        $this->errors['email'] = 'Email не указан';
    }

    //Валидация password
    if (isset($data['psw'])) {
        $psw = $data['psw'];
        if (empty($psw)) {
            $this->errors['psw'] = 'Заполните поле Password.';
        } elseif (strlen($psw) < 8 || strlen($psw) > 15 || !preg_match("/[A-Z]/", $psw) || !preg_match("/[0-9]/", $psw)) {
            $this->errors['psw'] = 'Password должен иметь от 8 до 15 символов, включать одну заглавную букву и цифру.';
        }
    } else {
        $this->errors['psw'] = 'Password не указан';
    }

    // Валидация repeat password
    if (isset($data['psw-repeat'])) {
        $pswRep = $data['psw-repeat'];
        if (empty($pswRep)) {
            $this->errors['psw-repeat'] = 'Заполните поле Repeat Password.';
        } elseif ($psw !== $pswRep) {
            $this->errors['psw-repeat'] = 'Пароли не совпадают.';
        }
    } else {
        $this->errors['psw-repeat'] = 'Repeat Password не указан';
    }

    return $this->errors;
}

//$errors = validate($_POST);

public function registerUser
{    if (empty($this->errors)) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $psw = $_POST['psw'];
        $pswRep = $_POST['psw-repeat'];

        $pswHashed = password_hash($psw, PASSWORD_DEFAULT);

        $pdo = new PDO("pgsql:host=db;port=5432;dbname=dbname", "dbuser", "dbpwd");

        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :psw)");
        $stmt->execute(['name' => $name, 'email' => $email, 'psw' => $pswHashed]);
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_LAZY);
        header("Location: /get_login.php");
    }
}

$userRegistration = new UserRegistration();
$errors = $userRegistration->validate($_POST);

require_once './get_registration.php';

?>