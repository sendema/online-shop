<?php

namespace Controller;
use Model\User;
use Request\LoginRequest;
use Request\RegistrateRequest;
use Service\AuthService;

class UserController
{
    private AuthService $authService;
    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function registrate(RegistrateRequest $request)
    {
        $errors = $request->validate();
        if (empty($errors)) {
            $name = $request->getName();
            $email = $request->getEmail();
            $psw = $request->getPsw();
            $pswRep = $request->getPswRepeat();

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
    public function login(LoginRequest $request)
    {
        $errors = $request->validateLog();
        if (empty($errors)) {
            $username = $request->getUsername();
            $password = $request->getPassword();

            $userModel = new User();
            $user = $userModel->getOneByEmail($username);

            $authService = new AuthService();
            $result = $authService->login($username, $password);

            if ($result) {
                header("Location: /catalog");
            } else {
                $errors['username'] = 'Email or Password is incorrect';
            }

            require_once './../View/get_login.php';
        }
    }
}