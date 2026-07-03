<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . "/../models/DatabaseConnection.php";
require_once __DIR__ . "/../models/JobSeekerModel.php";

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

$profile_image = "";


$db = new DatabaseConnection();
$conn = $db->openConnection();
$jobSeekerModel = new JobSeekerModel();


$profile = $jobSeekerModel->getJobseekerProfile($conn, $user_id);
$profile_image = $profile['profile_image'] ?? '';
$resume = $profile['resume'] ?? null;


$uploadFile = $_FILES['profile_image'] ?? null;

if ($uploadFile && !empty($uploadFile['name'])) {
    require_once __DIR__ . "/ImageUploadHelper.php";
    $targetDir = __DIR__ . "/../../public/uploads/";
    $savedName = saveUploadedImage($uploadFile, $targetDir);
    if ($savedName !== null) {
        $profile_image = $savedName;
    }
    // if validation fails, silently keep the old profile_image
}

$resumeFile = $_FILES['filenames'] ?? null;

if ($resumeFile && !empty($resumeFile['name'])) {
    require_once __DIR__ . "/ResumeUploadHelper.php";
    $targetDir = __DIR__ . "/../../public/uploads/";
    $savedResume = saveUploadedResume($resumeFile, $targetDir);
    if ($savedResume !== null) {
        $resume = $savedResume;
    }
    // if validation fails, silently keep the old resume
}

$result = $jobSeekerModel->jobseekerProfile(
    $conn, $user_id, $phone, $address, $skills, $education, $experience, $resume, $profile_image
);

header("Location: ../../index.php?page=js_profile");
exit;
?>