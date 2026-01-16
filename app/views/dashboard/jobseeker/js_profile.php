<?php include __DIR__ . '/../../layouts/sidebar_jobseeker.php'; ?>
<main class="content">
  <div class="dashboard-main">
    <div class="dashboard-container">
      <div class="dashboard-header">
        <h1 class="title">My Profile</h1>
        <p class="subtitle">Manage you personal information and resume</p>
      </div>

      <div class="profile-container">
        <form action="" class="profile-form" method="POST">
          <div class="section-part">
            <section class="form-section profile-photo">
              <h3 class="section-title">Profile Photo</h3>

              <div class="profile-img-wrapper">
                <div class="profile-img">DP</div>
                <input type="file" id="profile-img-upload" hidden/>
                <button type="button" class="profile-img-btn" onclick="document.getElementById('profile-img-upload').click()">
                  <i class="fa-solid fa-camera"></i>
                </button>
              </div>

              <p>JPG, PNG</p>
            </section>

            <section class="form-section personal-details">
              <h3 class="section-title">Personal Details</h3>

              <div class="form-group">
                <div class="form-row">
                  <div class="form-field">
                    <label for="firstname" class="form-label">First Name</label>
                    <input id="firstname" type="text" name="firstname" />
                  </div>
                  <div class="form-field">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input id="lastname" type="text" name="lastname" />
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-field">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" />
                  </div>
                  <div class="form-field">
                    <label for="phone" class="form-label">Phone</label>
                    <input id="phone" type="tel" name="phone" />
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-field">
                    <label for="location" class="form-label">Location</label>
                    <input id="location" type="text" name="location" />
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-field">
                    <label for="summary" class="form-label"
                      >Professional Summary</label
                    >
                    <textarea id="summary" name="summary"></textarea>
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
                  <input class="skills" type="text" name="skills" />
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
                    <input
                      type="file"
                      name="filenames"
                      id="file-upload"
                      class="file-input"
                    />
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
