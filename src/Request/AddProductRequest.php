<?php

namespace Request;

use Model\UserProduct;

class AddProductRequest
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
    public function getProductId(): ?int
    {
        return $this->data['product_id'] ?? null;
    }
    public function getAmount(): ?int
    {
        return $this->data['amount'] ?? null;
    }
    public function validate(): array
    {
        $errors = [];
        if (isset($this->data['product_id'])) {
            $productId = $this->data['product_id'];
            if (empty($productId)) {
                $errors['product_id'] = 'Id товара не может быть пустым.';
            } else {
                $userProductModel = new UserProduct();
                $result = $userProductModel->getIdProduct($this->data['product_id']);
                if (empty($result)) {
                    $errors['product_id'] = 'Product_id не существует.';
                }
            }
        } else {
            $errors['product_id'] = 'Product_id не указан.';
        }
        if (isset($this->data['amount'])) {
            $amount = $this->data['amount'];
            if (empty($amount) || $amount <= 0) {
                $errors['amount'] = 'Количество товара должно быть больше 0.';
            }
        } else {
            $errors['amount'] = 'Amount не указан.';
        }
        return $errors;
    }
}