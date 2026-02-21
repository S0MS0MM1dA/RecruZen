<?php
session_start();
require_once __DIR__ . "/../models/DatabaseConnection.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: ../../index.php?page=admin_login");
  exit;
}

$email = trim($_POST["email"] ?? "");
$password = trim($_POST["password"] ?? "");

unset($_SESSION["emailError"], $_SESSION["passwordError"], $_SESSION["loginError"]);

if ($email === ""){
    $_SESSION["emailError"] = "Email is required";
}
if ($password === ""){
    $_SESSION["passwordError"] = "Password is required";
}

if (isset($_SESSION["emailError"]) || isset($_SESSION["passwordError"])) {
  $_SESSION["old"] = ["email" => $email];
  header("Location: ../../index.php?page=admin_login");
  exit;
}

$db = new DatabaseConnection();
$conn = $db->openConnection();
$user = $db->signin($conn, $email);

if ($user && password_verify($password, $user["password"])) {

  unset($user["password"]);

  if ($user["role"] != "admin") {
    $_SESSION["loginError"] = "Acces denied. Admin only.";
    header("Location: ../../index.php?page=admin_login");
    exit;
  }
  session_regenerate_id(true);
  unset($user["password"]);

  $_SESSION["isLoggedIn"] = true;
  $_SESSION["user"] = $user;
  header("Location: ../../index.php?page=home");

  exit;

}

$_SESSION["loginError"] = "Email or password is invalid";
header("Location: ../../index.php?page=admin_login");
exit;
?>
