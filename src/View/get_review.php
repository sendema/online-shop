<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить отзыв</title>
</head>
<body>
<form action="/addReview" method="POST">
    <h2>Оставить отзыв</h2>
    <input type="hidden" name="product_id" value="<?php echo $request->getProductId(); ?>">
    <input type="hidden" name="user_id" value="<?php echo $userId = $this->authService->getCurrentUser()->getId(); ?>">
    <label for="name">Ваше имя:</label>
    <input type="text" id="name" name="name" required>

    <label for="rating">Рейтинг:</label>
    <select id="rating" name="rating" required>
        <option value="5">5 - Отлично</option>
        <option value="4">4 - Хорошо</option>
        <option value="3">3 - Средне</option>
        <option value="2">2 - Плохо</option>
        <option value="1">1 - Очень плохо</option>
    </select>

    <label for="text">Отзыв:</label>
    <textarea id="text" name="text" required></textarea>

    <button type="submit">Отправить отзыв</button>
</form>
</body>
</html>

<style>
    body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
        background-color: #f4f4f9;
    }

    form {
        width: 100%;
        max-width: 400px;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    h2 {
        color: #333;
        margin: 0 0 20px;
    }

    label {
        display: block;
        margin-top: 15px;
        color: #555;
        text-align: left;
    }

    input[type="text"],
    select,
    textarea {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }

    textarea {
        height: 100px;
        resize: vertical;
    }

    button[type="submit"] {
        width: 100%;
        padding: 10px;
        margin-top: 15px;
        background-color: #007bff;
        border: none;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>