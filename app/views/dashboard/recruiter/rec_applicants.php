<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . "/../../../models/DatabaseConnection.php";

if(!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "recruiter"){
    header("Location: ../../index.php?page=login");
    exit;
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$user_id = $_SESSION['user']['id'];
$applicants = $db->getApplicants($conn, $user_id);
?>
<?php include __DIR__ . '/../../layouts/sidebar_recruiter.php'; ?>
    <main class="content">
      <div class="dashboard-main">
        <div class="dashboard-container">
          <div class="dashboard-header">
            <h1 class="title">Applicants</h1>
            <p class="subtitle">Review and Manage job Application</p>
          </div>
          <div class="dashboard-list-container">
            <div class="dashboard-card-grid">
              <?php foreach($applicants as $applicant): ?>
              <div class="dashboard-card">
                <div class="card-header">
                  <div class="card-avatar">S</div>
                  <div class="header-title-job">
                    <h3 class="card-title"><?=htmlspecialchars($applicant['first_name'])?> <?=htmlspecialchars($applicant['last_name'])?></h3>
                    <p class="card-subtitle"><?=htmlspecialchars($applicant['email'])?></p>
                  </div>
                </div>
                
                <div class="card-info applicant-info">
                  <p class="check app">Applied For</p>
                  <p class="check app_title"><?=htmlspecialchars($applicant['job_title'])?></p>
                  <p class="check app_date">Applied on <?=htmlspecialchars($applicant['applied_at'])?></p>
                </div>
                <div class="card-actions">
                  <a href="#" class="btn-primary action-btn"><span><i class="fa-solid fa-file-arrow-down"></i></span>  Resume</a>
                  <a href="jobDetails.php" class="btn-secondary action-btn"><span><i class="fa-regular fa-address-book"></i></span> Contact</a>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </main>