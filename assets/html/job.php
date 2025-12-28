<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Jobs</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
      integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>
  <body>
    <?php include 'header.php'; ?>
    <main class="jobs-page">
      <div class="container jobs-layout">
        <aside class="jobs-filters">
          <form method="GET">
            <h4 class="filter-title">Filter</h4>

            <div class="filter-group">
              <h5>Job Type</h5>
              <label><input type="radio" />Full-time</label>
              <label><input type="radio" />Part-time</label>
              <label><input type="radio" />Remote</label>
              <label><input type="radio" />Contract</label>
            </div>

            <div class="filter-group">
              <h5>Salary Range</h5>
              <input type="number" placeholder="Minimum" />
              <input type="number" placeholder="Maximum" />
            </div>
            <div class="filter-group">
              <h5>Experience Level</h5>
              <label><input type="radio" />Entry Level</label>
              <label><input type="radio" />Mid Level</label>
              <label><input type="radio" />Senior Level</label>
              <label><input type="radio" />Lead</label>
            </div>

            <div class="filter-action">
              <button class="btn filter-btn">Apply Filters</button>
              <a href="job.php" class="filter-btn clear-filter">Clear Filter</a>
            </div>
          </form>
        </aside>

        <section class="job-list">
          <div class="jobs-header">
            <h1 class="title">Find Job</h1>
            <p class="subtitle">Find you dream job here</p>
          </div>
          <div class="job-card">
            <div class="job-card-content">
              <div class="job-card-left">
                <div class="job-icon">
                  <i class="fa-solid fa-briefcase"></i>
                </div>
              </div>

              <div class="job-info">
                <h3 class="job-title">Senior React Developer</h3>
                <p class="company-name">TechCorp Inc.</p>

                <div class="job-meta">
                  <span>
                    <i class="fa-solid fa-location-dot"></i>San Francisco, CA
                  </span>
                  <span>
                    <i class="fa-solid fa-dollar-sign"></i>$120k - $150k
                  </span>
                  <span> <i class="fa-regular fa-clock"></i> 2 days ago </span>
                </div>

                <p class="job-description">
                  We are looking for an experienced React developer to join our
                  dynamic team. You will be responsible for developing and
                  maintaining web applications using React, TypeScript, and
                  modern tools.
                </p>
              </div>
              <span class="job-badge">Full-time</span>
            </div>
            <div class="job-card-footer">
              <a href="jobDetails.php" class="action-btn view-btn"
                >View Details</a
              >
              <a href="saveJobs.php" class="action-btn save-btn">Save Jobs</a>
            </div>
          </div>

          <div class="job-card">
            <div class="job-card-content">
              <div class="job-card-left">
                <div class="job-icon">
                  <i class="fa-solid fa-briefcase"></i>
                </div>
              </div>

              <div class="job-info">
                <h3 class="job-title">Senior React Developer</h3>
                <p class="company-name">TechCorp Inc.</p>

                <div class="job-meta">
                  <span>
                    <i class="fa-solid fa-location-dot"></i>San Francisco, CA
                  </span>
                  <span>
                    <i class="fa-solid fa-dollar-sign"></i>$120k - $150k
                  </span>
                  <span> <i class="fa-regular fa-clock"></i> 2 days ago </span>
                </div>

                <p class="job-description">
                  We are looking for an experienced React developer to join our
                  dynamic team. You will be responsible for developing and
                  maintaining web applications using React, TypeScript, and
                  modern tools.
                </p>
              </div>
              <span class="job-badge">Full-time</span>
            </div>
            <div class="job-card-footer">
              <a href="jobDetails.php" class="action-btn view-btn"
                >View Details</a
              >
              <a href="saveJobs.php" class="action-btn save-btn">Save Jobs</a>
            </div>
          </div>

          <div class="job-card">
            <div class="job-card-content">
              <div class="job-card-left">
                <div class="job-icon">
                  <i class="fa-solid fa-briefcase"></i>
                </div>
              </div>

              <div class="job-info">
                <h3 class="job-title">Senior React Developer</h3>
                <p class="company-name">TechCorp Inc.</p>

                <div class="job-meta">
                  <span>
                    <i class="fa-solid fa-location-dot"></i>San Francisco, CA
                  </span>
                  <span>
                    <i class="fa-solid fa-dollar-sign"></i>$120k - $150k
                  </span>
                  <span> <i class="fa-regular fa-clock"></i> 2 days ago </span>
                </div>

                <p class="job-description">
                  We are looking for an experienced React developer to join our
                  dynamic team. You will be responsible for developing and
                  maintaining web applications using React, TypeScript, and
                  modern tools.
                </p>
              </div>
              <span class="job-badge">Full-time</span>
            </div>
            <div class="job-card-footer">
              <a href="jobDetails.php" class="action-btn view-btn"
                >View Details</a
              >
              <a href="saveJobs.php" class="action-btn save-btn">Save Jobs</a>
            </div>
          </div>

          <div class="job-card">
            <div class="job-card-content">
              <div class="job-card-left">
                <div class="job-icon">
                  <i class="fa-solid fa-briefcase"></i>
                </div>
              </div>

              <div class="job-info">
                <h3 class="job-title">Senior React Developer</h3>
                <p class="company-name">TechCorp Inc.</p>

                <div class="job-meta">
                  <span>
                    <i class="fa-solid fa-location-dot"></i>San Francisco, CA
                  </span>
                  <span>
                    <i class="fa-solid fa-dollar-sign"></i>$120k - $150k
                  </span>
                  <span> <i class="fa-regular fa-clock"></i> 2 days ago </span>
                </div>

                <p class="job-description">
                  We are looking for an experienced React developer to join our
                  dynamic team. You will be responsible for developing and
                  maintaining web applications using React, TypeScript, and
                  modern tools.
                </p>
              </div>
              <span class="job-badge">Full-time</span>
            </div>
            <div class="job-card-footer">
              <a href="jobDetails.php" class="action-btn view-btn"
                >View Details</a
              >
              <a href="saveJobs.php" class="action-btn save-btn">Save Jobs</a>
            </div>
          </div>

          <div class="job-card">
            <div class="job-card-content">
              <div class="job-card-left">
                <div class="job-icon">
                  <i class="fa-solid fa-briefcase"></i>
                </div>
              </div>

              <div class="job-info">
                <h3 class="job-title">Senior React Developer</h3>
                <p class="company-name">TechCorp Inc.</p>

                <div class="job-meta">
                  <span>
                    <i class="fa-solid fa-location-dot"></i>San Francisco, CA
                  </span>
                  <span>
                    <i class="fa-solid fa-dollar-sign"></i>$120k - $150k
                  </span>
                  <span> <i class="fa-regular fa-clock"></i> 2 days ago </span>
                </div>

                <p class="job-description">
                  We are looking for an experienced React developer to join our
                  dynamic team. You will be responsible for developing and
                  maintaining web applications using React, TypeScript, and
                  modern tools.
                </p>
              </div>
              <span class="job-badge">Full-time</span>
            </div>
            <div class="job-card-footer">
              <a href="jobDetails.php" class="action-btn view-btn"
                >View Details</a
              >
              <a href="saveJobs.php" class="action-btn save-btn">Save Jobs</a>
            </div>
          </div>
        </section>
      </div>
    </main>
    <?php include 'footer.php'; ?>
  </body>
</html>
