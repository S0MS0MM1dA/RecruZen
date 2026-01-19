<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . "/../../../models/DatabaseConnection.php";

if(!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "jobseeker"){
    header("Location: ../../index.php?page=login");
    exit;
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$user_id = $_SESSION['user']['id'];
$jobs = $db -> getSavedJob($conn, $user_id);

?>
<?php include __DIR__ . '/../../layouts/sidebar_jobseeker.php'; ?>
    <main class="content">
      <div class="dashboard-main">
        <div class="dashboard-container">
          <div class="dashboard-header">
            <h1 class="title">Saved Jobs</h1>
            <p class="subtitle">Jobs you've bookmarked for later</p>
          </div>
          <div class="dashboard-list-container">
            <div class="dashboard-card-grid">
              <?php foreach($jobs as $job): ?>
              <div class="dashboard-card">
                <div class="card-header saved-job-header">
                  <div class="card-avatar">S</div>
                  <i class="fa-solid fa-bookmark saved-job-bookmark"></i>
                </div>
                <h3 class="card-title"><?= htmlspecialchars($job['title']) ?></h3>
                <p class="card-subtitle"><?= htmlspecialchars($job['company_name']) ?></p>
                <div class="card-info">
                  <span>
                    <i class="fa-solid fa-location-dot"></i>
                    <?= htmlspecialchars($job['workplace']) ?>
                  </span>
                  <span>$
                    <?= htmlspecialchars($job['min_salary']) ?>k - 
                    <?= htmlspecialchars($job['max_salary']) ?>k
                  </span>
                  <span><i class="fa-regular fa-clock"></i>Posted on <?= date('d M Y', strtotime($job['created_at']))?></span>
                </div>
                <div class="card-actions">
                  <a href="#" class="btn-primary action-btn">Apply Now</a>
                  <a href="index.php?page=job_details&id=<?= $job['id']?>" class="btn-secondary action-btn">View Details</a>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </main>