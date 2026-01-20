<?php
session_start();
require_once __DIR__ . "/../../../models/DatabaseConnection.php";

if(!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "recruiter"){
    header("Location: ../../index.php?page=login");
    exit;
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$user_id = $_SESSION['user']['id'];
$app = $db -> getJobApplications($conn, $user_id);

$isEdit = isset($_GET['edit']) && $_GET['edit'] == 1;
?>
<?php include __DIR__ . '/../../layouts/sidebar_jobseeker.php'; ?>
    <main class="content">
      <div class="dashboard-main">
        <div class="dashboard-container">
          <div class="dashboard-header">
            <h1 class="title">Applicants</h1>
            <p class="subtitle">Review and Manage job Application</p>
          </div>
          <div class="dashboard-list-container">
            <div class="dashboard-card-grid">
              <div class="dashboard-card">
                <div class="card-header">
                  <div class="card-avatar">S</div>
                  <div class="header-title-job">
                    <h3 class="card-title">Mili</h3>
                    <p class="card-subtitle">mili@bro.com</p>
                  </div>
                </div>
                
                <div class="card-info applicant-info">
                  <p class="check">Applied For</p>
                  <p class="check">Senior Sofware Engineer</p>
                  <p class="check">Applied on Jan 15 2025</p>
                </div>
                <div class="card-actions">
                  <a href="#" class="btn-primary action-btn">Resume</a>
                  <a href="jobDetails.php" class="btn-secondary action-btn">Contact</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>