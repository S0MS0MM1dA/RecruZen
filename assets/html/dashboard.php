<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
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
    
    <?php include "sidebar.php"?>
    <main>
      <div class="dashboard-main">
        <div class="dashboard-container">
          <div class="dashboard-header">
            <h3>Welcome Back, SomSom!</h3>
            <p>This a temporary line</p>
          </div>

          <section class="dashboard-status-div">
            <div class="stat-card">
              <div class="stat-card-info">
                <p class="label">Total Application</p>
                <h3 class="value">24</h3>
                <span class="growth positive">+12% from last month</span>
              </div>
              <div class="stat-card-icon">
                <i class="fa-solid fa-file-lines"></i>
              </div>
            </div>

            <div class="stat-card">
              <div class="stat-card-info">
                <p class="label">Saved Jobs</p>
                <h3 class="value">24</h3>
                <span class="growth positive">+12% from last month</span>
              </div>
              <div class="stat-card-icon">
                <i class="fa-solid fa-bookmark"></i>
              </div>
            </div>

            <div class="stat-card">
              <div class="stat-card-info">
                <p class="label">Interview Invites</p>
                <h3 class="value">24</h3>
                <span class="growth positive">+12% from last month</span>
              </div>
              <div class="stat-card-icon">
                <i class="fa-solid fa-calendar-check"></i>
              </div>
            </div>

            <div class="stat-card">
              <div class="stat-card-info">
                <p class="label">Profile Views</p>
                <h3 class="value">24</h3>
                <span class="growth positive">+12% from last month</span>
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
                    <th>Applied Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Senior Software Engineer</td>
                    <td>TechCorp LTD</td>
                    <td>Jan 15, 2024</td>
                    <td>Reviewing</td>
                    <td><a class="view-jobs-btn" href="#">View Jobs</a></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </section>
        </div>
      </div>
    </main>
    <footer></footer>
  </body>
</html>
