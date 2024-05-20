<?php
include 'db.php';

$sql_check_admin = "SELECT * FROM user WHERE id_role = 2 LIMIT 1";
$result_check_admin = $conn->query($sql_check_admin);

if ($result_check_admin->num_rows == 0) {
    $full_name = 'Admin';
    $phone = '1234567890';
    $login = 'newfit';
    $password = 'qsw123';

    $sql_add_admin = "INSERT INTO user (id_role, login, password, full_name, phone) VALUES (2, '$login', '$password', '$full_name', '$phone')";

    if ($conn->query($sql_add_admin) === TRUE) {
        echo "Admin user added successfully.";
    } else {
        echo "Error adding admin user: " . $conn->error;
    }
}
?>
