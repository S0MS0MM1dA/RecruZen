<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . "/../../../models/DatabaseConnection.php";

session_start();

$db = new DatabaseConnection();
$conn = $db->openConnection();

$user_id = $_SESSION['user']['id'];
$jobs = $db->getRecruiterJobs($conn, $user_id);
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
                    <td><?= htmlspecialchars(date('M d, Y', strtotime($job['created_at']))) ?></td>
                    <td>
                      <?php if ($job['status'] === 'active') { ?>
                        <span class="status active">Active</span>
                      <?php } else { ?>
                        <span class="status inactive">Inactive</span>
                      <?php } ?>
                    </td>
                    <td><?= htmlspecialchars($job['total_applicants']) ?></td>
                    <td>
                      <form method="POST" action="app/controllers/DeleteJobController.php" onsubmit="return confirm('Are you sure you want to delete this job?');">
                        <input type="hidden" name="job_id" value="<?= htmlspecialchars($job['id']) ?>">
                        <button type="submit" class="icon-btn delete-btn"><i class="fa-regular fa-trash-can"></i></button>
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