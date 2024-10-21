<!--<h1>Ваши заказы:</h1>-->
<!---->
<?php //if (!empty($orderDetails)):;?>
<!--    <table>-->
<!--        <thead>-->
<!--        <tr>-->
<!--            <th>Order ID</th>-->
<!--            <th>Name</th>-->
<!--            <th>Phone</th>-->
<!--            <th>Address</th>-->
<!--            <th>Comment</th>-->
<!--            <th>Product ID</th>-->
<!--            <th>Title</th>-->
<!--            <th>Amount</th>-->
<!--        </tr>-->
<!--        </thead>-->
<!--        <tbody>-->
<!--        --><?php //foreach ($orderDetails as $order): ?>
<!--            <tr>-->
<!--                <td>--><?php //= htmlspecialchars($order->getId()) ?><!--</td>-->
<!--                <td>--><?php //= htmlspecialchars($order->getName()) ?><!--</td>-->
<!--                <td>--><?php //= htmlspecialchars($order->getPhone()) ?><!--</td>-->
<!--                <td>--><?php //= htmlspecialchars($order->getAddress()) ?><!--</td>-->
<!--                <td>--><?php //= htmlspecialchars($order->getComment()) ?><!--</td>-->
<!--                <td>--><?php //= htmlspecialchars($order->getProductId()) ?><!--</td>-->
<!--                <td>--><?php //= htmlspecialchars($order->getTitle()) ?><!--</td>-->
<!--                <td>--><?php //= htmlspecialchars($order->getAmount()) ?><!--</td>-->
<!--            </tr>-->
<!--        --><?php //endforeach; ?>
<!--        </tbody>-->
<!--    </table>-->
<?php //else: ?>
<!--    <p>Заказ пуст.</p>-->
<?php //endif; ?>
<h2>Детали заказа</h2>
<p>Имя: <?= htmlspecialchars($orderDetails[0]['name']) ?></p>
<p>Телефон: <?= htmlspecialchars($orderDetails[0]['phone']) ?></p>
<p>Адрес: <?= htmlspecialchars($orderDetails[0]['address']) ?></p>
<p>Комментарий: <?= htmlspecialchars($orderDetails[0]['comment']) ?></p>

<h3>Продукты в заказе:</h3>
<ul>
    <?php foreach ($orderDetails as $item): ?>
        <li>Товар ID: <?= htmlspecialchars($item['product_id']) ?>, Количество: <?= htmlspecialchars($item['amount']) ?></li>
    <?php endforeach; ?>
</ul>
<a href="/catalog">Вернуться в каталог</a>
</body>
</html>



<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<!--    <title>Заказ</title>-->
<!--</head>-->
<!--<body>-->
<!--<h1>Продукты в заказе</h1>-->
<!---->
<?php //if (!empty($orders)): ?>
<!--    <table>-->
<!--        <thead>-->
<!--        <tr>-->
<!--            <th>Название продукта</th>-->
<!--            <th>Количество</th>-->
<!--        </tr>-->
<!--        </thead>-->
<!--        <tbody>-->
<!--        --><?php //foreach ($orders as $order): ?>
<!--            <tr>-->
<!--                <td>--><?php //= htmlspecialchars($order->getTitle()) ?><!--</td>-->
<!--                <td><img src"--><?php //= htmlspecialchars($order->getImage()) ?><!--" alt="--><?php //= htmlspecialchars($order->getTitle()) ?><!--" width="100"></td>-->
<!--                <td>--><?php //= htmlspecialchars($order->getAmount()) ?><!--</td>-->
<!--            </tr>-->
<!--        --><?php //endforeach; ?>
<!--        </tbody>-->
<!--    </table>-->
<?php //else: ?>
<!--    <p>Заказ пуст.</p>-->
<?php //endif; ?>
<!---->
<!--<a href="/catalog">Вернуться в каталог</a>-->
<!--</body>-->
<!--</html>-->