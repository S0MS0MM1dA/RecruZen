<aside class="sidebar-div">
  <div class="sidebar-container">
    <div class="sidebar-logo">RecruZen</div>
    <hr style="margin-bottom: 4px" />
    <nav class="sidebar-menu-div">
      <div class="dash-btn">
        <a href="index.php?page=rec_dashboard" class="<?= ($page=='rec_dashboard') ? 'active' : '' ?>"
          ><i class="fa-solid fa-house"></i><span>Dashboard</span></a
        >
      </div>
      <div class="dash-btn">
        <a href="index.php?page=rec_company_profile" class="<?= ($page=='rec_company_profile') ? 'active' : '' ?>"
          ><i class="fa-solid fa-user"></i><span>Company Profile</span></a
        >
      </div>
      <div class="dash-btn">
        <a href="index.php?page=rec_post_job" class="<?= ($page=='rec_post_job') ? 'active' : '' ?>"
          ><i class="fa-solid fa-briefcase"></i><span>Post Jobs</span></a
        >
      </div>
      <div class="dash-btn">
        <a href="index.php?page=rec_manage_jobs" class="<?= ($page=='rec_manage_jobs') ? 'active' : '' ?>"
          ><i class="fa-solid fa-bookmark"></i><span>Manage Jobs</span></a
        >
      </div>
      <div class="dash-btn">
        <a href="index.php?page=rec_applicants" class="<?= ($page=='rec_applicants') ? 'active' : '' ?>">
          <i class="fa-solid fa-bars-progress"></i><span>Applicants</span></a
        >
      </div>
      <div class="dash-btn">
        <a href="index.php?page=rec_settings" class="<?= ($page=='rec_settings') ? 'active' : '' ?>"
          ><i class="fa-solid fa-bars-progress"></i><span>Settings</span></a
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
