<div class="container">
    <h3>Корзина</h3>
    <div class="card-deck">
        <?php foreach($products as $product): ?>
        <form action="/order" method="POST">
            <div class="card text-center">
                <a href="#">
                    <div class="card-header">
                    </div>
                    <img class="card-img-top" src="<?php echo $product['image']; ?>" alt="Card image" width="500">
                    <div class="card-body">
                        <p class="card-text text-muted"><?php echo $product['description']; ?></p>
                        <a href="#"><h5 class="card-title"><?php echo $product['title']; ?></h5></a>
                        <div class="card-footer">
                            <?php echo $product['price'] . ' руб.'; ?>
                        </div>
                            <?php echo 'Количество: ' . $product['amount'] . ' шт.'; ?>
                    </div>
                    <button type="submit" class="registerbtn">Оформить заказ</button>
                </a>
            </div>
        <?php endforeach; ?>

        <style>
            body {
                font-style: sans-serif;
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

            .card-footer{
                font-weight: bold;
                font-size: 15px;
                background-color: white;
            }
        </style>

