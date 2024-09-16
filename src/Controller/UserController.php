<?php

require_once './../Model/User.php';
class UserController
{
    public function registrate()
    {
        $errors = $this->validate($_POST);
        if (empty($errors)) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $psw = $_POST['psw'];
            $pswRep = $_POST['psw-repeat'];

            $pswHashed = password_hash($psw, PASSWORD_DEFAULT);

            $userModel = new User();

            $userModel->create($name, $email, $pswHashed);

            $userModel->getOneByEmail($email);

            header("Location: /login");
        }
        require_once './../View/get_registration.php';
    }

    public function getRegistrate()
    {
        require_once './../View/get_registration.php';
    }
    public function getLogin()
    {
        require_once './../View/get_login.php';
    }
    public function login()
    {
        $errors = $this->validateLog($_POST);

        if (empty($errors)) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userModel = new User();
            $result = $userModel->getOneByEmail($username);

            if (empty($result)) {
                $errors['username'] = 'Email or Password is incorrect';
            } else {
                if (password_verify($password, $result['password'])) {
                    session_start();
                    $_SESSION['user_id'] = $result['id'];
                    header("Location: /catalog");
                } else {
                    $errors['password'] = 'Email or Password is incorrect';
                }
            }
        }
        require_once './../View/get_login.php';

    }
    private function validate(array $data)
    {
        $errors = [];
        // Валидация name
        if (isset($data['name'])) {
            $name = $data['name'];
            if (empty($name)) {
                $errors['name'] = 'Заполните поле Name.';
            } elseif (strlen($name) < 3 || strlen($name) > 15 || preg_match("/[0-9]/", $name)) {
                $errors['name'] = 'Name должен иметь от 3 до 15 символов, не включая цифр.';
            }
        } else {
            $errors['name'] = 'Name не указан.';
        }

        // Валидация email
        if (isset($data['email'])) {
            $email = $data['email'];
            if (empty($email)) {
                $errors['email'] = 'Заполните поле Email.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Введите корректный email.';
            } else {
                $userModel = new User();
                $result = $userModel->getOneByEmail($data['email']);
                if (!empty($result)) {
                    $errors['email'] = 'Email уже зарегистрирован в системе.';
                }
            }
        } else {
            $errors['email'] = 'Email не указан';
        }

        //Валидация password
        if (isset($data['psw'])) {
            $psw = $data['psw'];
            if (empty($psw)) {
                $errors['psw'] = 'Заполните поле Password.';
            } elseif (strlen($psw) < 8 || strlen($psw) > 15 || !preg_match("/[A-Z]/", $psw) || !preg_match("/[0-9]/", $psw)) {
                $errors['psw'] = 'Password должен иметь от 8 до 15 символов, включать одну заглавную букву и цифру.';
            }
        } else {
            $errors['psw'] = 'Password не указан';
        }

        // Валидация repeat password
        if (isset($data['psw-repeat'])) {
            $pswRep = $data['psw-repeat'];
            if (empty($pswRep)) {
                $errors['psw-repeat'] = 'Заполните поле Repeat Password.';
            } elseif ($psw !== $pswRep) {
                $errors['psw-repeat'] = 'Пароли не совпадают.';
            }
        } else {
            $errors['psw-repeat'] = 'Repeat Password не указан';
        }
        return $errors;
    }

    private function validateLog(array $data)
    {
        $errors = [];
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
}