<?php
session_start();
require_once __DIR__ . "/../../../models/DatabaseConnection.php";
$password_error = $_SESSION['error'] ?? '';
$password_success = $_SESSION['success'] ?? '';
unset($_SESSION['success']);
unset($_SESSION['error']);
?>

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
                    <input id="email" type="email" name="email" />
                  </div>
                  <div class="form-field">
                    <label for="phone" class="form-label">Phone</label>
                    <input id="phone" type="tel" name="phone" />
                  </div>
                </div>
                <form action="app/controllers/ChangePasswordHandler.php" method="POST">
                <div class="form-row">
                  <div class="form-field">
                    <label for="old_password" class="form-label">Old Password</label>
                    <input id="old_password" type="password" placeholder="Enter old password" name="old_password" />
                    <?php if($password_error): ?>
                      <p style="color: red; font-size:12px "><?= htmlspecialchars($password_error); ?></p>
                    <?php endif; ?>
                  </div>
                  <div class="form-field">
                    <label for="new_password" class="form-label">New Password</label>
                    <input id="new_password" type="password" placeholder="Enter new password" name="new_password" />
                    <?php if($password_error): ?>
                      <p style="color: red; font-size:12px "><?= htmlspecialchars($password_error); ?></p>
                    <?php endif; ?>
                  </div>
                </div>
                <button type="submit" class="change-pass-btn btn">Change Password</button>
                <?php if($password_success): ?>
                  <p style="color: green; font-size:16px; margin: 5px auto; text-align:center"><?= htmlspecialchars($password_success); ?></p>
                <?php endif; ?>
                </form>
              </div>
          </section>

        </div>
      </div>
    </main>