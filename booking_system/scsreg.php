

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Успешная регистрация</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: rgba(255, 255, 255, 1);
            font-family: Montserrat, sans-serif;
            overflow: hidden;
        }
        .success-container {
            width: 70%;
            max-width: 350px;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
        }
        .success-heading-large {
            color: rgba(0, 0, 0, 1);
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .success-heading-medium {
            color: rgba(0, 0, 0, 1);
            font-size: 22px;
            margin-bottom: 20px;
        }
        .user-data-heading {
            width: 100%;
            color: rgba(108, 117, 125, 1);
            font-size: 16px;
            font-weight: bold;
            text-align: left;
            margin-bottom: 10px;
        }
        .user-info-container {
            width: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .user-info {
            width: 100%;
            text-align: left;
            color: rgba(0, 0, 0, 1);
            font-size: 16px;
            margin-bottom: 20px;
        }
        .continue-button {
            width: 100%;
            padding: 15px 0;
            border-radius: 10px;
            border: none;
            background-color: rgba(0, 0, 0, 1);
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 18px;
        }
        .continue-button:hover {
            background-color: #1a1a1a;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-heading-large">Регистрация</div>
        <div class="success-heading-medium">Вы успешно внесены в базу</div>
        <div class="user-data-heading">Ваши данные:</div>
        <div class="user-info-container">
            <div class="user-info"><?php echo htmlspecialchars($_GET['full_name']); ?></div>
            <div class="user-info"><?php echo htmlspecialchars($_GET['phone']); ?></div>
            <div class="user-info"><?php echo htmlspecialchars($_GET['login']); ?></div>
            <div class="user-info"><?php echo htmlspecialchars($_GET['password']); ?></div>
        </div>
        <button class="continue-button" onclick="window.location.href='requests.php';">Продолжить</button>
    </div>
</body>
</html>
