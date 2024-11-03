<?php

namespace Service;

use Model\Order;
use Model\Review;

class ReviewService
{
    public function create(int $productId, int $userId, string $name, int $rating, string $text)
    {
        $result = Order::checkUserHasOrderedProduct($userId, $productId);
        if ($result) {
            Review::create($productId, $userId, $name, $rating, $text);
            header("Location: /catalog");
        } else {
            http_response_code(404);
            require_once './../View/404.php';
        }
    }

}