<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $auto = $_POST['auto'];
    $problem = $_POST['problem'];
    $booking_datetime = $_POST['booking_datetime'];
    $status_id = 1;

    $sql = "INSERT INTO request (id_user, auto, problem, id_status, booking_datetime) VALUES ('$user_id', '$auto', '$problem', '$status_id', '$booking_datetime')";

    if ($conn->query($sql) === TRUE) {
        header("Location: requests.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Новая заявка</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-size: 14px;
            font-family: Montserrat, sans-serif;
            margin: 0;
            padding: 0;
            background-color: rgba(255, 255, 255, 1);
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            overflow: hidden;
        }
        h1 {
            font-size: 30px;
            color: rgba(0, 0, 0, 1);
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.25);
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-size: 16px;
            color: rgba(108, 117, 125, 1);
            margin-bottom: 10px;
        }
        input[type="text"], textarea, input[type="datetime-local"] {
            width: 100%;
            padding: 10px;
            border: 1px solid rgba(236, 239, 241, 1);
            border-radius: 5px;
            font-size: 14px;
            margin-bottom: 10px;
        }
        textarea {
            resize: none;
        }
        .submit-container {
            text-align: center;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: rgba(0, 0, 0, 1);
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #333;
        }
        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }
            h1 {
                font-size: 24px;
            }
            .form-container {
                padding: 15px;
            }
            input[type="text"], textarea, input[type="datetime-local"] {
                padding: 8px;
                font-size: 14px;
            }
            input[type="submit"] {
                padding: 10px 15px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Создать новую заявку</h1>
        <form method="POST">
            <div class="form-container">
                <label>Автомобиль:</label>
                <input type="text" name="auto" placeholder='Марка автомобиля, год, комплектация' required>
            </div>
            <div class="form-container">
                <label>Описание вашей проблемы:</label>
                <input type="text" name="problem" placeholder='Какая у вас проблема?' required>
            </div>
            <div class="form-container">
                <label>Дата и время бронирования:</label>
                <input type="datetime-local" name="booking_datetime" required>
            </div>
            <div class="submit-container">
                <input type="submit" value="Отправить заявку">
            </div>
        </form>
    </div>
</body>
</html>
