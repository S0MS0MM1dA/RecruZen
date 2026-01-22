<aside class="sidebar-div">
  <div class="sidebar-container">
    <div class="sidebar-logo">RecruZen</div>
    <hr style="margin-bottom: 4px" />
    <nav class="sidebar-menu-div">
      <div class="dash-btn">
        <a href="index.php?page=admin_dashboard" class="<?= ($page=='admin_dashboard') ? 'active' : '' ?>"
          ><i class="fa-solid fa-house"></i><span>Dashboard</span></a
        >
      </div>
      <div class="dash-btn">
        <a href="index.php?page=admin_manage_user" class="<?= ($page=='admin_manage_user') ? 'active' : '' ?>"
          ><i class="fa-solid fa-user"></i><span>Manage Users</span></a
        >
      </div>
      <div class="dash-btn">
        <a href="index.php?page=admin_manage_jobs" class="<?= ($page=='admin_manage_jobs') ? 'active' : '' ?>"
          ><i class="fa-solid fa-bookmark"></i><span>Job Approval</span></a
        >
      </div>
      <div class="dash-btn">
        <a href="index.php?page=admin_manage_category" class="<?= ($page=='admin_manage_category') ? 'active' : '' ?>">
          <i class="fa-solid fa-bars-progress"></i><span>Manage Categories</span></a
        >
      </div>
      <div class="dash-btn">
        <a href="index.php?page=admin_settings" class="<?= ($page=='admin_settings') ? 'active' : '' ?>"
          ><i class="fa-solid fa-gear"></i><span>Settings</span></a
        >
      </div>
    </nav>
    <div class="logout-div dash-btn">
      <a href="app/controllers/Logout.php"
        ><i class="fa-solid fa-right-from-bracket"></i><span>Logout</span></a
      >
    </div>
  </div>
</aside>
