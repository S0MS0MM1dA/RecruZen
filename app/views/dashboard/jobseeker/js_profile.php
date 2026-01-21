<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . "/../../../models/DatabaseConnection.php";

if(!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "jobseeker"){
    header("Location: ../../index.php?page=login");
    exit;
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$user_id = $_SESSION['user']['id'];
$jobseeker = $db -> getJobseekerProfile($conn, $user_id);

$isEdit = isset($_GET['edit']) && $_GET['edit'] == 1;
?>

<?php include __DIR__ . '/../../layouts/sidebar_jobseeker.php'; ?>
<main class="content">
  <div class="dashboard-main">
    <div class="dashboard-container">
      <div class="dashboard-header">
        <h1 class="title">My Profile</h1>
        <p class="subtitle">Manage you personal information and resume</p>
      </div>

      <div class="profile-container">
        <form action="app/controllers/JobseekerProfileHandler.php" class="profile-form" method="POST" enctype="multipart/form-data">
          <div class="section-part">
            <section class="form-section profile-photo">
              <h3 class="section-title">Profile Photo</h3>

              <div class="profile-img-wrapper">
                <div class="profile-img">
                  <?php if(!empty($jobseeker['profile_image'])): ?> 
                    <img class="uploaded-img" src="public/uploads/<?= htmlspecialchars($jobseeker['profile_image']) ?>" alt="Profile Photo">
                  <?php else: ?>DP
                  <?php endif; ?>
                </div>
                <?php if($isEdit): ?>
                <input type="file" id="profile-img-upload" name="profile_image" hidden/>
               
                <button type="button" class="profile-img-btn" onclick="document.getElementById('profile-img-upload').click()">
                  <i class="fa-solid fa-camera"></i>
                </button>
                <p>JPG, PNG</p>
                 <?php endif; ?>
              </div>

              
            </section>

            <section class="form-section personal-details">
              <h3 class="section-title">Personal Details</h3>

              <div class="form-group">
                <div class="form-row">
                  <div class="form-field">
                    <label for="first_name" class="form-label">First Name</label>
                    <input id="first_name" type="text" name="first_name" 
                      value="<?= htmlspecialchars($jobseeker['first_name'] ?? '') ?>" 
                      <?= $isEdit ? '' : 'readonly' ?>
                    />
                  </div>
                  <div class="form-field">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input id="last_name" type="text" name="last_name" 
                      value="<?= htmlspecialchars($jobseeker['last_name'] ?? '') ?>" 
                      <?= $isEdit ? '' : 'readonly' ?>/>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-field">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" 
                      value="<?= htmlspecialchars($jobseeker['email'] ?? '') ?>" 
                      <?= $isEdit ? '' : 'readonly' ?>
                    />
                  </div>
                  <div class="form-field">
                    <label for="phone" class="form-label">Phone</label>
                    <input id="phone" type="tel" name="phone" 
                      value="<?= htmlspecialchars($jobseeker['phone'] ?? '') ?>" 
                      <?= $isEdit ? '' : 'readonly' ?>
                    />
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-field">
                    <label for="address" class="form-label">Address</label>
                    <input id="address" type="text" name="address"
                      value="<?= htmlspecialchars($jobseeker['address'] ?? '') ?>" 
                      <?= $isEdit ? '' : 'readonly' ?>
                    />
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-field">
                    <label for="education" class="form-label"
                      >Education</label>
                    <textarea id="education" name="education"
                      <?= $isEdit ? '' : 'readonly' ?>
                    ><?= htmlspecialchars($jobseeker['education'] ?? '') ?></textarea>
                  </div>
                  <div class="form-field">
                    <label for="experience" class="form-label"
                      >Experience</label
                    >
                    <textarea id="experience" name="experience"
                    <?= $isEdit ? '' : 'readonly' ?>
                    ><?= htmlspecialchars($jobseeker['experience'] ?? '') ?></textarea>
                  </div>
                </div>
              </div>
            </section>
          </div>
          <div class="section-part">
            <section class="form-section skills">
              <h3 class="section-title">Skills</h3>
              <div class="form-row">
                <div class="form-field skills-wrapper">
                  <input class="skills" type="text" name="skills" 
                    value="<?= htmlspecialchars($jobseeker['skills'] ?? '') ?>" 
                    <?= $isEdit ? '' : 'readonly' ?>
                  />
                  <button type="button" class="add-skills-btn">
                    Add Skills
                  </button>
                </div>
              </div>
            </section>
            <section class="form-section resume">
              <h3 class="section-title">Resume</h3>

              <div class="form-group">
                <div class="form-row">
                  <div class="form-field">
                    <?php if($isEdit): ?>
                    <input
                      type="file"
                      name="filenames"
                      id="file-upload"
                      class="file-input"
                    />
                    <?php else: ?>
                      <?php if(!empty($jobseeker['resume'])): ?>
                        <a href="/public/uploads/<?= htmlspecialchars($jobseeker['resume']) ?>" target="_blank" class="resume-link">
                          View Resume
                        </a>
                      <?php else: echo $isEdit ? 'EDIT MODE' : 'VIEW MODE'; ?>
                        <p>No Resume uploaded</p>
                      <?php endif; ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </section>
          </div>

          <div class="form-actions">
            <?php if($isEdit): ?>
            <button
              type="submit"
              name="status"
              value="published"
              class="action-btn save-change"
            >
              Save Profile
            </button>
            <?php else: ?>
            <button
              type="button"
              class="action-btn save-change"
              onclick="window.location.href='index.php?page=js_profile&edit=1'"
            >
                Update Profile
            </button>
            <?php endif;  ?>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
