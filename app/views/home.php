<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../models/DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->openConnection();

$jobs = $db->getAllJobs($conn);

if (!$jobs) {
    echo "JOB ID: ";
    var_dump($jobs_id);
    die("Job not found");
}

?>
<main>
  <section id="welcome-section" class="welcome-section">
    <div class="container welcome-container">
      <div class="headeline-div">
        <h2>Find Your Dream Job Today</h2>
        <p>Discover thousands of opportunities from top companies worldwide</p>
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
          <input type="text" placeholder="Location" name="" id="job_location" />
        </div>
        <a class="search-btn btn" href="#">Search</a>
      </div>
    </div>
  </section>

  <section id="category-section" class="category-section">
    <div class="container category-container">
      <div class="title-div">
        <h3 class="title">Browse by Category</h3>
        <p class="short-deescription">Find jobs in your preferred industry</p>
      </div>
      <div class="category-div">
        <div class="category-wrapper">
          <span class="category-icon"><i class="fa-solid fa-code"></i></span>
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
        <p class="short-deescription">Explore our handpicked opportunities</p>
      </div>

      <div class="jobs-div">
        <?php if(count($jobs) >0): ?>
        <?php foreach($jobs as $job): ?>
        <div class="jobs-wrapper">
          <div class="job-content">
            <div class="job-logo">
              <?php if(empty($job['company_logo'])): ?>
                <img src="public/assets/images/google_logo.svg" alt="Company logo">
              <?php else: ?>
              <img
                src="/public/uploads/<?= htmlspecialchars($job['company_logo']) ?>"
                alt="Company Logo"
                class="job-logo-img"
              />
              <?php endif; ?>
            </div>
            <div class="job-info">
              <div class="job-title">
                <h3><?= htmlspecialchars($job['title']) ?></h3>
                <p class="company-name"><?= htmlspecialchars($job['company_name']) ?></p>
              </div>

              <div class="job-company-info">
                <p class="company-location">
                  <i class="fa-solid fa-location-dot"></i><?= htmlspecialchars($job['location_name']) ?>
                </p>
                <p class="job-salary">
                  <i class="fa-solid fa-dollar-sign"></i>$<?= htmlspecialchars(round($job['min_salary'])) ?>k - $<?= htmlspecialchars(round($job['max_salary'])) ?>k
                </p>
              </div>

              <div class="job-description">
                <p>
                  <?= htmlspecialchars(substr($job['description'], 0, 100)) ?>...
                </p>
              </div>
            </div>
            <span class="job-type full-time"><?= htmlspecialchars($job['job_type']) ?></span>
          </div>
          <div class="job-btn-div">
            <a class="job-details-btn" href="index.php?page=job_details&id=<?= $job['id']?>"
              >View Details</a
            >
          </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
          <p>No Jobs found</p>
        <?php endif; ?>
      </div>
    </div>
  </section>
</main>
