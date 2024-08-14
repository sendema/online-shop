<?php

$name = $_POST['name'];
$email = $_POST['email'];
$psw = $_POST['psw'];
$pswRep = $_POST['psw-repeat'];

$pdo = new PDO("pgsql:host=db;port=5432;dbname=dbname", "dbuser", "dbpwd");
function validate($name, $email, $psw, $pswRep, $pdo)
{
    $errors = [];

    // Валидация name
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    } else {
        $errors['name'] = 'Name не указан.';
    }
    if (empty($name)) {
        $errors['name'] = 'Заполните поле Name.';
    }
    if (strlen($name) < 3 || strlen($name) > 15 || preg_match("/[0-9]/", $name)) {
        $errors['name'] = 'Name должен иметь от 3 до 15 символов, не включая цифр.';
    }

    // Валидация email
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $errors['email'] = 'Email не указан';
    }
    if (empty($email)) {
        $errors['email'] = 'Заполните поле Email.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Введите корректный email.';
    } else {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetchColumn() > 0) {
            $errors['email'] = 'Email уже зарегистрирован в системе.';
        }
    }

    //Валидация password
    if (isset($_POST['psw'])) {
        $psw = $_POST['psw'];
    } else {
        $errors['psw'] = 'Password не указан';
    }
    if (empty($psw)) {
        $errors['psw'] = 'Заполните поле Password.';
    }
    if (strlen($psw) < 8 || strlen($psw) > 15 || !preg_match("/[A-Z]/", $psw) || !preg_match("/[0-9]/", $psw)) {
        $errors['psw'] = 'Password должен иметь от 8 до 15 символов, включать одну заглавную букву и цифру.';
    }

    // Валидация repeat password
    if (isset($_POST['psw-repeat'])) {
        $psw = $_POST['psw-repeat'];
    } else {
        $errors['psw-repeat'] = 'Repeat Password не указан';
    }
    if (empty($pswRep)) {
        $errors['psw-repeat'] = 'Заполните поле Repeat Password.';
    }
    if ($psw !== $pswRep) {
        $errors['psw-repeat'] = 'Пароли не совпадают.';
    }
    return $errors;
}

$errors = validate($name, $email, $psw, $pswRep, $pdo);

if (empty($errors)) {
    $pswHashed = password_hash($psw, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :psw)");
    $stmt->execute(['name' => $name, 'email' => $email, 'psw' => $pswHashed]);
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $result = $stmt->fetch(PDO::FETCH_LAZY);
    echo 'Регистрация прошла успешно! Пользователь с email: '. $result->email . ' зарегистрирован!';
} else {
    echo 'Ошибка регистрации';
}

require_once './get_registration.php';
?>

    /*$pdo = new PDO("pgsql:host=db;port=5432;dbname=dbname", "dbuser", "dbpwd");

    $psw = password_hash($psw, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :psw)");
    $stmt->execute(['name' => $name, 'email' => $email, 'psw' => $psw]);
    $stmt = $pdo->query("SELECT * FROM users WHERE email = '{$email}'");
    $result = $stmt->fetch();
    print_r($result);

/*if (empty($errors)) {
//$pdo->exec("");
    $stmt = $pdo->query("SELECT * FROM users WHERE email = '{$email}'");
    $result = $stmt->fetch();
    print_r($result);
} else {
    print_r($errors);
}
function emailExist($email) {
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :$email");}
$stmt->execute('email' => $email);
if
}*/
//require_once './get_registration.php';
// echo $errors['name'];
?>