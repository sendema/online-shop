<div class="container">
    <h3>Каталог</h3>
    <div class="card-deck">
        <?php foreach($products as $product): ?>
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
            </div>
        <form action="/addProduct" method="POST">
            <input type="hidden" id="product_id" name="product_id" value="<?php echo $product->getId(); ?>" required>
            <input type="text" id="amount" name="amount" required>
            <button type="submit" class="registerbtn">+</button>
        </form>
        <form action="/deleteProduct" method="POST">
                <input type="hidden" id="product_id" name="product_id" value="<?php echo $product->getId(); ?>" required>
                <input type="text" id="amount" name="amount" required>
                <button type="submit" class="registerbtn">-</button>
        </form>

        <?php endforeach; ?>
        <a href="/cart" class="cart-button">Перейти в корзину</a>
    </div>
</div>
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
