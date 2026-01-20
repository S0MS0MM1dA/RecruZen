<?php include __DIR__ . '/../../layouts/sidebar_jobseeker.php'; ?>
    <main>
      <div class="dashboard-main">
        <div class="dashboard-container">
          <div class="dashboard-header">
            <h3>Settings</h3>
            <p>Manage your user settings</p>
          </div>

          <section class="settings-account">
            <h3 class="section-title">Account Settings</h3>

            <div class="form-group">
                <div class="form-row">
                  <div class="form-field">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email"placeholder="mili@recruter.com" /> 
                  </div>
                  <div class="form-field">
                    <label for="phone" class="form-label">Phone</label>
                    <input id="phone" type="tel" name="phone" />
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-field">
                    <label for="old_password" class="form-label">Old Password</label>
                    <input id="old_password" type="password" placeholder="Enter old password" name="old_password" />
                  </div>
                  <div class="form-field">
                    <label for="new_password" class="form-label">New Password</label>
                    <input id="new_password" type="password" placeholder="Enter new password" name="new_password" />
                  </div>
                </div>
                <button type="submit" class="change-pass-btn btn">Change Password</button>
              </div>
          </section>

        </div>
      </div>
    </main>