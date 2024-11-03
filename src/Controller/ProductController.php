<?php

namespace Controller;
use Model\Product;
use Model\Order;
use Model\Review;
use Request\AddReviewRequest;
use Request\ProductInfoRequest;
use Service\Auth\AuthServiceInterface;
use Service\ReviewService;

class ProductController
{
    private AuthServiceInterface  $authService;
    private ReviewService $reviewService;
    public function __construct(
        AuthServiceInterface $authService,
        ReviewService $reviewService)
    {
        $this->authService = $authService;
        $this->reviewService = $reviewService;
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

            $this->reviewService->create($productId, $userId, $name, $rating, $text);
        }
        require_once './../View/get_review.php';
    }
}