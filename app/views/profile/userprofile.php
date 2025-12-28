<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Profile</title>
    <link rel="stylesheet" href="../../../public/assets/css/dashboard.css" />
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
            <h1 class="title">My Profile</h1>
            <p class="subtitle">Manage you personal information and resume</p>
          </div>

          <div class="profile-container">
            <form action="" class="profile-form" method="POST">
              <section class="form-section profile-photo">
                <h3 class="section-title">Profile Photo</h3>
                
                <div class="profile-img-wrapper">
                  <div class="profile-img">DP</div>
                  <input type="file">
                  <button type="button" class="profile-img-btn">
                    <i class="fa-solid fa-camera"></i>
                  </button>
                </div>

                <p>JPG, PNG</p>
              </section>

              <section class="form-section">
                <h3 class="section-title">Personal Details</h3>

                <div class="form-group">
                  <div class="form-row">
                    <div class="form-field">
                      <label for="firstname" class="form-label"
                        >First Name</label
                      >
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
              <section class="form-section">
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
              <section class="form-section">
                <h3 class="section-title">Resume</h3>

                <div class="form-group">
                  <div class="form-row">
                    <div class="form-field">
                      <input type="file" name="filenames" id="file-upload" class="file-input"/>
                      
                    </div>
                  </div>
                </div>
              </section>

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
  </body>
</html>
