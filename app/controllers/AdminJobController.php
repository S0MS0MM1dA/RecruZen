<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/../models/DatabaseConnection.php';

if(!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "admin"){
    header("Location: ../../index.php?page=login");
    exit;
}

if($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("Location: ../../index.php?page=admin_manage_jobs");
    exit;
}

$job_id = $_POST['job_id'] ?? null;
$action = $_POST['action'] ?? '';

if(!$job_id || !$action){
    header("Location: ../../index.php?page=admin_manage_jobs");
    exit;
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$status =($action === 'approve') ? 'published' : 'rejected';
$db->updateJobStatus($conn, $job_id, $status);

header("Location: ../../index.php?page=admin_manage_jobs");
exit;

?>