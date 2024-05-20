<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Шапка сайта</title>
    <style>
        body {
            font-family: Montserrat, sans-serif;
            font-size: 24px;
            margin: 0;
            padding: 0;
            background-color: rgba(255, 255, 255, 1);
        }
        p{
            font-family: Montserrat, sans-serif;
            font-size: 24px;
        }
        .header {
            background-color: #000;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }
        .header-left {
            display: flex;
            align-items: center;
        }
        .header-left img {
            max-height: 80px;
            margin-right: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .nav {
            display: flex;
            gap: 10px;
        }
        .nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #000;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .nav a:hover {
            background-color: #333;
        }
        .content {
            text-align: center;
            padding: 20px;
        }
        .content img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-left">
            <img src="img/3.png" alt="Full Image">
            <h1>Починим!</h1>
        </div>
        <div class="nav">
            <a href="login.php">Войти</a>
            <a href="register.php">Зарегистрироваться</a>
            <a href="requests.php" onclick="return checkAuthorization()">Мои запросы</a>
            <a href="adminlog.php">Панель администратора</a>
        </div>
    </div>

    <div class="content">
        <h2>Добро пожаловать на наш сайт!</h2>
        <img src="img/1.jpg" alt="Описание изображения" style="width: 600px; height: 320px;">
        <p>Привет! Сейчас ты находишься на сайте нашего сервиса! С помощью него ты можешь 
            записаться к нам на ремонт своего автомобиля! Зарегистрируйся, зайди в систему и оставь заявку прямо сейчас!
        </p>
    </div>

    <script>
        function checkAuthorization() {
            <?php if (!isset($_SESSION['user_id'])): ?>
                window.location.href = 'login.php';
                return false;
            <?php endif; ?>
            return true;
        }
    </script>
</body>
</html>
