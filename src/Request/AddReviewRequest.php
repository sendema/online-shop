<?php

namespace Request;

use Model\Product;
use Model\User;

class AddReviewRequest
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
    public function getId(): ?int
    {
        return $this->data['id'] ?? null;
    }
    public function getProductId(): ?int
    {
        return $this->data['product_id'] ?? null;
    }
    public function getUserId(): ?int
    {
        return $this->data['user_id'] ?? null;
    }
    public function getName(): ?string
    {
        return $this->data['name'] ?? null;
    }
    public function getRating(): ?int
    {
        return $this->data['rating'] ?? null;
    }
    public function getText(): ?string
    {
        return $this->data['text'] ?? null;
    }
    public function validate(): array
    {
        $errors = [];
        if (isset($this->data['product_id'])) {
            $productId = $this->data['product_id'];
        } else {
                $errors['product_id'] = "Product_id is required.";
        }
        if (isset($this->data['user_id'])) {
            $userId = $this->data['user_id'];
        } else {
            $errors['user_id'] = "User_id is required.";
        }
        if (isset($this->data['name'])) {
            $name = $this->data['name'];
        } else {
            $errors['name'] = 'Имя не может быть пустым.';
        }
        if (isset($this->data['text'])) {
            $text = $this->data['text'];
        } else {
            $errors['text'] = 'Отзыв не может быть пустым.';
        }
        if (isset($this->data['rating'])) {
            $rating = $this->data['rating'];
        } else {
            $errors['rating'] = 'Оцените товар от 1 до 5.';
        }
        return $errors;
    }
}