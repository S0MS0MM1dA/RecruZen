<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . "/../models/DatabaseConnection.php";

if(!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "jobseeker"){
    header("Location: ../../index.php?page=login");
    exit;
}

$user_id = $_SESSION['user']['id'];
$job_id = isset($_POST['job_id']) ? (int)$_POST['job_id'] : 0;

if ($job_id <= 0) {
    die("Invalid Job ID");
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$result = $db->savedJob($conn, $user_id, $job_id);

if ($result) {
    header("Location: ../../index.php?page=job_details&id=$job_id&save_status=success");
    exit;
} else {
    header("Location: ../../index.php?page=job_details&id=$job_id&save_status=failure");
    exit;
}

?>