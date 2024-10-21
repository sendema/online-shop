<?php

namespace Request;

class OrderRequest
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
    public function getPhone(): ?string
    {
        return $this->data['phone'] ?? null;
    }
    public function getAddress(): ?string
    {
        return $this->data['address'] ?? null;
    }
    public function getComment(): ?string
    {
        return $this->data['comment'] ?? null;
    }
    public function validate(): array
    {
        $errors = [];
        if (isset($this->data['name'])) {
            $name = $this->data['name'];
            if (empty($name)) {
                $errors['name'] = 'Имя не может быть пустым.';
            } elseif (strlen($name) < 3 || strlen($name) > 15 || preg_match("/[0-9]/", $name)) {
                $errors['name'] = 'Имя должно иметь от 3 до 15 символов, не включая цифр.';
            }
        } else {
            $errors['name'] = 'Name не указан.';
        }
        if (isset($this->data['phone'])) {
            $phone = $this->data['phone'];
            if (empty($phone)) {
                $errors['phone'] = 'Телефон не может быть пустым.';
            }
        } else {
            $errors['phone'] = 'Phone не указан.';
        }
        if (isset($this->data['address'])) {
            $address = $this->data['address'];
            if (empty($address)) {
                $errors['address'] = 'Адрес не может быть пустым.';
            }
        } else {
            $errors['address'] = 'Address не указан.';
        }
        return $errors;
    }
}