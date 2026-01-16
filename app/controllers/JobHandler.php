<?php
/*
echo "<pre>";
print_r($_POST);
exit;
*/

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . "/../models/DatabaseConnection.php";

if($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("Location: ../../index.php?page=rec_post_job");
    exit;
}
if(!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "recruiter"){
    header("Location: ../../index.php?page=login");
    exit;
}

$user_id   = $_SESSION["user"]["id"];

$title = trim($_POST["title"] ?? "");
$description = trim($_POST["description"] ?? "");
$requirements  = trim($_POST["requirement"] ?? "");
$benefits = trim($_POST["benefits"] ?? "");

$vacancies = (int)($_POST["vacancies"] ?? 1);
$deadline = trim($_POST["deadline"] ?? null);

$skills = trim($_POST["skills"] ?? "");

$category_id = trim($_POST["category_id"] ?? 0);
$location_id = trim($_POST["location_id"] ?? 0);

$job_type = trim($_POST["job_type"] ?? "");
$workplace = trim($_POST["workplace"] ?? "");

$min_salary = trim($_POST["min_salary"] ?? null);
$max_salary = trim($_POST["max_salary"] ?? null);
$status = trim($_POST["status"] ?? "draft");

if (empty($title) || empty($description) ||$category_id <= 0 || $location_id <= 0) {
    die("Required fields missing");
}


$db = new DatabaseConnection();
$conn = $db->openConnection();

$result = $db->postJob(
    $conn, $user_id, $category_id, $location_id, $title, $description, $requirements, $benefits, $vacancies, $deadline,
    $skills,  $job_type, $workplace, $min_salary, $max_salary, $status
);

if ($result) {
    $_SESSION["jobSuccess"] = "Job posted successfully";
    header("Location: ../../index.php?page=rec_dashboard");
    exit;
}

if (!$result) {
    die("SQL ERROR: " . $conn->error);
}
die("Job insert failed: " . $conn->error);
?>