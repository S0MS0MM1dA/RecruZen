<?php
session_start();
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
require_once __DIR__ . "/../models/DatabaseConnection.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: ../../index.php?page=login");
  exit;
}

$email = trim($_POST["email"] ?? "");
$password = trim($_POST["password"] ?? "");
$role = trim($_POST["role"] ?? "jobseeker");

unset($_SESSION["emailError"], $_SESSION["passwordError"], $_SESSION["loginError"]);

if ($email === ""){
    $_SESSION["emailError"] = "Email is required";
}
if ($password === ""){
    $_SESSION["passwordError"] = "Password is required";
}
if (isset($_SESSION["emailError"]) || isset($_SESSION["passwordError"])) {
  $_SESSION["old"] = ["email" => $email];
  header("Location: ../../index.php?page=login");
  exit;
}

$db = new DatabaseConnection();
$conn = $db->openConnection();
$user = $db->signin($conn, $email);

if ($user && password_verify($password, $user["password"])) {

  session_regenerate_id(true);

  if ($role !== "" && $role !== $user["role"]) {
    $_SESSION["loginError"] = "Wrong account type selected";
    $_SESSION["old"] = ["email" => $email];
    header("Location: ../../index.php?page=login");
    exit;
  }
  unset($user["password"]);

  $_SESSION["isLoggedIn"] = true;
  $_SESSION["user"] = $user;
  header("Location: ../../index.php?page=home");
  /*
  if ($user["role"] == "jobseeker"){
    header("Location: ../../index.php?page=js_dashboard");
  }else if ($user["role"] == "recruiter"){
    header("Location: ../../index.php?page=rec_dashboard");
  }
  else if ($user["role"] == "admin"){
    header("Location: ../../index.php?page=admin_dashboard");
  }
  else{
    header("Location: ../../index.php?page=home");
  }
  */
  exit;

}


$_SESSION["loginError"] = "Email or password is invalid";
header("Location: ../../index.php?page=login");
exit;
?>
