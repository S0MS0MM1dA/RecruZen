<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . '/../../../models/DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->openConnection();

$categories = $conn->query("SELECT id, name FROM categories ORDER BY name");
$locations  = $conn->query("SELECT id, name FROM locations ORDER BY name");
?>
<?php include __DIR__ . '/../../layouts/sidebar_recruiter.php'; ?>
    <main class="content">
      <div class="dashboard-main">
        <div class="dashboard-container">
          <div class="dashboard-header">
            <h1 class="title">Post New Jobs</h1>
            <p class="subtitle">Create a new job to recruit top talent</p>
          </div>
          <div class="post-jobs-container">
            <form action="app/controllers/JobHandler.php" class="post-job-form" method="POST">
              <section class="form-section">
                <h3 class="section-title">Basic Information</h3>

                <div class="form-group">
                  <div class="form-row">
                    <div class="form-field job-title-box">
                      <label for="title" class="form-label">Job Title</label>
                      <input
                        id="title"
                        type="text"
                        name="title"
                        placeholder="e.g. Senior React Developer"
                      />
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-field">
                      <select name="category_id" required>
                        <option value="">Select Category</option>
                        
                        <?php while($row = $categories->fetch_assoc()): ?>
                        <option value="<?= $row['id'] ?>">
                          <?= htmlspecialchars($row['name']) ?>
                        </option>
                        <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-field">
                      <select name="job_type">
                        <option value="full-time">Full Time</option>
                        <option value="part-time">Part Time</option>
                        <option value="remote">Remote</option>
                      </select>
                    </div>
                  </div>
                </div>
              </section>

              <section class="form-section">
                <h3 class="section-title">Location & Compensation</h3>

                <div class="form-group">
                  <div class="form-row">
                    <div class="form-field">
                      <select name="location_id">
                        <option value="">Select Location</option>
                        
                        <?php while($row = $locations->fetch_assoc()): ?>
                          <option value="<?= $row['id'] ?>">
                            <?= htmlspecialchars($row['name']) ?>
                          </option>
                        <?php endwhile; ?>
                      </select>
                    </div>
                    <div class="form-field">
                      <label for="workplace" class="form-label">Workplace Type</label>
                      <select name="workplace">
                        <option value="On-site">On-site</option>
                        <option value="Remote">Remote</option>
                        <option value="Hybrid">Hybrid</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-field">
                      <label for="salary" class="form-label"
                        >Minimum Salary</label
                      >
                      <input id="minimumSalary" type="text" name="min_salary" />
                    </div>
                    <div class="form-field">
                      <label for="salary" class="form-label"
                        >Maximum Salary</label
                      >
                      <input id="maximumSalary" type="text" name="max_salary" />
                    </div>
                  </div>
                </div>
              </section>
              <section class="form-section">
                <h3 class="section-title">Skills</h3>
                <div class="form-row">
                  <div class="form-field skills-wrapper">
                    <input class="skills" type="text" name="skills" />
                    <button type="button" class="add-skills-btn">Add Skills</button>
                  </div>
                </div>
              </section>
              <section class="form-section">
                <h3 class="section-title">Job Description</h3>

                <div class="form-group">
                  <div class="form-row">
                    <div class="form-field">
                      <label for="description" class="form-label"
                        >Job Description</label
                      >
                      <textarea name="description" id="description"></textarea>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-field">
                      <label for="requirement" class="form-label"
                        >Requirement</label
                      >
                      <textarea name="requirement" id="requirements"></textarea>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-field">
                      <label for="Benefits" class="form-label">Benefits</label>
                      <textarea name="benefits" id="benefits"></textarea>
                    </div>
                  </div>
                </div>
              </section>
              <section class="form-section">
                <h3 class="section-title">Application Details</h3>

                <div class="form-group">
                  <div class="form-row">
                    <div class="form-field">
                      <label class="form-label">Application date</label>
                      <input type="date" name="deadline" />
                    </div>
                    <div class="form-field">
                      <label class="form-label">Number of Vacancies</label>
                      <input type="number" name="vacancies" />
                    </div>
                  </div>
                </div>
              </section>

              <div class="form-actions">
                <button type="submit" name="status" value="draft" class="action-btn save-draft">
                  Save as Draft
                </button>
                <button type="submit" name="status" value="pending" class="action-btn publish-job">
                  Publish Job
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>