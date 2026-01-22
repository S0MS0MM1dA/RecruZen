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
$jobs = $db->getRecruiterJobs($conn, $user_id);

$totalJobs      = $db->countRecruiterJobs($conn, $user_id);
$activeJobs     = $db->countActiveJobs($conn, $user_id);
$pendingJobs    = $db->countPendingJobs($conn, $user_id);
$totalApplicants= $db->countTotalApplicants($conn, $user_id);
$newApplicants  = $db->countNewApplicants($conn, $user_id);


?>
<?php include __DIR__ . '/../../layouts/sidebar_recruiter.php'; ?>
<main>
  <div class="dashboard-main">
    <div class="dashboard-container">
      <div class="dashboard-header">
        <h3>Welcome Back, 
          <?= htmlspecialchars($recruiter['first_name'] ?? '') ?> 
          <?= htmlspecialchars($recruiter['last_name'] ?? '') ?>!
        </h3>
        <p>Manage Your Job Posting and Find Your Best Job</p>
      </div>

      <section class="dashboard-status-div">
        <div class="stat-card">
          <div class="stat-card-info">
            <p class="label">Total Job Post here </p>
            <h3 class="value"><?= $totalJobs; ?></h3>
            <span class="growth positive">+12% from last month</span>
            
          </div>
          <div class="stat-card-icon">
            <i class="fa-solid fa-file-lines"></i>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-card-info">
            <p class="label">Active Jobs</p>
            <h3 class="value"><?= $activeJobs; ?></h3>
          </div>
          <div class="stat-card-icon">
            <i class="fa-solid fa-bookmark"></i>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-card-info">
            <p class="label">Pending Jobs</p>
            <h3 class="value"><?= $pendingJobs; ?></h3>
            
          </div>
          <div class="stat-card-icon">
            <i class="fa-solid fa-bookmark"></i>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-card-info">
            <p class="label">Total Applicants</p>
            <h3 class="value"><?= $totalApplicants; ?></h3>
            
          </div>
          <div class="stat-card-icon">
            <i class="fa-solid fa-calendar-check"></i>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-card-info">
            <p class="label">New Applicants</p>
            <h3 class="value"><?= $newApplicants; ?></h3>
            
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
                    <th>Posting Date</th>
                    <th>Status</th>
                    <th>Applicant</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                 <?php foreach ($jobs as $job) {?>
                  <tr>
                    <td><?= htmlspecialchars($job['title']) ?></td>
                    <td><?= htmlspecialchars(date('M d, Y', strtotime($job['created_at']))) ?></td>
                    <td><?= ucfirst($job['status']) ?></td>
                    <td><?= htmlspecialchars($job['total_applicants']) ?></td>
                    <td>
                      <form method="POST" action="app/controllers/DeleteJobController.php" onsubmit="return confirm('Are you sure you want to delete this job?');">
                        <input type="hidden" name="job_id" value="<?= htmlspecialchars($job['id']) ?>">
                        <button type="submit" class="delete-btn"><i class="fa-regular fa-trash-can"></i></button>
                      </form>
                    </td>
                  </tr>
                  <?php }?>
                </tbody>
              </table>
            </div>
      </section>
    </div>
  </div>
</main>
