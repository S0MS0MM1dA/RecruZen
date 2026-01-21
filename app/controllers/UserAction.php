<?php
session_start();
require_once __DIR__ . "/../models/DatabaseConnection.php";

if(!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "admin"){
    header("Location: ../../index.php?page=login");
    exit;
}

if(!isset($_POST['user_id'])){
    header("Location: ../../index.php?page=admin_manage_user");
    exit;
}
$user_id = (int)$_POST['user_id'];

$db = new DatabaseConnection();
$conn = $db->openConnection();

$db->toggleUserStatus($conn, $user_id);
header("Location: ../../index.php?page=admin_manage_user");
exit;
?>