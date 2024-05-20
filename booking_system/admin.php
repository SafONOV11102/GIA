<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 2) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM request";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }

    if (isset($_POST['goto_requests'])) {
        header("Location: requests.php");
        exit();
    }

    $request_id = $_POST['request_id'];
    $status_id = $_POST['status_id'];

    $sql = "UPDATE request SET id_status='$status_id' WHERE id='$request_id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Панель администратора</title>
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
            font-size: 18px;
            color: #000;
            text-align: left;
            flex: 1;
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
            text-align: center;
            font-size: 16px;
        }
        .request-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            color: #323232;
            word-wrap: break-word;
            text-align: left;
        }
        select {
            background-color: #fff;
            color: #000;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        select:focus, select:hover {
            background-color: #fff;
            color: #000;
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
            <h1>Панель администратора</h1>
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
                    <div>
                        <?php
                        $user_id = $row['id_user'];
                        $user_result = $conn->query("SELECT full_name FROM user WHERE id='$user_id'");
                        $user_row = $user_result->fetch_assoc();
                        echo htmlspecialchars($user_row['full_name']);
                        ?>
                    </div>
                    <div>
                        <form method="POST">
                            <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                            <select name="status_id">
                                <?php
                                $statuses = $conn->query("SELECT * FROM status");
                                while ($status = $statuses->fetch_assoc()) {
                                    $selected = $status['id'] == $row['id_status'] ? 'selected' : '';
                                    echo "<option value='" . $status['id'] . "' $selected>" . $status['name'] . "</option>";
                                }
                                ?>
                            </select>
                            <input type="submit" value="Изменить">
                        </form>
                    </div>
                    <div><?php echo htmlspecialchars($row['booking_datetime']); ?></div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>