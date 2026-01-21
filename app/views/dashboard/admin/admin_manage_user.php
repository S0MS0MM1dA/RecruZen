
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . "/../../../models/DatabaseConnection.php";

if(!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "admin"){
    header("Location: ../../index.php?page=login");
    exit;
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$users = $db -> getAllUsers($conn);

?>
<?php include __DIR__ . '/../../layouts/sidebar_admin.php'; ?>
   <main>
     <div class="dashboard-main">
       <div class="dashboard-container">
         <div class="dashboard-header">
           <h3>Manage User</h3>
           <p>Manage all the users!</p>
         </div>

         <section class="dashboard-tracker-div">
           <div class="tracker-header">
             <h4>User Information</h4>
             <p>Track users</p>
           </div>
           <div class="tracker-table-div">
             <table class="tracker-table">
               <thead>
                 <tr>
                   <th>Nmae</th>
                   <th>Email</th>
                   <th>Role</th>
                   <th>Status</th>
                   <th>Created on</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>
                <?php if(!empty($users)): ?>
                <?php foreach($users as $user): ?>
                 <tr>
                   <td><?=htmlspecialchars($user['first_name'] . ' ' . $user['last_name'])?></td>
                   <td><?=htmlspecialchars($user['email'])?></td>
                   <td><?=htmlspecialchars(ucfirst($user['role']))?></td>
                   <td><span class="status"><?=htmlspecialchars(ucfirst($user['status']))?></span></td>
                   <td><?= date('d M Y',strtotime($user['created_at']))?></td>
                   <td>
                    <?php if($user['status'] == 'active'): ?>
                     <form method="POST" action="app/controllers/UserAction.php" onsubmit="return confirm('Are you sure you want to block this user?');">
                        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id']) ?>">
                        <button type="submit" class="icon-btn block-btn"><i class="fa-solid fa-user-lock"></i></button>
                      </form>
                    <?php else: ?>
                       <form method="POST" action="app/controllers/UserAction.php" onsubmit="return confirm('Are you sure you want to unblcok this user?');">
                        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id']) ?>">
                        <button type="submit" class="icon-btn delete-btn"><i class="fa-solid fa-table-cells-row-unlock"></i></button>
                      </form>
                    <?php endif; ?>
                   </td>
                 </tr>
                <?php endforeach; ?>
                <?php else: ?>
                 <tr>
                   <td colspan="6">No users found.</td>
                 </tr>
                <?php endif; ?>
               </tbody>
             </table>
           </div>
         </section>
       </div>
     </div>
   </main>
