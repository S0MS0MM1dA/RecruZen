<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . "/../models/DatabaseConnection.php";
require_once __DIR__ . "/../models/RecruiterModel.php";

if($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("Location: ../../index.php?page=rec_company_profile");
    exit;
}
if(!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "recruiter"){
    header("Location: ../../index.php?page=login");
    exit;
}

$user_id   = $_SESSION["user"]["id"];

$company_name = trim($_POST['company_name'] ?? '');
$company_email = trim($_POST['company_email'] ?? '');
$company_phone = trim($_POST['company_phone'] ?? '');
$company_location = trim($_POST['company_location'] ?? '');
$company_description= trim($_POST['company_description'] ?? '');
$company_website = trim($_POST['company_website'] ?? '');
$company_about = trim($_POST['company_about'] ?? '');

$company_logo = "";


$db = new DatabaseConnection();
$conn = $db->openConnection();
$recruiterModel = new RecruiterModel();

$profile = $recruiterModel->getRecruiterProfile($conn, $user_id);
$company_logo = $profile['company_logo'] ?? '';


$uploadFile = $_FILES['company_logo'] ?? null;

if ($uploadFile && !empty($uploadFile['name'])) {
    require_once __DIR__ . "/ImageUploadHelper.php";
    $targetDir = __DIR__ . "/../../public/uploads/";
    $savedName = saveUploadedImage($uploadFile, $targetDir);
    if ($savedName !== null) {
        $company_logo = $savedName;
    }
    // if validation fails, silently keep the old company_logo
}

$result = $recruiterModel->recruiterProfile(
    $conn, $user_id, $company_name, $company_email, $company_phone, $company_description, 
    $company_logo, $company_website, $company_location, $company_about
    
);

header("Location: ../../index.php?page=rec_company_profile");
exit;
?>