<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Информация о товаре</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <a href="/catalog" class="catalog-link"> В каталог</a>
            <img src="<?php echo $product->getImage(); ?>" alt="Product Image" class="product-img">
        </div>
        <div class="col-md-6 product-info">
            <h1 class="product-title"><?php echo $product->getTitle(); ?></h1>
            <p class="product-description-label">Описание товара:</p>
            <p class="product-description"><?php echo $product->getDescription(); ?></p>
            <div class="product-price">Цена: <?php echo $product->getPrice(); ?> руб.</div>
            <form action="/addProduct" method="POST" class="mt-4">
                <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>">
                <div class="form-group">
                    <label for="amount">Количество:</label>
                    <input type="number" id="amount" name="amount" class="form-control" min="1" required>
                </div>
                <button type="submit" class="btn btn-success btn-cart">Добавить в корзину</button>
            </form>
        </div>
    </div>

    <div class="reviews-section">
        <h2>Отзывы</h2>
        <?php if (empty($reviews)): ?>
            <p>Отзывов пока нет.</p>
        <?php else: ?>

            <div class="average-rating">
                Средняя оценка: <?php echo number_format($averageRating, 1); ?> из 5
            </div>
            <?php foreach ($reviews as $review): ?>
                <div class="review">
                    <div class="review-rating">Оценка: <?php echo $review->getRating(); ?> из 5</div>
                    <p><?php echo $review->getText(); ?></p>
                    <div class="review-author">Автор: <?php echo $review->getName(); ?></div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <form action="/addReview" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>">
            <button type="submit" class="btn btn-primary btn-review">Оставить отзыв</button>
        </form>
    </div>
</div>
</body>
</html>
<style>
    body {
        font-family: sans-serif;
    }

    .container {
        margin-top: 30px;
    }

    .product-img {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .product-info {
        padding: 20px;
    }

    .product-title {
        font-size: 2rem;
        font-weight: bold;
    }

    .product-description-label {
        font-size: 1.2rem;
        font-weight: bold;
        margin-top: 20px;
        color: #333;
    }

    .product-description {
        font-size: 1.1rem;
        margin-top: 5px;
        color: #555;
    }

    .product-price {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
        margin-top: 20px;
    }

    .btn-cart {
        margin-top: 20px;
        font-size: 1.2rem;
    }

    .reviews-section {
        margin-top: 40px;
    }

    .average-rating {
        font-size: 1.5rem;
        font-weight: bold;
        color: #007bff;
        margin-bottom: 20px;
    }

    .review {
        margin-bottom: 18px;
        padding: 15px;
        border: 1px solid #eaeaea;
        border-radius: 5px;
    }

    .review-rating {
        font-weight: bold;
        color: #007bff;
    }

    .review-author {
        font-size: 0.9rem;
        color: #333;
    }

    .btn-review {
        margin-top: 20px;
        font-size: 1.2rem;
    }
</style>