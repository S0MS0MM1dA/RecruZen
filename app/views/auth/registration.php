<?php
session_start();

$firstNameError = "";
$lastNameError = "";
$emailError = "";
$passwordError = "";
$confirmError = "";
$regError = "";

if(isset($_SESSION["firstNameError"])){
  $firstNameError = '<span class="firstNameError errors">' . $_SESSION['firstNameError'] . '</span>';
}
if(isset($_SESSION["lastNameError"])){
 $lastNameError = '<span class="lastNameError errors">' . $_SESSION['lastNameError'] . '</span>';
}
if(isset($_SESSION["emailError"])){
  $emailError = '<span class="emailError errors">' . $_SESSION['emailError'] . '</span>';
}
if(isset($_SESSION["confirmError"])){
  $passwordError = '<span class="passwordError errors">' . $_SESSION['passwordError'] . '</span>';
}
if(isset($_SESSION["passwordError"])){
 $confirmError = '<span class="confirmError errors">' . $_SESSION['confirmError'] . '</span>';
}
if(isset($_SESSION["regError"])){
  $regError = '<span class="regError"> errors' . $_SESSION['regError'] . '</span>';
}

?>

<main>
  <div class="container">
    <div class="account-div">
      <div class="account-header">
        <h2 class="logo-account">RecruZen</h2>
        <p>Welcome back! Please login to continue</p>
      </div>
      <div class="account-content">
        <div class="account-head">
          <h3 class="account-title">Register</h3>
          <p class="sub-title">Choose your account type to continue</p>
        </div>
        <div class="account-user-info">
         <form class="account-form" method="POST" action="app/controllers/RegistrationHandler.php">
            <input type="hidden" name="role" id="roleInput" value="jobseeker">
            <div class="user-type-div">
              <button type="button" class="type-btn active" onclick="setRole(event,'jobseeker')">Job Seeker</button>
              <button type="button" class="type-btn" onclick="setRole(event,'recruiter')">Recruiter</button>
            </div>
            <div class="info-box">
              <label class="account-labels" for="first_name">First Name<span style="color: red;">*</span></label>
              <input
                class="input"
                name="first_name"
                type="text"
                placeholder="RecruZen"
              />
              <?php echo $firstNameError ?>
            </div>
            <div class="info-box">
              <label class="account-labels" for="last_name">Last Name<span style="color: red;">*</span></label>
              <input
                class="input"
                name="last_name"
                type="text"
                placeholder="RecruZen"
              />
              <?php echo $lastNameError ?>
            </div>
            <div class="info-box">
              <label class="account-labels" for="email">Email<span style="color: red;">*</span></label>
              <input
                class="input"
                name="email"
                type="email"
                placeholder="your@email.com"
              />
              <?php echo $emailError ?>
            </div>
            <div class="info-box">
              <label class="account-labels" for="password">Password<span style="color: red;">*</span></label>
              <input
                class="input"
                name="password"
                type="password"
                placeholder="......."
              />
              <?php echo $passwordError ?>
            </div>
            <div class="info-box">
              <label class="account-labels" for="confirm_password"
                >Confirm Password<span style="color: red;">*</span></label
              >
              <input
                class="input"
                name="confirm_password"
                type="password"
                placeholder="......."
              />
              <?php echo $confirmError ?>
            </div>
            <div class="show-forget-btn">
              <label class="show-pass">
                <input type="checkbox" />
                <span>Show Password</span>
              </label>
              <a href="#" class="forget-pass-btn">Forget Password?</a>
            </div>
            <button type="submit" class="job-seeker-account">Register</button>
          </form>
          <div class="goole-div">
            <span class="divider">OR</span>
            <a href="#" class="google-account">
              <img
                src="public/assets/images/google_logo.svg"
                alt="Google Logo"
                class="google-svg"
              />
              Continue With Google
            </a>
          </div>
          <p>
            Already have an account?
            <a class="register-here" href="index.php?page=login">Login here</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
function setRole(e, role){
  document.getElementById("roleInput").value = role;

  document.querySelectorAll(".type-btn").forEach(btn => {
    btn.classList.remove("active");
  });

  e.target.classList.add("active");
}
</script>

