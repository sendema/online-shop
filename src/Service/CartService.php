<?php

namespace Service;

use Model\UserProduct;

class CartService
{
    private UserProduct $userProduct;
    public function __construct()
    {
        $this->userProduct = new UserProduct();
    }
    public function addProduct(int $userId, int $productId, int $amount)
    {
        $result = $this->userProduct->existProduct($productId, $userId,);
        if (empty($result)) {
            $this->userProduct->addProduct($userId, $productId, $amount);
        } else {
            $this->userProduct->updateAmount($userId, $productId, $amount);
        }
    }
}