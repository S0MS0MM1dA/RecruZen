
<?php 
session_start(); 
$page = $_GET['page'] ?? 'home';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RecruZen</title>
    <link rel="stylesheet" href="public/assets/css/style.css" />
    <?php
      $page = $_GET['page'] ?? 'home';
      $isDashboard = in_array($page, [
      'js_dashboard','js_saved_jobs','js_applied_jobs','js_profile',
      'rec_dashboard','rec_post_job','rec_manage_jobs',
      'admin_dashboard'
      ]);
    ?>

<?php if ($isDashboard): ?>
  <link rel="stylesheet" href="public/assets/css/dashboard.css" />
<?php endif; ?>

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
      integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>
  <body>
    <header id="header-section" class="header-container">
      <div class="container">
        <nav class="nav-bar">
          <div class="nav-logo-div">
            <a href="index.php?page=home" class="logo-img"
              >Recru<span>Zen</span></a
            >
          </div>
          <div class="nav-menu-div">
            <ul class="nav-menu">
              <li><a href="index.php?page=home">Home</a></li>
              <li><a href="index.php?page=jobs">Jobs</a></li>
              <li><a href="index.php?page=about">About</a></li>
              <li><a href="index.php?page=contact">Contact</a></li>
            </ul>
          </div>
          <div class="nav-btn-div">
            <ul>
              <?php if (!isset($_SESSION['user'])): ?>
                <li><a class="login-btn btn" href="index.php?page=login">Login</a></li>
                <li><a class="register-btn btn" href="index.php?page=register">Create Account</a></li>
              <?php else: ?>
                <?php
                  $role = $_SESSION['user']['role'] ?? '';
                  $dashPage = 'home';

                  if ($role === 'jobseeker') $dashPage = 'js_dashboard';
                  if ($role === 'recruiter') $dashPage = 'rec_dashboard';
                  if ($role === 'admin')     $dashPage = 'admin_dashboard';
                ?>
                <li><a class="dashboard-btn btn" href="index.php?page=<?= $dashPage ?>">Dashboard</a></li>
                <li>
                  <a href="index.php?page=profile" class="profile-link">
                    <img
                      src="public/assets/images/default_profile.avif"
                      alt="Profile"
                    />
                  </a>
                </li>
              <?php endif; ?>
            </ul>
          </div>
        </nav>
      </div>
    </header>
