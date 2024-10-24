<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Детали заказа</title>
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

        img {
            display: block;
            margin-bottom: 10px;
        }

        button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
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

            img {
                width: 80px;
            }

            button {
                width: 100%;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
<h1>Детали заказа №: <?php echo $orderId = $request->getOrderId(); ?></h1>
<?php if (!empty($orderDetails)): ?>
    <ul>
        <?php foreach ($orderDetails as $order): ?>
            <li>
                <h2>Название товара: <?= htmlspecialchars($order->getTitle()) ?></h2>
                <p>ID Товара: <?= htmlspecialchars($order->getProductId()) ?></p>
                <img src="<?= htmlspecialchars($order->getImage()) ?>" alt="<?= htmlspecialchars($order->getTitle()) ?>" style="width:100px;">
                <p>Количество: <?= htmlspecialchars($order->getAmount()) ?></p>
                <form action="/orderDetails" method="POST">
                </form>
                <a href="/myOrders" class="btn">Назад к моим заказам</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Детали заказа не найдены.</p>
<?php endif; ?>
</body>
</html>

