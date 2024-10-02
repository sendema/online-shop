<?php

namespace Request;

class DeleteProductRequest
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
    public function validateDelete(): array
    {
        $errors = [];
        if (isset($this->data['product_id'])) {
            $productId = $this->data['product_id'];
            if (empty($productId)) {
                $errors['product_id'] = 'Id товара не может быть пустым.';
            }
        } else {
            $errors['product_id'] = 'Product_id не указан.';
        }
        return $errors;
    }

}