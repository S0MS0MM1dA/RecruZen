<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/../models/DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->openConnection();

$keyword = $_POST['keyword'] ?? '';
$location = $_POST['location'] ?? '';

$jobs = $db->searchJobs($conn, $keyword, $location);

if(!$jobs) {
    echo "<p>No jobs found.</p>";
    exit;
}
?>
<?php foreach($jobs as $job): ?>
    <div class="job-card">
            <div class="job-card-content">
              <div class="job-card-left">
                <div class="job-icon">
                  <i class="fa-solid fa-briefcase"></i>
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
