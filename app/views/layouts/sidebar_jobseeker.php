<aside class="sidebar-div">
  <div class="sidebar-container">
    <div class="sidebar-logo">RecruZen</div>
    <hr style="margin-bottom: 4px" />
    <nav class="sidebar-menu-div">
      <div class="dash-btn">
        <a href="index.php?page=js_dashboard" class="<?= ($page=='js_dashboard') ? 'active' : '' ?>"
          ><i class="fa-solid fa-house"></i><span>Dashboard</span></a
        >
      </div>
      <div class="dash-btn">
        <a href="index.php?page=js_profile" class="<?= ($page=='js_profile') ? 'active' : '' ?>"
          ><i class="fa-solid fa-user"></i><span>Update Profile</span></a
        >
      </div>
      <div class="dash-btn">
        <a href="index.php?page=jobs" 
          ><i class="fa-solid fa-briefcase"></i><span>Find Jobs</span></a
        >
      </div>
      <div class="dash-btn">
        <a href="index.php?page=js_saved_jobs" class="<?= ($page=='js_saved_jobs') ? 'active' : '' ?>"
          ><i class="fa-solid fa-bookmark"></i><span>Saved Jobs</span></a
        >
      </div>
      <div class="dash-btn">
        <a href="index.php?page=js_applied_jobs" class="<?= ($page=='js_applied_jobs') ? 'active' : '' ?>"> 
          <i class="fa-solid fa-bars-progress"></i><span>Applied Jobs</span></a
        >
      </div>
      <div class="dash-btn">
        <a href="index.php?page=js_settings" class="<?= ($page=='js_settings') ? 'active' : '' ?>"
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
