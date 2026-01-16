<?php
$recruiter = $recruiter ?? [];
$isEdit = isset($_GET['edit']) && $_GET['edit'] == 1;
?>
<?php include __DIR__ . '/../../layouts/sidebar_recruiter.php'; ?>
<main class="content">
  <div class="dashboard-main">
    <div class="dashboard-container">
      <div class="dashboard-header">
        <h1 class="title">Company Profile</h1>
        <p class="subtitle">Manage you company information</p>
      </div>

      <div class="profile-container">
        <form action="" class="profile-form" method="POST" enctype="multipart/form-data">
          <div class="section-part">
            <section class="form-section profile-photo">
              <h3 class="section-title">Company Logo</h3>

              <div class="profile-img-wrapper">
                <div class="profile-img">DP</div>
                <input type="file" id="profile-img-upload" name="company-logo" hidden/>
                <button type="button" class="profile-img-btn" onclick="document.getElementById('profile-img-upload').click()">
                  <i class="fa-solid fa-camera"></i>
                </button>
              </div>

              <p>JPG, PNG</p>
            </section>

            <section class="form-section personal-details">
              <h3 class="section-title">Company Details</h3>

              <div class="form-group">
                <div class="form-row">
                  <div class="form-field">
                    <label for="name" class="form-label">Company Name</label>
                    <input id="company_name" type="text" name="company_name" />
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-field">
                    <label for="email" class="form-label">Email</label>
                    <input id="company_email" type="email" name="company_email" />
                  </div>
                  <div class="form-field">
                    <label for="phone" class="form-label">Phone</label>
                    <input id="phone" type="tel" name="company_phone" />
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-field">
                    <label for="location" class="form-label">Location</label>
                    <input id="location" type="text" name="company_location" />
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-field">
                    <label for="summary" class="form-label"
                      >Company Description</label
                    >
                    <textarea id="summacompany_descriptionry" name="company_description"></textarea>
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
                  <input class="website" type="text" name="company_website" />
                </div>
              </div>
            </section>
            <section class="form-section resume">
              <h3 class="section-title">About</h3>

              <div class="form-group">
                <div class="form-row">
                  <div class="form-field">
                   <textarea id="company_about" name="company_about"></textarea>
                  </div>
                </div>
              </div>
            </section>
          </div>

          <div class="form-actions">
            <button
              type="submit"
              name="status"
              value="published"
              class="action-btn save-change"
            >
              Save Change
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
