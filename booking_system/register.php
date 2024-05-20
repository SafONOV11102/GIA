<?php
include 'db.php';

function redirectToSuccessPage($full_name, $phone, $login, $password) {
    header("Location: scsreg.php?full_name=$full_name&phone=$phone&login=$login&password=$password");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $login = $_POST['login'];
    $password = $_POST['password'];

    $sql = "INSERT INTO user (id_role, login, password, full_name, phone) VALUES (1, '$login', '$password', '$full_name', '$phone')";

    if ($conn->query($sql) === TRUE) {
        redirectToSuccessPage($full_name, $phone, $login, $password);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
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
        .registration-container {
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
            transition: border-color 0.3s;
        }
        .error-message {
            color: #FF0000;
            font-size: 14px;
            margin-top: 5px;
            text-align: center;
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
        .register-text {
            margin-top: 10px;
            text-align: center;
            color: rgba(108, 117, 125, 1);
            font-size: 14px;
        }
        .register-link {
            color: rgba(0, 0, 0, 1);
            font-size: 16px;
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="registration-container">
        <div class="form-heading">Регистрация</div>
        <form method="POST">
            <div class="input-group">
                <input type="text" id="full_name" name="full_name" placeholder="ФИО" required>
            </div>
            <div class="input-group">
                <input type="text" id="phone" name="phone" placeholder="Телефон" required>
            </div>
            <div class="input-group">
                <input type="text" id="login" name="login" placeholder="Электронная почта" required>
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" placeholder="Пароль" required>
            </div>
            <input type="submit" class="submit-button" value="Зарегистрироваться">
        </form>
        <div class="register-text">Уже есть аккаунт? <span class="register-link" onclick="window.location.href='login.php';">Войти</span></div>
    </div>
</body>
</html>
