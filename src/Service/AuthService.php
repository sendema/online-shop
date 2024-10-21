<?php

namespace Service;

use Model\User;

class AuthService
{
    private User $user;
    public function __construct(User $user)
    {
        $this->user = new User();
    }
    public function login(string $email, string $password): bool
    {
        $userModel = new User();
        $result = $userModel->getOneByEmail($email);
        if (empty($result)) {
            return false;
        }
        if (password_verify($password, $result->getPassword())) {
            session_start();
            $_SESSION['user_id'] = $result->getId();
            return true;
        }
        return false;
    }
    public function getCurrentUser(): User
    {

    }
}