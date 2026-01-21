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
    header("Location: ../../index.php?page=js_saved_jobs");
    exit;
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$stmt = $conn->prepare("DELETE FROM saved_jobs WHERE jobseeker_id = ? AND job_id = ?");
$stmt->bind_param("ii", $user_id, $job_id);
$stmt->execute();

header("Location: ../../index.php?page=js_saved_jobs");
exit;

?>