<?php 
session_start();

$emailError = '';
$passwordError = '';
$loginError = '';

if(isset($_SESSION['passwordError'])){
  $passwordError = '<span class="passwordError errors">' . $_SESSION['passwordError'] . '</span>';
}
if(isset($_SESSION['emailError'])){
  $emailError = '<span class="emailError errors">' . $_SESSION['emailError'] . '</span>';
}
if(isset($_SESSION['loginError'])){
  $loginError = '<span class="loginError errors">' . $_SESSION['loginError'] . '</span>';
}

unset($_SESSION['emailError'],$_SESSION['passwordError'],$_SESSION['loginError']);

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
              <h3 class="account-title">Login</h3>
              <p class="sub-title">Choose your account type to continue</p>
            </div>
            
            <div class="account-user-info">

              <form class="account-form" method="POST" action="app/controllers/LoginHandler.php">
                <input type="hidden" name="role" id="roleInput" value="jobseeker">
                <?php echo $loginError ?>
                <div class="user-type-div">
                  <button type="button" class="type-btn active" onclick="setRole(event,'jobseeker')">Job Seeker</button>
                  <button type="button" class="type-btn" onclick="setRole(event,'recruiter')">Recruiter</button>
                </div>     
                <div class="info-box">
                  <label class="account-labels" for="email">Email</label>
                  <input
                    class="input"
                    name="email"
                    type="email"
                    placeholder="your@email.com"
                    value="<?= htmlspecialchars($oldEmail) ?>"
                  />
                  <?php echo $emailError ?>
                </div>
                <div class="info-box">
                  <label class="account-labels" for="password">Password</label>
                  <input
                    class="input"
                    name="password"
                    type="password"
                    id="passwordInput"
                    placeholder="......."
                  />
                  <?php echo $passwordError ?>
                </div>
                
                <div class="show-forget-btn">
                  <label class="show-pass">
                    <input type="checkbox" id="showPassword"/>
                    <span>Show Password</span>
                  </label>
                  <a href="#" class="forget-pass-btn">Forget Password?</a>
                </div>
                <button type="submit" class="job-seeker-account">Login</button>
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
                Don't have an account?
                <a class="register-here" href="index.php?page=register">Register here</a>
              </p>
              <p style="margin-top:8px; font-size:14px;">
                Admin? 
                <a class="register-here" href="index.php?page=admin_login">Login Here</a>
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
  const showPassword = document.getElementById("showPassword");
  const passwordInput = document.getElementById("passwordInput");

  showPassword.addEventListener("change", function () {
    passwordInput.type = this.checked ? "text" : "password";
  });

</script>

