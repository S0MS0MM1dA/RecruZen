<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../models/DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->openConnection();

// $job_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
//$job_id = 2; // For testing purposes only. Replace with actual job ID from GET parameter.

$job_type = $_GET['job_type'] ?? null;
$min_salary = $_GET['min_salary'] ?? null;
$max_salary = $_GET['max_salary'] ?? null;

$jobs = $db->getAllJobs($conn);


?>
<script src="public/js/jobSearch.js"></script>
    <main class="jobs-page">
      <div class="container jobs-layout">
        <aside class="jobs-filters">
          <form onsubmit="return false;">
            <h4 class="filter-title">Filter</h4>

            <div class="filter-group">
              <h5>Job Type</h5>
              <label><input type="radio" name="job_type" value="" checked onchange="ajaxJobSearch()" />All</label>
              <label><input type="radio" name="job_type" value="full-time" checked onchange="ajaxJobSearch()"/>Full-time</label>
              <label><input type="radio" name="job_type" value="part-time" checked onchange="ajaxJobSearch()" />Part-time</label>
              <label><input type="radio" name="job_type" value="contract" checked onchange="ajaxJobSearch()"/>Contract</label>
            </div>

            <div class="filter-group">
              <h5>Salary Range</h5>
              <input type="number" name="min_salary" placeholder="Minimum" onkeyup="ajaxJobSearch()"/>
              <input type="number" name="max_salary" placeholder="Maximum" onkeyup="ajaxJobSearch()"/>
            </div>
            <!--
            <div class="filter-group">
              <h5>Experience Level</h5>
              <label><input type="radio" />Entry Level</label>
              <label><input type="radio" />Mid Level</label>
              <label><input type="radio" />Senior Level</label>
              <label><input type="radio" />Lead</label>
            </div>
            
            
            <div class="filter-action">
              <button class="btn filter-btn">Apply Filters</button>
              <a href="index.php?page=jobs" class="filter-btn clear-filter">Clear Filter</a>
            </div>
            --->
          </form>
        </aside>

        <section class="job-list">
          <div class="jobs-header">
            <div class="jobs-headline">
              <h1 class="title">Find Job</h1>
              <p class="subtitle">Find you dream job here</p>
            </div>
            <div class="headeline-search-div jobs-search">
              <div class="input-warpper">
              <span class="input-icon">
                <i class="fa-solid fa-magnifying-glass"></i>
              </span>
              <input
                type="text"
                placeholder="Job Title or Keyword"
                name=""
                id="job_keyword"
                onkeyup="ajaxJobSearch()"
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
                  onkeyup="ajaxJobSearch()"
                />
              </div>
              <a class="search-btn btn" href="#">Search</a>
            </div>
          </div>

          <?php if(empty($jobs)): ?>
            <p>No Jobs found</p>
          <?php endif; ?>
          
          <div id="job-listings">
          <?php foreach($jobs as $job): ?>
          <div class="job-card">
            <div class="job-card-content">
              <div class="job-card-left">
                <div class="job-icon">
                  <?php if(empty($job['company_logo'])): ?>
                <img src="public/assets/images/google_logo.svg" alt="Company logo">
              <?php else: ?>
              <img
                src="public/uploads/<?= htmlspecialchars($job['company_logo']) ?>"
                alt="Company Logo"
                class="job-logo-img"
              />
              <?php endif; ?>
                </div>
              </div>

              <div class="job-info">
                <h3 class="job-title"><?= htmlspecialchars($job['title']) ?></h3>
                <p class="company-name"><?= htmlspecialchars($job['company_name']) ?></p>

                <div class="job-meta">
                  <span>
                    <i class="fa-solid fa-location-dot"></i><?= htmlspecialchars($job['location_name']) ?>
                  </span>
                  <span>
                    <i class="fa-solid fa-dollar-sign"></i>
                    <?= htmlspecialchars($job['min_salary']) ?> - <?= htmlspecialchars($job['max_salary']) ?>
                  </span>
                  <span> 
                    <i class="fa-regular fa-clock"></i>
                    <?= date('d M Y', strtotime($job['created_at']))?>
                  </span>
                </div>

                <p class="job-description">
                  <?= nl2br(htmlspecialchars($job['description'])) ?>
                </p>
              </div>
              <span class="job-badge"><?= ucfirst($job['job_type']) ?></span>
            </div>
            <div class="job-card-footer">
              <a href="index.php?page=job_details&id=<?= $job['id']?>" class="action-btn view-btn"
                >View Details</a>
              <form method="post" action="app/controllers/JobSaveHandler.php">
                <input type="hidden" name="job_id" value="<?= htmlspecialchars($job['id']) ?>" />
                <button type="submit" class="action-btn save-btn">Save Job</button>
              </form>
            <!-- <a href="index.php?page=js_saved&id=<?= $job['id']?>" class="action-btn save-btn">Save Jobs</a> -->
            </div>
          </div>
          <?php endforeach; ?>
          </div>
          </div>
        </section>
      </div>
    </main>