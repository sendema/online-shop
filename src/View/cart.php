<!--<div class="container">-->
<!--    <h1>Корзина</h1>-->
<!--    <div class="card-deck">-->
<!--        --><?php //foreach($products as $product): ?>
<!--        <form action="/order" method="POST">-->
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
<!--                        --><?php //echo 'Количество: ' . $product->getAmount() . ' шт.'; ?>
<!--                    </div>-->
<!--                        <button type="submit" class="registerbtn">Оформить заказ</button>-->
<!--                </a>-->
<!--            </div>-->
<!--        </form>-->
<!--        --><?php //endforeach; ?>
<!--    </div>-->
<!--</div>-->
<!---->
<!--<style>-->
<!--    body {-->
<!--        font-style: sans-serif;-->
<!--    }-->
<!---->
<!--    a {-->
<!--        text-decoration: none;-->
<!--    }-->
<!---->
<!--    a:hover {-->
<!--        text-decoration: none;-->
<!--    }-->
<!---->
<!--    h1 {-->
<!--        line-height: 3em;-->
<!--    }-->
<!---->
<!--    .card {-->
<!--        max-width: 35rem;-->
<!--    }-->
<!---->
<!--    .card:hover {-->
<!--        box-shadow: 1px 2px 10px lightgrey;-->
<!--        transition: 0.2s;-->
<!--    }-->
<!---->
<!--    .card-header {-->
<!--        font-size: 15px;-->
<!--        color: gray;-->
<!--        background-color: white;-->
<!--    }-->
<!---->
<!--    .text-muted {-->
<!--        font-size: 15px;-->
<!--    }-->
<!---->
<!--    .card-footer{-->
<!--        font-weight: bold;-->
<!--        font-size: 15px;-->
<!--        background-color: white;-->
<!--    }-->
<!--</style>-->

<div class="container">
    <h1>Корзина</h1>

    <?php if (!empty($products)): ?>
        <div class="card-deck">
            <?php foreach($products as $product): ?>
                <form action="/order" method="POST">
                    <div class="card text-center">
                        <div class="card-header">
                            <a href="#" class="product-title"><?php echo $product->getTitle(); ?></a>

                        </div>
                        <img class="card-img-top" src="<?php echo $product->getImage(); ?>" alt="Card image" width="500">
                        <div class="card-body">
                            <p class="card-text text-muted"><?php echo $product->getDescription(); ?></p>
                            <div class="card-footer"><?php echo 'Цена: ' . $product->getPrice() . ' руб.'; ?>
                            </div>
                            <div class="card-footer"><?php echo 'Количество: ' . $product->getAmount() . ' шт.'; ?>
                            </div>
                            <button type="submit" class="registerbtn">Оформить заказ</button>
                    </div>
                </form>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-cart-container">
            <p class="empty-cart-message">Корзина пуста</p>
        </div>
    <?php endif; ?>
</div>

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

    h1 {
        text-align: center;
        line-height: 3em;
    }

    .card {
        max-width: 35rem;
        margin: 20px auto;
    }

    .card:hover {
        box-shadow: 1px 2px 10px lightgrey;
        transition: 0.2s;
    }

    .card-header {
        font-size: 18px;
        color: gray;
        background-color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px;
    }

    .product-title {
        font-size: 20px;
        font-weight: bold;
        color: #333;
    }

    .registerbtn {
        margin-top: 10px;
        padding: 8px 12px;
        font-size: 18px;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .registerbtn:hover {
        background-color: #555;
    }

    .text-muted {
        font-size: 15px;
    }

    .card-footer {
        font-weight: bold;
        font-size: 18px;
        background-color: white;
    }

    .empty-cart-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 60vh;
    }

    .empty-cart-message {
        text-align: center;
        font-size: 20px;
        color: white;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #333;
    }
</style>