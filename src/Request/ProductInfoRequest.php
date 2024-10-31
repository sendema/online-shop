<?php

namespace Request;

class ProductInfoRequest
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
    public function validate(): array
    {
        $errors = [];

        if (isset($this->data['id'])) {
            $productId = $this->data['id'];
        } else {
            $errors['id'] = "Product_id is required.";
        }

        return $errors;
    }
}