<?php

namespace Controller;
use Model\Product;
use Model\Order;
use Model\Review;
use Request\AddReviewRequest;
use Request\ProductInfoRequest;
use Service\Auth\AuthServiceInterface;

class ProductController
{
    private AuthServiceInterface  $authService;
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }
    public function catalog()
    {
        if (!$this->authService->check()) {
            header("Location: /login");
        }

        $products = Product::getAll();

        require_once './../View/get_catalog.php';
    }
    public function productInfo(ProductInfoRequest $request)
    {
        if (!$this->authService->check()) {
            header("Location: /login");
        }
        $errors = $request->validate();
        if (empty($errors)) {
            $id = $request->getId();

            $product = Product::getProductInfoById($id);
            $reviews = Review::getReviewsByProductId($id);
            if (!empty($reviews)) {
                $averageRating = Review::getAverageRatingByProductId($id);
            }
        }
        require_once './../View/get_product_info.php';
    }
    public function addReview(AddReviewRequest $request)
    {
        if (!$this->authService->check()) {
            header("Location: /login");
        }
        $userId = $this->authService->getCurrentUser()->getId();

        $errors = $request->validate();

        if (empty($errors)) {
            $productId = $request->getProductId();
            $name = $request->getName();
            $rating = $request->getRating();
            $text = $request->getText();

            $result = Order::checkUserHasOrderedProduct($userId, $productId);
            if ($result) {
                Review::create($productId, $userId, $name, $rating, $text);
                header("Location: /catalog");
            } else {
                http_response_code(500);
                require_once './../View/500.php';
            }
        }
        require_once './../View/get_review.php';
    }
}