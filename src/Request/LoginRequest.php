<?php

namespace Request;

class LoginRequest
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
    public function getUsername(): ?string
    {
        return $this->data['username'] ?? null;
    }
    public function getPassword(): ?string
    {
        return $this->data['password'] ?? null;
    }
    public function validateLog(): array
    {
        $errors = [];
        if (isset($this->data['username'])) {
            $username = $this->data['username'];
            if (empty($username)) {
                $errors['username'] = 'Заполните поле Username.';
            }
        } else {
            $errors['username'] = 'Username не указан.';
        }

        if (isset($this->data['password'])) {
            $password = $this->data['password'];
            if (empty($password)) {
                $errors['password'] = 'Заполните поле Password.';
            }
        } else {
            $errors['password'] = 'Password не указан.';
        }
        return $errors;
    }
}