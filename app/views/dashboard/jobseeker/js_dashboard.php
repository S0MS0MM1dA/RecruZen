
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
$jobseeker = $db -> getJobseekerProfile($conn, $user_id);
$jobs = $db -> getJobApplications($conn, $user_id);
$savedJobs = $db -> countSavedJobs($conn, $user_id);


?>
<?php include __DIR__ . '/../../layouts/sidebar_jobseeker.php'; ?>
    <main>
      <div class="dashboard-main">
        <div class="dashboard-container">
          <div class="dashboard-header">
            <h3>Welcome Back, 
              <?= htmlspecialchars($jobseeker['first_name'] ?? '') ?> 
              <?= htmlspecialchars($jobseeker['last_name'] ?? '') ?>!
            </h3>
            <p>This a temporary line</p>
          </div>

          <section class="dashboard-status-div">
            <div class="stat-card">
              <div class="stat-card-info">
                <p class="label">Total Application</p>
                <h3 class="value"><?= count($jobs); ?></h3>
              </div>
              <div class="stat-card-icon">
                <i class="fa-solid fa-file-lines"></i>
              </div>
            </div>

            <div class="stat-card">
              <div class="stat-card-info">
                <p class="label">Saved Jobs</p>
                <h3 class="value"><?= $savedJobs ?></h3>
              </div>
              <div class="stat-card-icon">
                <i class="fa-solid fa-bookmark"></i>
              </div>
            </div>

          </section>

          <section class="dashboard-tracker-div">
            <div class="tracker-header">
              <h4>Recent Applications</h4>
              <p>Track yous job applications</p>
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
                  <?php foreach($jobs as $job): ?>
                  <tr>
                    <td><?=htmlspecialchars($job['title'])?></td>
                    <td><?=htmlspecialchars($job['company_name'])?></td>
                    <td><?= date('d M Y',strtotime($job['applied_at']))?></td>
                    <td><?= ucfirst($job['status']) ?></td>
                    <td><a class="view-jobs-btn" href="index.php?page=job_details&id=<?= $job['job_id']?>">View Jobs</a></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </section>
        </div>
      </div>
    </main>
