<?php
session_start();
require_once __DIR__ . "../../models/DatabaseConnection.php";

if(!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "recruiter"){
    header("Location: ../../index.php?page=login");
    exit;
}

if(!isset($_POST['job_id'])){
    header("Location: ../../index.php?page=rec_dashboard");
    exit;
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$user_id = $_SESSION['user']['id'];
$job_id = $_POST['job_id'];

$db->deleteJob($conn, $user_id, $job_id);

header("Location: ../../index.php?page=rec_dashboard&message=Job+deleted+successfully");;
exit;

?>