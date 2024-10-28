<?php

namespace Service\Auth;

use Model\User;

class AuthSessionService implements AuthServiceInterface
{
    public function login(string $email, string $password): bool
    {
        $result = User::getOneByEmail($email);
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
        return User::getOneById($_SESSION['user_id']);
    }

    public function check(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user_id']);
    }

}