<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sidebar</title>
    <link rel="stylesheet" href="../css/dashboard.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
      integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>
  <body>
    <aside class="sidebar-div">
      <div class="sidebar-container">
        <div class="sidebar-logo">RecruZen</div>
        <hr style="margin-bottom: 4px" />
        <nav class="sidebar-menu-div">
          <div class="dash-btn">
            <a href="dashboard.php"
              ><i class="fa-solid fa-house"></i><span>Dashboard</span></a
            >
          </div>
          <div class="dash-btn">
            <a href="#"><i class="fa-solid fa-user"></i><span>Profile</span></a>
          </div>
          <div class="dash-btn">
            <a href="#"
              ><i class="fa-solid fa-briefcase"></i><span>Find Jobs</span></a
            >
          </div>
          <div class="dash-btn">
            <a href="saveJobs.php"
              ><i class="fa-solid fa-bookmark"></i><span>Saved Jobs</span></a
            >
          </div>
          <div class="dash-btn">
            <a href="appliedJobs.php">
              <i class="fa-solid fa-bars-progress"></i
              ><span>Applied Jobs</span></a
            >
          </div>
          <div class="dash-btn">
            <a href="#"
              ><i class="fa-solid fa-bars-progress"></i><span>Settings</span></a
            >
          </div>
        </nav>
        <div class="logout-div dash-btn">
          <a href="../../index.php"
            ><i class="fa-solid fa-right-from-bracket"></i
            ><span>Logout</span></a
          >
        </div>
      </div>
    </aside>
    <footer></footer>
  </body>
</html>
