<?php
include 'db.php';
session_start();

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE login='$login'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password === $row['password']) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['id_role'];
            header("Location: requests.php");
            exit;
        } else {
            $error_message = "Неверный адрес электронной почты или пароль!";
        }
    } else {
        $error_message = "Неверный адрес электронной почты или пароль!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
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
        .login-container {
            width: 303px;
            height: 316px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 20px;
            padding: 40px;
        }
        .form-heading {
            width: 100%;
            color: rgba(0, 0, 0, 1);
            font-size: 26px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }
        .input-group {
            width: 100%;
            margin-bottom: 20px;
        }
        .input-group label {
            width: 100%;
            color: rgba(108, 117, 125, 1);
            font-size: 16px;
            font-weight: regular;
            margin-bottom: 5px;
            display: block;
        }
        .input-group input {
            width: calc(100% - 30px);
            padding: 15px;
            border-radius: 10px;
            border: 1px solid rgba(236, 239, 241, 1);
            font-size: 16px;
            color: #000;
        }
        .input-group input.error {
            color: red;
        }
        .submit-button {
            width: 100%;
            padding: 15px 0;
            border-radius: 10px;
            border: none;
            background-color: rgba(0, 0, 0, 1);
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 18px;
            font-weight: regular;
        }
        .submit-button:hover {
            background-color: #1a1a1a;
        }
        .register-button {
            width: 100%;
            padding: 15px 0;
            border-radius: 10px;
            border: 1px solid rgba(236, 239, 241, 1);
            background-color: #fff;
            color: rgba(108, 117, 125, 1);
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            font-size: 16px;
            font-weight: regular;
            text-decoration: underline;
        }
        .register-button:hover {
            background-color: rgba(236, 239, 241, 1);
            color: rgba(0, 0, 0, 1);
        }
        .register-text {
            margin-top: 10px;
            text-align: center;
            color: rgba(108, 117, 125, 1);
            font-size: 14px;
        }
        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
        .input-group.error input::placeholder {
            color: red;
        }

    </style>
</head>
<body>
    <div class="login-container">
        <div class="form-heading">Авторизация</div>
        <form method="POST" action="">
        <div class="input-group <?php if ($error_message): ?>error<?php endif; ?>">
            <input type="text" id="login" name="login" placeholder="Электронная почта" required>
        </div>
        <div class="input-group <?php if ($error_message): ?>error<?php endif; ?>">
            <input type="password" id="password" name="password" placeholder="Пароль" required>
        </div>

            <?php if ($error_message): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
            <button type="submit" class="submit-button">Войти</button>
        </form>
        <div class="register-text">Нет аккаунта? <button class="register-button" onclick="window.location.href='register.php';">Регистрация</button></div>
    </div>
</body>
</html>
