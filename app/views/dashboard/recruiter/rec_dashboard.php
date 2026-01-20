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
$recruiter = $db -> getRecruiterProfile($conn, $user_id);

$isEdit = isset($_GET['edit']) && $_GET['edit'] == 1;
?>
<?php include __DIR__ . '/../../layouts/sidebar_recruiter.php'; ?>
<main>
  <div class="dashboard-main">
    <div class="dashboard-container">
      <div class="dashboard-header">
        <h3>Welcome Back, <?= htmlspecialchars($recruiter['first_name'] ?? '') ?>!</h3>
        <p>Manage Your Job Posting and Find Your Best Job</p>
      </div>

      <section class="dashboard-status-div">
        <div class="stat-card">
          <div class="stat-card-info">
            <p class="label">Total Job Post here </p>
            <h3 class="value">12</h3>
            
          </div>
          <div class="stat-card-icon">
            <i class="fa-solid fa-file-lines"></i>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-card-info">
            <p class="label">Active Jobs</p>
            <h3 class="value">8</h3>
            <span class="growth positive">+12% from last month</span>
          </div>
          <div class="stat-card-icon">
            <i class="fa-solid fa-bookmark"></i>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-card-info">
            <p class="label">Total Applications</p>
            <h3 class="value">342</h3>
            <span class="growth positive">+12% from last month</span>
          </div>
          <div class="stat-card-icon">
            <i class="fa-solid fa-calendar-check"></i>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-card-info">
            <p class="label">New Applicants</p>
            <h3 class="value">7</h3>
            <span class="growth positive">+12% from last month</span>
          </div>
          <div class="stat-card-icon">
            <i class="fa-solid fa-eye"></i>
          </div>
        </div>
      </section>

      <section class="dashboard-tracker-div">
        <div class="tracker-header">
          <h4>Recent Job Post</h4>
          <p>Overview Of Your Last Job</p>
        </div>
        <div class="tracker-table-div">
          <table class="tracker-table">
            <thead>
              <tr>
                <th>Job Title</th>
                <th>Company</th>
                <th>Applied Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Senior Software Engineer</td>
                <td>TechCorp LTD</td>
                <td>Jan 15, 2024</td>
                <td>Reviewing</td>
                <td><a class="view-jobs-btn" href="#">View Jobs</a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>
    </div>
  </div>
</main>
