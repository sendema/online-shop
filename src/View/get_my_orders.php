<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои заказы</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            margin-top: 0;
        }

        p {
            color: #555;
            margin: 5px 0;
        }

        form {
            margin-top: 10px;
        }

        button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #333;
        }

        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            li {
                padding: 15px;
            }

            button {
                width: 100%;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
<h1>Мои заказы</h1>
<?php if (!empty($orders)): ?>
    <ul>
        <?php foreach ($orders as $order): ?>
            <li>
                <h2>Заказ №<?= htmlspecialchars($order->getId()) ?></h2>
                <p>Имя: <?= htmlspecialchars($order->getName()) ?></p>
                <p>Телефон: <?= htmlspecialchars($order->getPhone()) ?></p>
                <p>Адрес: <?= htmlspecialchars($order->getAddress()) ?></p>
                <p>Комментарий: <?= htmlspecialchars($order->getComment()) ?></p>
                <p>Продукт: <?= htmlspecialchars($order->getProductId()) ?></p>
                <p>Количество: <?= htmlspecialchars($order->getAmount()) ?></p>
                <form action="/orderDetails" method="POST">
                    <input type="hidden" name="order_id" value="<?= htmlspecialchars($order->getId()) ?>">
                    <button type="submit">Детали заказа</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>У вас пока нет заказов.</p>
<?php endif; ?>
</body>
</html>