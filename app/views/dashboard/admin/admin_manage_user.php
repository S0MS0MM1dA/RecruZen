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
                 <tr>
                   <td>Zobayer Alom</td>
                   <td>zubs@gmail.com</td>
                   <td>Jobseeker</td>
                   <td><span class="status">Active</span></td>
                   <td>Jan 24, 2026</td>
                   <td>Block</td>
                 </tr>
               </tbody>
             </table>
           </div>
         </section>
       </div>
     </div>
   </main>
