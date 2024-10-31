<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <!-- Логотип интернет-магазина -->
    <div class="logo-container">
        <img src="/path/to/logo.png" alt="Логотип интернет-магазина" class="logo">
    </div>

    <!-- Заголовок -->
    <h1>Добро пожаловать в наш интернет-магазин!</h1>

    <!-- Кнопки -->
    <div class="btn-container">
        <a href="/catalog" class="btn btn-success">Каталог товаров</a>
        <a href="/login" class="btn btn-primary">Войти</a>
        <a href="/registrate" class="btn btn-secondary">Регистрация</a>
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
        text-align: center;
    }

    .logo {
        max-width: 150px;
        margin-bottom: 20px;
    }

    .btn-container {
        margin-top: 20px;
    }

    .btn {
        width: 200px;
        margin-bottom: 10px;
    }
</style>
