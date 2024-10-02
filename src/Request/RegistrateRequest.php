<?php

namespace Request;

use Model\User;

class RegistrateRequest
{
    private string $method;
    private string $uri;
    private array $data;

    public function __construct(string $method, string $uri, array $data)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->data = $data;
    }
    public function getData(): array
    {
        return $this->data;
    }
    public function getName(): ?string
    {
        return $this->data['name'] ?? null;
    }
    public function getEmail(): ?string
    {
        return $this->data['email'] ?? null;
    }
    public function getPsw(): ?string
    {
        return $this->data['psw'] ?? null;
    }
    public function getPswRepeat(): ?string
    {
        return $this->data['psw-repeat'] ?? null;
    }
    public function validate(): array
    {
        $errors = [];
        if (isset($this->data['name'])) {
            $name = $this->data['name'];
            if (empty($name)) {
                $errors['name'] = 'Заполните поле Name.';
            } elseif (strlen($name) < 3 || strlen($name) > 15 || preg_match("/[0-9]/", $name)) {
                $errors['name'] = 'Name должен иметь от 3 до 15 символов, не включая цифр.';
            }
        } else {
            $errors['name'] = 'Name не указан.';
        }

        if (isset($this->data['email'])) {
            $email = $this->data['email'];
            if (empty($email)) {
                $errors['email'] = 'Заполните поле Email.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Введите корректный email.';
            } else {
                $userModel = new User();
                $result = $userModel->getOneByEmail($this->data['email']);
                if (!empty($result)) {
                    $errors['email'] = 'Email уже зарегистрирован в системе.';
                }
            }
        } else {
            $errors['email'] = 'Email не указан';
        }

        if (isset($this->data['psw'])) {
            $psw = $this->data['psw'];
            if (empty($psw)) {
                $errors['psw'] = 'Заполните поле Password.';
            } elseif (strlen($psw) < 8 || strlen($psw) > 15 || !preg_match("/[A-Z]/", $psw) || !preg_match("/[0-9]/", $psw)) {
                $errors['psw'] = 'Password должен иметь от 8 до 15 символов, включать одну заглавную букву и цифру.';
            }
        } else {
            $errors['psw'] = 'Password не указан';
        }

        if (isset($this->data['psw-repeat'])) {
            $pswRep = $this->data['psw-repeat'];
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
}