<?php

namespace Service;

use Model\UserProduct;

class CartService
{
    public function addProduct(int $userId, int $productId, int $amount)
    {
        $result = UserProduct::existProduct($productId, $userId,);
        if (empty($result)) {
            UserProduct::addProduct($userId, $productId, $amount);
        } else {
            UserProduct::updateAmount($userId, $productId, $amount);
        }
    }
}