<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/../../../models/DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->openConnection();

if(!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "admin"){
    header("Location: ../../index.php?page=login");
    exit;
}

$pendingJobs = $db->getPendingJobs($conn);
$allJobs = $db->getAllJobsAdmin($conn);
?>

<?php include __DIR__ . '/../../layouts/sidebar_admin.php'; ?>
   <main>
     <div class="dashboard-main">
       <div class="dashboard-container">
         <div class="dashboard-header">
           <h3>Job Approval</h3>
           <p>Manage all the jobs!</p>
         </div>

         <section class="dashboard-tracker-div">
           <div class="tracker-header">
             <h4>Recent Job Post</h4>
             <p>Waiting for approval</p>
           </div>
           <div class="tracker-table-div">
             <table class="tracker-table">
               <thead>
                 <tr>
                   <th>Job ID</th>
                   <th>Posted By</th>
                   <th>Title</th>
                   <th>Description</th>
                   <th>Category</th>
                   <th>Posted on</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>
                <?php if(!empty($pendingJobs)): ?>
                  <?php foreach($pendingJobs as $job): ?>
                 <tr>
                   <td><?= $job['id'] ?></td>
                   <td><?= $job['first_name'].' '.$job['last_name'] ?></td>
                   <td><?= $job['title'] ?></td>
                   <td><?= substr($job['description'], 0, 50) ?>...</td>
                   <td><?= $job['category_name'] ?></td>
                   <td><?= date('M d, Y', strtotime($job['created_at'])) ?></td>
                   <td>
                    <form method="post" action="app/controllers/AdminJobController.php" style="display:inline;">
                      <input type="hidden" name="job_id" value="<?= $job['id'] ?>">
                      <input type="hidden" name="action" value="approve">
                      <button type="submit action-btn"><i class="fa-solid fa-check"></i></button>
                    </form>
                    <form method="post" action="app/controllers/AdminJobController.php" style="display:inline;">
                      <input type="hidden" name="job_id" value="<?= $job['id'] ?>">
                      <input type="hidden" name="action" value="reject">
                      <button type="submit action-btn"><i class="fa-solid fa-x"></i></button>
                    </form>
                  </td>
                 </tr>
                 <?php endforeach; ?>
                 <?php else: ?>
                <tr>
                  <td colspan="7">No pending jobs</td>
                </tr>
                <?php endif; ?>
               </tbody>
             </table>
           </div>
         </section>
         <section class="dashboard-tracker-div">
           <div class="tracker-header">
             <h4>All jobs</h4>
             <p>Track jobs</p>
           </div>
           <div class="tracker-table-div">
             <table class="tracker-table">
               <thead>
                 <tr>
                   <th>Job ID</th>
                   <th>Posted By</th>
                   <th>Title</th>
                   <th>Description</th>
                   <th>Category</th>
                   <th>Posted on</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>
                  <?php if(!empty($allJobs)): ?>
                  <?php foreach($allJobs as $job): ?>
                 <tr>
                   <td><?= $job['id'] ?></td>
                   <td><?= $job['first_name'].' '.$job['last_name'] ?></td>
                   <td><?= $job['title'] ?></td>
                   <td><?= substr($job['description'], 0, 50) ?>...</td>
                   <td><?= $job['category_name'] ?></td>
                   <td><?= date('M d, Y', strtotime($job['created_at'])) ?></td>
                   <td><?= ucfirst($job['status']) ?></td>
                 </tr>
                 <?php endforeach; ?>
                 <?php else: ?>
                <tr>
                  <td colspan="7">No pending jobs</td>
                </tr>
                <?php endif; ?>
               </tbody>
             </table>
           </div>
         </section>
       </div>
     </div>
   </main>
