<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Post Jobs</title>
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
    <?php include 'sidebar.php'; ?>
    <main class="content">
      <div class="dashboard-main">
        <div class="dashboard-container">
          <div class="dashboard-header">
            <h1 class="title">Post New Jobs</h1>
            <p class="subtitle">Create a new job to recruit top talent</p>
          </div>
          <div class="post-jobs-container">
            <form action="" class="post-job-form" method="POST">
              <section class="job-information">
                <h3 class="job-subtitle">Basic Information</h3>

                <div class="job-inputs">
                  <div class="job-input-row">
                    <div class="info-box job-title-box">
                      <label for="title" class="job-labels">Job Title</label>
                      <input
                        id="title"
                        type="text"
                        name="title"
                        placeholder="e.g. Senior React Developer"
                      />
                    </div>
                  </div>
                  <div class="job-input-row">
                    <div class="info-box">
                      <label for="category" class="job-labels">Category</label>
                      <input id="category" type="text" name="category" />
                    </div>
                    <div class="info-box">
                      <label class="job-labels">Job Type</label>
                      <input id="jobType" type="text" name="type" />
                    </div>
                  </div>
                </div>
              </section>

              <section class="job-information">
                <h3 class="job-subtitle">Location & Compensation</h3>

                <div class="job-inputs">
                  <div class="job-input-row">
                    <div class="info-box">
                      <label for="location" class="job-labels">Location</label>
                      <input id="location" type="text" name="location" />
                    </div>
                    <div class="info-box">
                      <label for="workplace" class="job-labels"
                        >Workplace Type</label
                      >
                      <input id="workplace" type="text" name="workplace" />
                    </div>
                  </div>
                  <div class="job-input-row">
                    <div class="info-box">
                      <label for="salary" class="job-labels"
                        >Minimum Salary</label
                      >
                      <input id="minimumSalary" type="text" name="max_salary" />
                    </div>
                    <div class="info-box">
                      <label for="salary" class="job-labels"
                        >Maximum Salary</label
                      >
                      <input id="maximumSalary" type="text" name="min_salary" />
                    </div>
                  </div>
                </div>
              </section>
              <section class="job-information">
                <h3 class="job-subtitle">Skills</h3>
                <div class="job-input-row">
                  <div class="info-box skills-wrapper">
                    <input class="skills" type="text" name="skills" />
                    <button type="button">Add Skills</button>
                  </div>
                </div>
              </section>
              <section class="job-information">
                <h3 class="job-subtitle">Job Description</h3>

                <div class="job-inputs">
                  <div class="job-input-row">
                    <div class="info-box">
                      <label for="description" class="job-labels"
                        >Job Description</label
                      >
                      <textarea name="jobDescription" id=""></textarea>
                    </div>
                  </div>
                  <div class="job-input-row">
                    <div class="info-box">
                      <label for="requirement" class="job-labels"
                        >Requirement</label
                      >
                      <textarea name="" id=""></textarea>
                    </div>
                  </div>
                  <div class="job-input-row">
                    <div class="info-box">
                      <label for="Benefits" class="job-labels">Benefits</label>
                      <textarea name="" id=""></textarea>
                    </div>
                  </div>
                </div>
              </section>
              <section class="job-information">
                <h3 class="job-subtitle">Application Details</h3>

                <div class="job-inputs">
                  <div class="job-input-row">
                    <div class="info-box">
                      <label class="job-labels">Application date</label>
                      <input type="date" name="date" />
                    </div>
                    <div class="info-box">
                      <label class="job-labels">Number of Vacancies</label>
                      <input type="number" name="vacancy" />
                    </div>
                  </div>
                </div>
              </section>

              <div class="form-actions">
                <button type="submit" class="action-btn save-draft">
                  Save as Draft
                </button>
                <button type="submit" class="action-btn publish-job">
                  Publish Job
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>
