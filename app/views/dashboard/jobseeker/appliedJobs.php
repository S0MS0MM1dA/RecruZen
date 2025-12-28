<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Saved Jobs</title>
    <link rel="stylesheet" href="../../../../public/assets/css/dashboard.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
      integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>
  <body>

    <?php include '../layouts/sidebar.php'; ?>

    <main>
      <div class="dashboard-main">
        <div class="dashboard-container">
          <div class="dashboard-header">
            <h3>Applied Jobs!</h3>
            <p>Track Jobs that you applied.!!</p>
          </div>

          <section class="dashboard-tracker-div">
            <div class="tracker-header">
              <h4>Your Application Details</h4>
              <p>Track yous job applications</p>
            </div>
            <div class="tracker-table-div">
              <table class="tracker-table">
                <thead>
                  <tr>
                    <th>Job Title</th>
                    <th>Posting Date</th>
                    <th>Status</th>
                    <th>Applicant</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Senior Software Engineer</td>
                    <td>Jan 15, 2024</td>
                    <td><span class="status">Active</span></td>
                    <td>32</td>
                    <td>...</td>
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
