<?php

namespace Service;

use Model\User;

class AuthService
{
    private User $user;
    public function __construct()
    {
        $this->user = new User();
    }
    public function login(string $email, string $password): bool
    {
        $result = $this->user->getOneByEmail($email);
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
    public function getCurrentUser(): ?User
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            return null;
        }
        return $this->user->getOneById($_SESSION['user_id']);
    }

    public function check(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user_id']);
    }
}