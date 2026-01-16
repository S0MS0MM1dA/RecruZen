<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . "/../models/DatabaseConnection.php";

if($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("Location: ../../index.php?page=js_profile");
    exit;
}
if(!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "jobseeker"){
    header("Location: ../../index.php?page=login");
    exit;
}

$user_id   = $_SESSION["user"]["id"];

$first_name = trim($_POST['first_name'] ?? '');
$lst_name = trim($_POST['last_name'] ?? '');
$email = trim($_POST['email'] ?? '');

$phone = trim($_POST['phone'] ?? '');
$address = trim($_POST['address'] ?? '');
$education= trim($_POST['education'] ?? '');
$experience = trim($_POST['experience'] ?? '');
$skills = trim($_POST['skills'] ?? '');

$profile_image = null;
$resume = null;


$db = new DatabaseConnection();
$conn = $db->openConnection();

$result = $db->jobseekerProfile(
    $conn, $user_id, $phone, $address, $skills, $education, $experience, $resume, $profile_image
);

header("Location: ../../index.php?page=js_profile");
exit;
?>