<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . "/../models/DatabaseConnection.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../../index.php");
    exit;
}

if (!isset($_SESSION["user"])) {
    header("Location: ../../index.php?page=login");
    exit;
}

$user_id = $_SESSION["user"]["id"];
$role    = $_SESSION["user"]["role"];

$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];

if ($role === 'admin') {
    $redirect = 'admin_settings';
} elseif ($role === 'recruiter') {
    $redirect = 're_settings';
} else {
    $redirect = 'js_settings';
}


if (empty($old_password) || empty($new_password)) {
    $_SESSION['error'] = "All fields are required.";
    header("Location: ../../index.php?page=$redirect");
    exit;
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if (!$user || $user['password'] !== $old_password) {
    $_SESSION['error'] = "Old password is incorrect.";
    header("Location: ../../index.php?page=$redirect");
    exit;
}

$stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
$stmt->bind_param("si", $new_password, $user_id);
$stmt->execute();

$_SESSION['success'] = "Password updated successfully.";
header("Location: ../../index.php?page=$redirect");
exit;
