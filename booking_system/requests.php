<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_request'])) {
    $request_id = $_POST['request_id'];
    $conn->query("DELETE FROM request WHERE id='$request_id'");
    header("Location: requests.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM request WHERE id_user='$user_id'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Мои заявки</title>
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            overflow: hidden;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            color: rgba(0, 0, 0, 1);
            margin: 0;
        }
        .controls {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .controls a, .controls form {
            display: inline-block;
        }
        .controls a {
            padding: 10px 20px;
            background-color: rgba(0, 0, 0, 1);
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .controls a:hover {
            background-color: #333;
        }
        .controls form input[type="submit"] {
            padding: 10px 20px;
            background-color: rgba(0, 0, 0, 1);
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .controls form input[type="submit"]:hover {
            background-color: #333;
        }
        .request-container {
            background-color: #fff;
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(50, 50, 50, 0.4);
        }
        .request-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .request-header h2 {
            word-wrap: break-word; 
            margin: 0;
            font-size: 16px;
            color: #000;
        }
        .request-header form {
            margin: 0;
        }
        .request-header form input[type="submit"] {
            padding: 5px 10px;
            background-color: rgba(0, 0, 0, 1);
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .request-header form input[type="submit"]:hover {
            background-color: #333;
        }
        .request-body {
            margin-bottom: 20px;
            word-wrap: break-word;
        }

        .request-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            color: #323232;
            word-wrap: break-word;
        }

        @media (max-width: 600px) {
            .request-container {
                padding: 10px;
            }
            .header h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Мои заявки</h1>
            <div class="controls">
                <a href="new_request.php">Создать новую заявку</a>
                <?php echo $admin_button; ?>
                <form method="POST">
                    <input type="submit" name="logout" value="Выход">
                </form>
            </div>
        </div>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="request-container">
                <div class="request-header">
                    <h2><?php echo htmlspecialchars($row['auto']); ?></h2>
                    <form method="POST">
                        <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                        <input type="submit" name="delete_request" value="Удалить">
                    </form>
                </div>
                <div class="request-body">
                    <?php echo htmlspecialchars($row['problem']); ?>
                </div>
                <div class="request-footer">
                    <div><?php echo htmlspecialchars($_SESSION['user_name']); ?></div>
                    <div> 
                        <?php
                        $status_id = $row['id_status'];
                        $status_result = $conn->query("SELECT name FROM status WHERE id='$status_id'");
                        $status_row = $status_result->fetch_assoc();
                        echo htmlspecialchars($status_row['name']);
                        ?>
                    </div>
                    <div><?php echo htmlspecialchars($row['booking_datetime']); ?></div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
