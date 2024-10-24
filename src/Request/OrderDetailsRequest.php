<?php

namespace Request;

class OrderDetailsRequest
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
    public function getOrderId(): ?int
    {
        return $this->data['order_id'] ?? null;
    }
    public function validate(): array
    {
        $errors = [];

        if (isset($this->data['order_id'])) {
            $orderId = $this->data['order_id'];
        } else {
            $errors['order_id'] = "Order_id is required.";
        }

        return $errors;
    }
}