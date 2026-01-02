<?php
session_start();
require_once __DIR__ . "/../models/DatabaseConnection.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: ../../index.php?page=register");
  exit;
}

$first_name = trim($_POST["first_name"] ?? "");
$last_name = trim($_POST["last_name"] ?? "");
$email = trim($_POST["email"] ?? "");
$password = trim($_POST["password"] ?? "");
$confirm = trim($_POST["confirm_password"] ?? "");
$role = trim($_POST["role"] ?? "jobseeker");

unset($_SESSION["firstNameError"],$_SESSION["lastNameError"],$_SESSION["emailError"],$_SESSION["confirmError"],$_SESSION["passwordError"]);

if ($first_name == ""){
    $_SESSION["firstNameError"] = "First name is required";
}
if ($last_name == ""){
    $_SESSION["lastNameError"]  = "Last name is required";
}
if ($email == ""){
    $_SESSION["emailError"]     = "Email is required";
}
if ($password == ""){
    $_SESSION["passwordError"]  = "Password is required";
}
if ($confirm == ""){
    $_SESSION["confirmError"] = "Confirm Password is required";
}
if ($password != "" && $confirm != "" && $password != $confirm) {
  $_SESSION["confirmError"] = "Password do not match";
}

if (
  isset($_SESSION["firstNameError"]) ||
  isset($_SESSION["lastNameError"])  ||
  isset($_SESSION["emailError"])     ||
  isset($_SESSION["passwordError"])  ||
  isset($_SESSION["confirmError"])
) {
  $_SESSION["old"] = [
    "first_name" => $first_name,
    "last_name" => $last_name,
    "email" => $email,
    "role" => $role
  ];
  header("Location: ../../index.php?page=register");
  exit;
}


$db = new DatabaseConnection();
$conn = $db->openConnection();
$result = $db->signUp($conn, $first_name, $last_name, $email, $password, $role);

if ($result) {
  $_SESSION["regSuccess"] = "Account Created. Please Login";
  header("Location: ../../index.php?page=login");
  exit;
}

$_SESSION["regErr"] = "Failed to register";
header("Location: ../../index.php?page=register");
exit;
