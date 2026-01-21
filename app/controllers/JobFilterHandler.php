<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/../models/DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->openConnection();

$job_type = $_POST['job_type'] ?? null;
$min_salary = $_POST['min_salary'] ?? null;
$max_salary = $_POST['max_salary'] ?? null;

$jobs = $db->filterJobs($conn, $job_type, $min_salary, $max_salary);

require_once __DIR__ . '/../../views/jobs/job.php';
?>  