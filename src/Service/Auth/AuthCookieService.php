<?php

namespace Service\Auth;

use Model\User;

class AuthCookieService implements AuthServiceInterface
{
    public function login(string $email, string $password): bool
    {
        $result = User::getOneByEmail($email);
        if (empty($result)) {
            return false;
        }
        if (password_verify($password, $result->getPassword())) {
            setcookie('user_id', $result->getId());
            return true;
        }
        return false;
    }
    public function getCurrentUser(): ?User
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_COOKIE['user_id'])) {
            return null;
        }
        return User::getOneById($_COOKIE['user_id']);
    }

    public function check(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_COOKIE['user_id']);
    }
}