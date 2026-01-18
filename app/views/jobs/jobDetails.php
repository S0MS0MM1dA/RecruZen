<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../models/DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->openConnection();

$job_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
//$job_id = 2; // For testing purposes only. Replace with actual job ID from GET parameter.
$job = $db->getJob($conn, $job_id);

if (!$job) {
    echo "JOB ID: ";
    var_dump($job_id);
    die("Job not found");
}

?>
<main>
  <div class="container">
    <div class="job-details-wrapper">
      <div class="job-details">
        <div class="job-section job-header">
          <div class="company-logo">
            <img
              src="public/assets/images/google_logo.svg"
              alt="Company logo"
            />
          </div>

          <div class="job-title-box">
            <h1><?= htmlspecialchars($job['title']) ?></h1>
            <p><?= htmlspecialchars($job['company_name']) ?></p>

            <div class="job-meta">
              <span>
                <i class="fa-solid fa-location-dot"></i>
                <?= htmlspecialchars($job['location_name']) ?>
              </span>
              <span>
                <i class="fa-solid fa-dollar-sign"></i> 
                <?= htmlspecialchars($job['min_salary']) ?> - 
                <?= htmlspecialchars($job['max_salary']) ?>
              </span>
              <span>
                <i class="fa-regular fa-clock"></i> 
                Posted on <?= date('d M Y',strtotime($job['created_at'])) ?>
              </span>
            </div>
          </div>
          <div class="job-type">
            <span><?= ucfirst($job['job_type']) ?></span>
          </div>
        </div>

        <div class="job-section">
          <h3 class="job-subtitle">Job Description</h3>
          <p>
            <?= nl2br(htmlspecialchars($job['description'])) ?>
          </p>
        </div>
        <div class="job-section">
          <h3 class="job-subtitle">Key Responsibilities</h3>
          <p>
            <?= nl2br(htmlspecialchars($job['requirements'])) ?>
          </p>
        <!--
          <ul>
            <li>Develop and maintain high-quality React applications</li>
            <li>Collaborate with design and backend teams</li>
            <li>Write clean, maintainable, and well-documented code</li>
            <li>Participate in code reviews and technical discussions</li>
            <li>Optimize applications for maximum performance</li>
          </ul>
        -->
        </div>
        <div class="job-section">
          <h3 class="job-subtitle">Requirements</h3>
          <p>
            <?= nl2br(htmlspecialchars($job['requirements'])) ?>
          </p>
        <!--
          <ul>
            <li>5+ years of experience with React and modern JavaScript</li>
            <li>Strong proficiency in TypeScript</li>
            <li>Experience with state management (Redux, Zustand, etc.)</li>
            <li>Familiarity with modern build tools and CI/CD</li>
            <li>Excellent problem-solving and communication skills</li>
          </ul>
        -->
        </div>
        <div class="job-section">
          <h3 class="job-subtitle">Benefits</h3>
          <p>
            <?= nl2br(htmlspecialchars($job['benefits'])) ?>
          </p>
        <!--
          <ul>
            <li>Competitive salary and equity package</li>
            <li>Health, dental, and vision insurance</li>
            <li>Flexible work arrangements</li>
            <li>Professional development opportunities</li>
            <li>Modern office with great perks</li>
          </ul>
        -->
        </div>
      </div>
      <!---  -->
      <div class="job-action">
        <div class="job-action-btn">
          <form method="post" action="app/controllers/JobApplicationHandler.php">
            <input type="hidden" name="job_id" value="<?= htmlspecialchars($job['id']) ?>" />
            <button type="submit" class="apply-btn action-btn">Apply Now</button>
            <button type="submit" class="save-btn action-btn">Save Job</button>
          </form>
        </div>

        <div class="company-info">
          <h4>About Company</h4>
          <div class="company-meta">
            <p><?= htmlspecialchars($job['company_name']) ?></p>
            <p>Employee</p>
            <p><?= htmlspecialchars($job['location_name']) ?></p>
          </div>
          <hr />
          <p class="company-description">
            <?= nl2br(htmlspecialchars($job['description'])) ?>
          </p>
          <a href="<?= htmlspecialchars($job['company_website'] ?? '') ?>" class="company-website">visit Company</a>
        </div>
      </div>
    </div>
  </div>
</main>
