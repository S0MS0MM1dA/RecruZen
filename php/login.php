<?php
session_start();
require_once "db_connect.php";

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

    if (password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        header("Location: ../assets/html/user-dashboard.html");
        exit;

    } else {
        echo "Wrong password!";
    }

} else {
    echo "No user found!";
}
?>
