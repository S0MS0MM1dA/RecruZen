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
            <p>Admin Portal</p>
          </div>
          <div class="account-content">
            <div class="account-head">
              <h3 class="account-title">Admin Login</h3>
              <p class="sub-title">Login to admin portal</p>
            </div>
            
            <div class="account-user-info">
              <form class="account-form" method="POST" action="app/controllers/AdminHandler.php">
                
                <?php echo $loginError ?>    
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
                    placeholder="......."
                  />
                  <?php echo $passwordError ?>
                </div>
                
                <div class="show-forget-btn">
                  <label class="show-pass">
                    <input type="checkbox" />
                    <span>Show Password</span>
                  </label>
                  <a href="#" class="forget-pass-btn">Back to user login</a>
                </div>
                <button type="submit" class="job-seeker-account">Login</button>
              </form>
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

