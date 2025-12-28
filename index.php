<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RecruZen</title>
    <link rel="stylesheet" href="assets/css/style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
      integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>
  <body>
    <?php include 'assets/html/header.php'; ?>
    <main>
      <section id="welcome-section" class="welcome-section">
        <div class="container welcome-container">
          <div class="headeline-div">
            <h2>Find Your Dream Job Today</h2>
            <p>
              Discover thousands of opportunities from top companies worldwide
            </p>
          </div>
          <div class="headeline-search-div">
            <div class="input-warpper">
              <span class="input-icon"
                ><i class="fa-solid fa-magnifying-glass"></i
              ></span>
              <input
                type="text"
                placeholder="Job Title or Keyword"
                name=""
                id="job_keyword"
              />
            </div>
            <div class="input-warpper">
              <span class="input-icon"
                ><i class="fa-solid fa-location-dot"></i
              ></span>
              <input
                type="text"
                placeholder="Location"
                name=""
                id="job_location"
              />
            </div>
            <a class="search-btn btn" href="#">Search</a>
          </div>
        </div>
      </section>

      <section id="category-section" class="category-section">
        <div class="container category-container">
          <div class="title-div">
            <h3 class="title">Browse by Category</h3>
            <p class="short-deescription">
              Find jobs in your preferred industry
            </p>
          </div>
          <div class="category-div">
            <div class="category-wrapper">
              <span class="category-icon"
                ><i class="fa-solid fa-code"></i
              ></span>
              <h4 class="category-name">IT & Software</h4>
              <p class="category-jobs">1230 Jobs Available</p>
            </div>
          </div>
        </div>
      </section>

      <section id="featured-jobs" class="featured-jobs-section">
        <div class="container featured-jobs-container">
          <div class="title-div">
            <h3 class="title">Featured Jobs</h3>
            <p class="short-deescription">
              Explore our handpicked opportunities
            </p>
          </div>

          <div class="jobs-div">
            <div class="jobs-wrapper">
              <div class="job-content">
                <div class="job-logo">
                  <img
                    src="assets/images/google_logo.svg"
                    alt="Company Logo"
                    class="job-logo-img"
                  />
                </div>
                <div class="job-info">
                  <div class="job-title">
                    <h3>Senior React Developer</h3>
                    <span class="job-type full-time">Full Time</span>
                  </div>

                  <div class="job-company-info">
                    <p class="company-name">TechCorp Inc.</p>
                    <p class="company-location">
                      <i class="fa-solid fa-location-dot"></i>San Francisco, CA
                    </p>
                    <p class="job-salary">
                      <i class="fa-solid fa-dollar-sign"></i>$120k - $150k
                    </p>
                  </div>

                  <div class="job-description">
                    <p>
                      We are looking for an experienced React developer to join
                      our dynamic team. You will be responsible for developing
                      and maintaining web applications using React, TypeScript,
                      and modern tools.
                    </p>
                  </div>
                </div>
              </div>
              <div class="job-btn-div">
                <a class="job-details-btn" href="assets/html/jobDetails.php">View Details</a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <?php include 'assets/html/footer.php'; ?>
  </body>
</html>
