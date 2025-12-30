
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
            <div class="user-type-div">
              <button class="type-btn">Job Seeker</button>
              <button class="type-btn">Recruiter</button>
            </div>
            <div class="account-user-info">

              <form class="account-form" method="POST" action="index.php?page=login">
                <div class="info-box">
                  <label class="account-labels" for="email">Email</label>
                  <input
                    class="input"
                    name="email"
                    type="email"
                    placeholder="your@email.com"
                  />
                </div>
                <div class="info-box">
                  <label class="account-labels" for="password">Password</label>
                  <input
                    class="input"
                    name="password"
                    type="password"
                    placeholder="......."
                  />
                </div>
                <div class="show-forget-btn">
                  <label class="show-pass">
                    <input type="checkbox" />
                    <span>Show Password</span>
                  </label>
                  <a href="#" class="forget-pass-btn">Forget Password?</a>
                </div>
                <button class="job-seeker-account">Login as Job Seeker</button>
              </form>

              <div class="goole-div">
                <span class="divider">OR</span>
                <a href="#" class="google-account">
                  <img
                    src="../images/google_logo.svg"
                    alt="Google Logo"
                    class="google-svg"
                  />
                  Continue With Google
                </a>
              </div>
              <p>
                Don't have an account?
                <a class="register-here" href="#">Register here</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </main>

