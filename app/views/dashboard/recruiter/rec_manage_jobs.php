<?php
require_once __DIR__ . '/../../database/DatabaseConnection.php';

session_start();

$db = new DatabaseConnection();
$conn = $db->openConnection();

$recruiter_id = $_SESSION['user_id'];
$jobs = $db->getRecruiterJobs($conn, $recruiter_id);
?>

<?php include __DIR__ . '/../../layouts/sidebar_recruiter.php'; ?>
    <main>
      <div class="dashboard-main">
        <div class="dashboard-container">
          <div class="dashboard-header">
            <h3>Manage Jobs!</h3>
            <p>View and manage all your job postings</p>
          </div>

          <section class="dashboard-tracker-div">
            <div class="tracker-header">
              <h4>Your Post Details</h4>
              <p>Track yous job Posting</p>
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
                    <td>Jan 15, 2024</td>
                    <td><span class="status">Active</span></td>
                    <td>32</td>
                    <td>...</td>
                  </tr>
                  <?php }?>
                </tbody>
              </table>
            </div>
          </section>
        </div>
      </div>
    </main>