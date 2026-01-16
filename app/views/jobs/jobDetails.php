<?php
require_once __DIR__ . '/../../app/models/DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->openConnection();

$job_id = (int)($_GET['id'] ?? 0);
if ($job_id <= 0) {
    die("Invalid job");
}

$sql = "SELECT j.*,
  c.name AS category_name,
  l.name AS location_name,
  u.company_name
  FROM jobs j
  JOIN categories c ON j.category_id = c.id
  JOIN locations l ON j.location_id = l.id
  JOIN users u ON j.user_id = u.id
  WHERE j.id = $job_id AND j.status = 'published'
";

$result = $conn->query($sql);
if (!$result || $result->num_rows === 0) {
    die("Job not found");
}

$job = $result->fetch_assoc();
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
                Posted on <?= date('d M Y',strtotime($job['company_name'])) ?>
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
            <?= nl2br(htmlspecialchars($job['requirement'])) ?>
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
            <?= nl2br(htmlspecialchars($job['requirement'])) ?>
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

      <div class="job-action">
        <div class="job-action-btn">
          <a href="#" class="apply-btn action-btn">Apply Now</a>
          <a href="#" class="save-btn action-btn">Save Job</a>
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
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores
            reprehenderit sapiente commodi quam distinctio aperiam ipsa maxime,
            quod consectetur ipsum? Numquam aspernatur eius recusandae, sint
            commodi quod labore fugiat iusto.
          </p>
          <a href="#" class="company-website">visit Company</a>
        </div>
      </div>
    </div>
  </div>
</main>
