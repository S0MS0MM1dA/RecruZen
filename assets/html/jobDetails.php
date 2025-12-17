<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RecruZen</title>
    <link rel="stylesheet" href="../css/style.css" />
    <!-- <link rel="stylesheet" href="../css/jobDetails.css" />. -->

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
              <li><a href="#welcome-section">Home</a></li>
              <li><a href="">Jobs</a></li>
              <li><a href="assets/html/dashboard.php">About</a></li>
              <li><a href="">Contact</a></li>
            </ul>
          </div>
          <div class="nav-btn-div">
            <ul>
              <li>
                <a class="login-btn btn" href="assets/html/login.php">Login</a>
              </li>
              <li>
                <a class="register-btn btn" href="assets/html/registration.php"
                  >Create Account</a
                >
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>

    <main>
      <div class="container">
        <div class="job-details-wrapper">
          <div class="job-details">
            <div class="job-header">
              <div class="company-logo">
                <img src="../images/google_logo.svg" alt="Company logo" />
              </div>

              <div class="job-title-box">
                <h1>Senior React Developer</h1>
                <p>Tech crop LTD</p>

                <div class="job-meta">
                  <span><i class="fa-solid fa-location-dot"></i> Location</span>
                  <span
                    ><i class="fa-solid fa-dollar-sign"></i> $120k - $160k</span
                  >
                  <span
                    ><i class="fa-regular fa-clock"></i> Posted 2 days ago</span
                  >
                </div>
              </div>
              <div class="job-type">
                <span>full time</span>
              </div>
            </div>

            <div class="job-section">
              <h3 class="job-subtitle">Job Description</h3>
              <p>
                We are looking for an experienced React developer to join our
                dynamic team. You will be responsible for developing and
                maintaining web applications using React, TypeScript, and modern
                development tools. This role offers the opportunity to work on
                cutting-edge projects and collaborate with talented
                professionals.
              </p>
            </div>
            <div class="job-section">
              <h3 class="job-subtitle">Key Responsibilities</h3>
              <ul>
                <li>Develop and maintain high-quality React applications</li>
                <li>Collaborate with design and backend teams</li>
                <li>Write clean, maintainable, and well-documented code</li>
                <li>Participate in code reviews and technical discussions</li>
                <li>Optimize applications for maximum performance</li>
              </ul>
            </div>
            <div class="job-section">
              <h3 class="job-subtitle">Requirements</h3>
              <ul>
                <li>5+ years of experience with React and modern JavaScript</li>
                <li>Strong proficiency in TypeScript</li>
                <li>Experience with state management (Redux, Zustand, etc.)</li>
                <li>Familiarity with modern build tools and CI/CD</li>
                <li>Excellent problem-solving and communication skills</li>
              </ul>
            </div>
            <div class="job-section">
              <h3 class="job-subtitle">Benefits</h3>
              <ul>
                <li>Competitive salary and equity package</li>
                <li>Health, dental, and vision insurance</li>
                <li>Flexible work arrangements</li>
                <li>Professional development opportunities</li>
                <li>Modern office with great perks</li>
              </ul>
            </div>
          </div>

          <div class="job-action">
            <div class="job-action-btn">
              <a href="#" class="apply-btn action-btn">Apply Now</a>
              <a href="#" class="save-btn action-btn">Save Job</a>
            </div>

            <div class="company-info">
              <h4>About Company</h4>
              <div class="company-meta">
                <p>Technology</p>
                <p>Employee</p>
                <p>Location</p>
              </div>
              <hr />
              <p class="company-description">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores
                reprehenderit sapiente commodi quam distinctio aperiam ipsa
                maxime, quod consectetur ipsum? Numquam aspernatur eius
                recusandae, sint commodi quod labore fugiat iusto.
              </p>
              <a href="#" class="company-website">visit Company</a>
            </div>
          </div>
        </div>
      </div>
    </main>
    <footer id="footer" class="footer">
      <div class="container footer-container">
        <div class="footer-content-div">
          <div class="footer-wrapper">
            <div class="footer-logo-div">
              <a href="#" class="logo-img">Recru<span>Zen</span></a>
            </div>
            <p>Your gateway to amazing career opportunities worldwide.</p>
          </div>
          <div class="footer-wrapper">
            <h2 class="footer-title">For Job Seekers</h2>
            <ul>
              <li><a href="#">Browse Jobs</a></li>
              <li><a href="#">Career Advice</a></li>
              <li><a href="#">Browse Jobs</a></li>
            </ul>
          </div>
          <div class="footer-wrapper">
            <h2 class="footer-title">For Recruters</h2>
            <ul>
              <li><a href="#">Post a Jobs</a></li>
              <li><a href="#">Browse Candidates</a></li>
              <li><a href="#">Pricing</a></li>
            </ul>
          </div>
          <div class="footer-wrapper">
            <h2 class="footer-title">Support</h2>
            <ul>
              <li><a href="#">Help Center</a></li>
              <li><a href="#">Privacy Policy</a></li>
              <li><a href="#">Terms of Service</a></li>
            </ul>
          </div>
        </div>
      </div>
      <p class="footer-copywrite">&copy 2025 RecruZen. All rights reserved.</p>
    </footer>
  </body>
</html>
