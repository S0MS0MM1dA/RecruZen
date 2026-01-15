<?php
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

$recruiter_id = $_SESSION["user"]["id"];

$title = trim($_POST["title"] ?? "");
$description = trim($_POST["description"] ?? "");
$requirements = trim($_POST["requirements"] ?? "");
$benefits = trim($_POST["benefits"] ?? "");
$vacancies = (int)($_POST["vacancies"] ?? "");
$deadline = trim($_POST["deadline"] ?? "");
$skills = trim($_POST["skills"] ?? "");
$category = (int)($_POST["category"] ?? "");
$location = (int)($_POST["location"] ?? "");
$job_type = trim($_POST["job_type"] ?? "");
$workplace = trim($_POST["workplace"] ?? "");
$min_salary = trim($_POST["min_salary"] ?? "");
$max_salary = trim($_POST["max_salary"] ?? "");
$status = trim($_POST["status"] ?? "pending");

$db = new DatabaseConnection();
$conn = $db->openConnection();

$result = $db->postJob(
    $conn, $recruiter_id, $title, $description, $requirements, $benefits, $vacancies, $deadline,
    $skills, $category_id, $location_id, $job_type, $workplace, $min_salary, $max_salary, $status
);

if ($result) {
    $_SESSION["jobSuccess"] = "Job posted successfully";
    header("Location: ../../index.php?page=rec_dashboard");
    exit;
}

die("Job insert failed: " . $conn->error);
