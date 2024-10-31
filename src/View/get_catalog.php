<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог товаров</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="text-right mb-3">
        <a href="/homePage" class="btn btn-primary">Главная страница</a>
        <a href="/myOrders" class="btn btn-primary">Мои заказы</a>
        <a href="/cart" class="btn btn-primary">Корзина</a>
    </div>

    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <form action="/productInfo" method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?php echo $product->getId(); ?>">
                        <button type="submit" class="btn btn-link p-0 border-0">
                            <img class="card-img-top" src="<?php echo $product->getImage(); ?>" alt="Card image" width="500" height="250">
                        </button>
                        <div class="card-body">
                            <button type="submit" class="btn btn-link p-0 border-0">
                                <h5 class="card-title"><?php echo $product->getTitle(); ?></h5>
                            </button>
                            <div class="card-footer">
                                <?php echo $product->getPrice() . ' руб.'; ?>
                            </div>
                        </div>
                    </form>
                    <form action="/addProduct" method="POST" class="d-inline">
                        <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>" required>
                        <input type="number" name="amount" min="1" required>
                        <button type="submit" class="btn btn-success">+</button>
                    </form>
                    <form action="/deleteProduct" method="POST" class="d-inline">
                        <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>" required>
                        <input type="number" name="amount" min="1" required>
                        <button type="submit" class="btn btn-danger">-</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<style>
    body {
        font-family: sans-serif;
    }

    a {
        text-decoration: none;
    }

    a:hover {
        text-decoration: none;
    }

    h3 {
        line-height: 3em;
    }

    .card {
        max-width: 35rem;
        margin-bottom: 20px;
    }

    .card:hover {
        box-shadow: 1px 2px 10px lightgrey;
        transition: 0.2s;
    }

    .card-header {
        font-size: 15px;
        color: lightgrey;
        background-color: white;
    }

    .text-muted {
        font-size: 15px;
    }

    .card-footer {
        font-weight: bold;
        font-size: 15px;
        background-color: white;
    }

    .button-group .btn {
        margin-right: 10px;
    }
</style>