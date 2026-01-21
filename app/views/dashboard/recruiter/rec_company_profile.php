<?php
session_start();
require_once __DIR__ . "/../../../models/DatabaseConnection.php";

if(!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "recruiter"){
    header("Location: ../../index.php?page=login");
    exit;
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$user_id = $_SESSION['user']['id'];
$recruiter = $db -> getRecruiterProfile($conn, $user_id);

$isEdit = isset($_GET['edit']) && $_GET['edit'] == 1;
?>
<?php include __DIR__ . '/../../layouts/sidebar_recruiter.php'; ?>
<main class="content">
  <div class="dashboard-main">
    <div class="dashboard-container">
      <div class="dashboard-header">
        <h1 class="title">Company Profile</h1>
        <?php echo $isEdit ? 'EDIT MODE' : 'VIEW MODE'; ?>
        <p class="subtitle">Manage you company information</p>
      </div>

      <div class="profile-container">
        <form action="app/controllers/RecruiterProfileHandler.php" class="profile-form" method="POST" enctype="multipart/form-data">
          <div class="section-part">
            <section class="form-section profile-photo">
              <h3 class="section-title">Company Logo</h3>

              <div class="profile-img-wrapper">
                <div class="profile-img">
                    <?php if(!empty($recruiter['company_logo'])): ?> 
                        <img class="uploaded-img" src="public/uploads/<?php echo htmlspecialchars($recruiter['company_logo']); ?>" alt="Company Logo"/>
                    <?php else: ?>DP
                    <?php endif; ?>
                </div>
                <?php if($isEdit): ?>
                <input type="file" id="profile-img-upload" name="company_logo" hidden/>
                
                <button type="button" class="profile-img-btn" onclick="document.getElementById('profile-img-upload').click()">
                  <i class="fa-solid fa-camera"></i>
                </button>
                <p>JPG, PNG</p>
                <?php endif; ?>
              </div>

            </section>

            <section class="form-section personal-details">
              <h3 class="section-title">Company Details</h3>

              <div class="form-group">
                <div class="form-row">
                  <div class="form-field">
                    <label for="name" class="form-label">Company Name</label>
                    <input id="company_name" type="text" name="company_name" 
                        value="<?= htmlspecialchars($recruiter['company_name'] ?? '') ?>" 
                        <?= $isEdit ? '' : 'readonly' ?>
                        />
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-field">
                    <label for="email" class="form-label">Email</label>
                    <input id="company_email" type="email" name="company_email"
                        value="<?= htmlspecialchars($recruiter['company_email'] ?? '') ?>" 
                        <?= $isEdit ? '' : 'readonly' ?>    
                    />
                  </div>
                  <div class="form-field">
                    <label for="phone" class="form-label">Phone</label>
                    <input id="phone" type="tel" name="company_phone" 
                        value="<?= htmlspecialchars($recruiter['company_phone'] ?? '') ?>" 
                        <?= $isEdit ? '' : 'readonly' ?>
                    />
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-field">
                    <label for="location" class="form-label">Location</label>
                    <input id="location" type="text" name="company_location" 
                        value="<?= htmlspecialchars($recruiter['company_location'] ?? '') ?>" 
                        <?= $isEdit ? '' : 'readonly' ?>
                    />
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-field">
                    <label for="summary" class="form-label"
                      >Company Description</label
                    >
                    <textarea id="company_description" name="company_description" 
                    <?= $isEdit ? '' : 'readonly' ?>
                    ><?= htmlspecialchars($recruiter['company_description'] ?? '') ?></textarea>
                  </div>
                </div>
              </div>
            </section>
          </div>
          <div class="section-part">
            <section class="form-section skills">
              <h3 class="section-title">Website Link</h3>
              <div class="form-row">
                <div class="form-field website-wrapper">
                  <input class="website" type="text" name="company_website" 
                    value="<?= htmlspecialchars($recruiter['company_website'] ?? '') ?>" 
                    <?= $isEdit ? '' : 'readonly' ?>/>
                </div>
              </div>
            </section>
            <section class="form-section resume">
              <h3 class="section-title">About</h3>

              <div class="form-group">
                <div class="form-row">
                  <div class="form-field">
                   <textarea id="company_about" name="company_about"
                    <?= $isEdit ? '' : 'readonly' ?>
                ><?= htmlspecialchars($recruiter['company_about'] ?? '') ?>
                </textarea>
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
              onclick ="window.location.href='index.php?page=rec_company_profile&edit=1'">
                Update Profile
            </button>
            <?php endif; ?>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
