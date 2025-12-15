<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Saved Jobs</title>
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
<h1>Saved Jobs</h1>
<p class="subtitle">Jobs you've bookmarked for later</p>

    <div class="saved-jobs-container">
        <div class="saved-jobs-grid">
            <div class="saved-jobs-card">
                <div class="saved-jobs-header">
                    <div class="saved-job-avatar">S</div>
                    <i class="fa-solid fa-bookmark saved-job-bookmark"></i>
                </div>
                <h3 class="saved-job-title">Senior Product Manager</h3>
                <p class="saved-job-company">Spotify</p>
                <div class="saved-jobs-info">
                    <span><i class="fa-solid fa-location-dot"></i> Remote</span>
                    <span>$120k - $150k</span>
                    <span><i class="fa-regular fa-clock"></i> 2 days ago</span>
                </div>
                <div class="saved-job-actions">
                        <button class="apply-btn">Apply Now</button>
                        <button class="details-btn">View Details</button>
                    </div>
            </div>
        </div>
    </div>
    </main>

</body>
</html>
