<?php

namespace Model;

class Review extends Model
{
    private int $id;
    private int $productId;
    private int $userId;
    private string $name;
    private int $rating;
    private string $text;

    public static function create(int $productId, int $userId, string $name, int $rating, string $text): void
    {
        $stmt = self::getPdo()->prepare('INSERT INTO reviews (product_id, user_id, name, rating, text) VALUES (:product_id, :user_id, :name, :rating, :text)');
        $stmt->execute(['product_id' => $productId, 'user_id' => $userId, 'name' => $name, 'rating' => $rating, 'text' => $text]);
    }
    public static function getReviewsByProductId(int $productId): ?array
    {
        $stmt = self::getPdo()->prepare('SELECT * FROM reviews WHERE product_id = :product_id');
        $stmt->execute(['product_id' => $productId]);
        $result = $stmt->fetchAll();

        if ($result === false) {
            return null;
        }
        $reviews = [];

        foreach ($result as $row) {
            $review = new Review();
            $review->id = $row['id'];
            $review->productId = $row['product_id'];
            $review->userId = $row['user_id'];
            $review->name = $row['name'];
            $review->rating = $row['rating'];
            $review->text = $row['text'];
            $reviews[] = $review;
        }
        return $reviews;
    }
    public static function getAverageRatingByProductId(int $productId): float
    {
        $stmt = self::getPdo()->prepare('SELECT AVG(rating) AS average_rating FROM reviews WHERE product_id = :product_id');
        $stmt->execute(['product_id' => $productId]);
        $result = $stmt->fetch();

        if ($result['average_rating'] === false) {
            return 0.0;
        }
        return $result['average_rating'];
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getProductId(): int
    {
        return $this->productId;
    }
    public function getUserId(): int
    {
        return $this->userId;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getRating(): int
    {
        return $this->rating;
    }
    public function getText(): string
    {
        return $this->text;
    }
}