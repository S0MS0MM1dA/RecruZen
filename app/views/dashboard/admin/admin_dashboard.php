<?php
require_once __DIR__ . "/../../../models/DatabaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->openConnection();

$totalUsers     = $db->countTotalUsers($conn);
$jobseekers     = $db->countJobseekers($conn);
$recruiters     = $db->countRecruiters($conn);
$totalJobs      = $db->countTotalJobs($conn);

$recentApps = $db->getRecentApplicationsAdmin($conn);
?>

<?php include __DIR__ . '/../../layouts/sidebar_admin.php'; ?>
    <main>
      <div class="dashboard-main">
        <div class="dashboard-container">
          <div class="dashboard-header">
            <h3>Welcome Back, Zubs!</h3>
            <p>This a admin dashboard</p>
          </div>

          <section class="dashboard-status-div">
            <div class="stat-card">
              <div class="stat-card-info">
                <p class="label">Total Users</p>
                <h3 class="value"><?= $totalUsers ?></h3>
              </div>
              <div class="stat-card-icon">
                <i class="fa-solid fa-file-lines"></i>
              </div>
            </div>

            <div class="stat-card">
              <div class="stat-card-info">
                <p class="label">Jobsekers</p>
                <h3 class="value"><?= $jobseekers ?></h3>
              </div>
              <div class="stat-card-icon">
                <i class="fa-solid fa-bookmark"></i>
              </div>
            </div>

            <div class="stat-card">
              <div class="stat-card-info">
                <p class="label">Recruiter</p>
                <h3 class="value"><?= $recruiters ?></h3>
              </div>
              <div class="stat-card-icon">
                <i class="fa-solid fa-calendar-check"></i>
              </div>
            </div>

            <div class="stat-card">
              <div class="stat-card-info">
                <p class="label">Total Jobs</p>
                <h3 class="value"><?= $totalJobs ?></h3>
              </div>
              <div class="stat-card-icon">
                <i class="fa-solid fa-eye"></i>
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
                    <th>Posted Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($recentApps)): ?>
                    <?php foreach ($recentApps as $app): ?>
                    <tr>
                      <td><?= $app['title'] ?></td>
                      <td><?= $app['company_name'] ?></td>
                      <td><?= date('M d, Y', strtotime($app['posted_date'])) ?></td>
                      <td><?= ucfirst($app['status']) ?></td>
                      <td>
                        <a class="view-jobs-btn" href="index.php?page=job_details&id=<?= $job['job_id']?>">View</a>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="5">No recent applications</td>
                    </tr>
                  <?php endif; ?>
                </tbody>  
              </table>
            </div>
          </section>
        </div>
      </div>
    </main>
