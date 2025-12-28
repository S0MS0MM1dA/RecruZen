<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RecruZen</title>
    <link rel="stylesheet" href="RecruZen/public/assets/css/style.css" />
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
            <a href="#" class="logo-img">Recru<span>Zen</span></a>
          </div>
          <div class="nav-menu-div">
            <ul class="nav-menu">
              <li><a href="index.php">Home</a></li>
              <li><a href="app/views/jobs/job.php">Jobs</a></li>
              <li><a href="app/views/dashboard/jobseeker/dashboard.php">About</a></li>
              <li><a href="app/views/dashboard/recruter/postjob.php">Contact</a></li>
            </ul>
          </div>
          <div class="nav-btn-div">
            <ul>
              <li>
                <a class="login-btn btn" href="app/views/auth/login.php">Login</a>
              </li>
              <li>
                <a class="register-btn btn" href="app/views/auth/registration.php"
                  >Create Account</a
                >
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>
</body>
</html>