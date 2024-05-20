<?php
$servername = "localhost:8889";
$username = "root";
$password = "root";
$dbname = "v5";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>