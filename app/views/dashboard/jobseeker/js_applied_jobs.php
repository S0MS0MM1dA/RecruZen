
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
$jobs = $db -> getJobApplications($conn, $user_id);

?>
<?php include __DIR__ . '/../../layouts/sidebar_jobseeker.php'; ?>
    <main>
      <div class="dashboard-main">
        <div class="dashboard-container">
          <div class="dashboard-header">
            <h3>Applied Jobs!</h3>
            <p>Track Jobs that you applied.!!</p>
          </div>

          <section class="dashboard-tracker-div">
            <div class="tracker-header">
              <h4>Your Application Details</h4>
              <p>Track yous job applications</p>
            </div>
            <div class="tracker-table-div">
              <table class="tracker-table">
                <thead>
                  <tr>
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Applied On</th>
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
                    <td><a href="#">View Details</a></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </section>
        </div>
      </div>
    </main>