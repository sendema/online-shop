<?php

namespace Controller;
use Model\User;
use Request\LoginRequest;
use Request\RegistrateRequest;
use Service\Auth\AuthServiceInterface;

class UserController
{
    private AuthServiceInterface $authService;
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
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

            User::create($name, $email, $pswHashed);

            User::getOneByEmail($email);

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

            User::getOneByEmail($username);

            $result = $this->authService->login($username, $password);

            if ($result) {
                header("Location: /catalog");
            } else {
                $errors['username'] = 'Email or Password is incorrect';
            }

            require_once './../View/get_login.php';
        }
    }
}