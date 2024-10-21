<!--<div class="container">-->
<!--    <h3>Каталог</h3>-->
<!--    <div class="card-deck">-->
<!--        --><?php //foreach($products as $product): ?>
<!--            <div class="card text-center">-->
<!--                <a href="#">-->
<!--                    <div class="card-header">-->
<!--                    </div>-->
<!--                    <img class="card-img-top" src="--><?php //echo $product->getImage(); ?><!--" alt="Card image" width="500">-->
<!--                    <div class="card-body">-->
<!--                        <p class="card-text text-muted">--><?php //echo $product->getDescription(); ?><!--</p>-->
<!--                        <a href="#"><h5 class="card-title">--><?php //echo $product->getTitle(); ?><!--</h5></a>-->
<!--                        <div class="card-footer">-->
<!--                            --><?php //echo $product->getPrice() . ' руб.'; ?>
<!--                        </div>-->
<!--                    </div>-->
<!--                </a>-->
<!--            </div>-->
<!--        <form action="/addProduct" method="POST">-->
<!--            <input type="hidden" id="product_id" name="product_id" value="--><?php //echo $product->getId(); ?><!--" required>-->
<!--            <input type="text" id="amount" name="amount" required>-->
<!--            <button type="submit" class="registerbtn">+</button>-->
<!--        </form>-->
<!--        <form action="/deleteProduct" method="POST">-->
<!--                <input type="hidden" id="product_id" name="product_id" value="--><?php //echo $product->getId(); ?><!--" required>-->
<!--                <input type="text" id="amount" name="amount" required>-->
<!--                <button type="submit" class="registerbtn">-</button>-->
<!--        </form>-->
<!---->
<!--        --><?php //endforeach; ?>
<!--        <a href="/cart" class="cart-button">Перейти в корзину</a>-->
<!--    </div>-->
<!--</div>-->
<!--<style>-->
<!--            body {-->
<!--                font-style: sans-serif;-->
<!--            }-->
<!---->
<!--            a {-->
<!--                text-decoration: none;-->
<!--            }-->
<!---->
<!--            a:hover {-->
<!--                text-decoration: none;-->
<!--            }-->
<!---->
<!--            h3 {-->
<!--                line-height: 3em;-->
<!--            }-->
<!---->
<!--            .card {-->
<!--                max-width: 35rem;-->
<!--            }-->
<!---->
<!--            .card:hover {-->
<!--                box-shadow: 1px 2px 10px lightgrey;-->
<!--                transition: 0.2s;-->
<!--            }-->
<!---->
<!--            .card-header {-->
<!--                font-size: 15px;-->
<!--                color: gray;-->
<!--                background-color: white;-->
<!--            }-->
<!---->
<!--            .text-muted {-->
<!--                font-size: 15px;-->
<!--            }-->
<!---->
<!--            .card-footer{-->
<!--                font-weight: bold;-->
<!--                font-size: 15px;-->
<!--                background-color: white;-->
<!--            }-->
<!--</style>-->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог товаров</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
            color: gray;
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
</head>
<body>

<div class="container">
    <div class="text-right mb-3">
        <a href="/orderDetails" class="btn btn-primary">Мои заказы</a>
        <a href="/cart" class="btn btn-primary">Корзина</a>
    </div>

    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <a href="#">
                        <div class="card-header">

                        </div>
                        <img class="card-img-top" src="<?php echo $product->getImage(); ?>" alt="Card image" width="500">
                        <div class="card-body">
                            <p class="card-text text-muted"><?php echo $product->getDescription(); ?></p>
                            <a href="#"><h5 class="card-title"><?php echo $product->getTitle(); ?></h5></a>
                            <div class="card-footer">
                                <?php echo $product->getPrice() . ' руб.'; ?>
                            </div>
                        </div>
                    </a>
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