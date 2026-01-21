
    
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
                <h3 class="value">24</h3>
              </div>
              <div class="stat-card-icon">
                <i class="fa-solid fa-file-lines"></i>
              </div>
            </div>

            <div class="stat-card">
              <div class="stat-card-info">
                <p class="label">Jobsekers</p>
                <h3 class="value">24</h3>
              </div>
              <div class="stat-card-icon">
                <i class="fa-solid fa-bookmark"></i>
              </div>
            </div>

            <div class="stat-card">
              <div class="stat-card-info">
                <p class="label">Recruiter</p>
                <h3 class="value">24</h3>
              </div>
              <div class="stat-card-icon">
                <i class="fa-solid fa-calendar-check"></i>
              </div>
            </div>

            <div class="stat-card">
              <div class="stat-card-info">
                <p class="label">Total Jobs</p>
                <h3 class="value">24</h3>
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
