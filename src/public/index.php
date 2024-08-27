<?php

print_r($_GET);
/*<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить товар в корзину</title>
</head>
<body>
<h1>Добавить товар в корзину</h1>
<form action="handle_add_product.php" method="POST">
    <label for="product_id">ID продукта:</label>
    <label style="color: red"><?php if (isset($errors['product_id'])) {}
        {
            echo $errors['product_id'];
        }?>
    </label>
    <input type="text" id="product_id" name="product_id" required>
    <br><br>

    <label for="amount">Количество:</label>
    <label style="color: red"><?php if (isset($errors['amount']))
        {
            echo $errors['amount'];
        }?>
    </label>
    <input type="number" id="amount" name="amount" value="1" min="1" required>
    <br><br>

    <button type="submit">Добавить в корзину</button>
</form>
</body>
</html>*/