<?php
require_once __DIR__ . "/../../../models/DatabaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->openConnection();

if (isset($_POST['add_category'])) {
  $db->addCategory($conn, $_POST['category_name']); 
} 

if(isset($_GET['delete_category'])) {
  $db->deleteCategory($conn,(int)$_GET['delete_category']); 
}

if (isset($_POST['add_location'])) {
$db->addLocation($conn, $_POST['location_name']); 
} 

if(isset($_GET['delete_location'])) { 
  $db->deleteLocation($conn,(int)$_GET['delete_location']); 
} 

$categories = $db->getCategories($conn);
$locations = $db->getLocations($conn); ?> 
?>
<?php include __DIR__ . '/../../layouts/sidebar_admin.php'; ?>

<main>
  <div class="dashboard-main">
    <div class="dashboard-container">
      <div class="dashboard-header">
        <h3>Manage Category & Location</h3>
      </div>

      <div class="category-location">
        <section class="dashboard-tracker-div">
          <div class="tracker-header">
            <h4>Categories</h4>
          </div>

          <form method="post">
            <div class="form-field">
              <input
              class =""
              type="text"
              name="category_name"
              placeholder="Category name"
            />
            <button class="action-btn category-btn" type="submit" name="add_category">Add Category</button>
            </div>
            
          </form>

          <table class="tracker-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($categories)): ?> <?php foreach ($categories as
              $cat): ?>
              <tr>
                <td><?= $cat['id'] ?></td>
                <td><?= $cat['name'] ?></td>
                <td>
                  <a
                    href="?delete_category=<?= $cat['id'] ?>"
                    onclick="return confirm('Delete category?');"
                  >
                    Delete
                  </a>
                </td>
              </tr>
              <?php endforeach; ?> <?php else: ?>
              <tr>
                <td colspan="3">No categories found</td>
              </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </section>

        <section class="dashboard-tracker-div">
          <div class="tracker-header">
            <h4>Locations</h4>
          </div>

          <form method="post">
            <div class="form-field">
              <input
              class =""
              type="text"
              name="location_name"
              placeholder="Location name"
            />
            <button class="action-btn location-btn" type="submit" name="add_location">Add Location</button>
            </div>
          </form>

          <table class="tracker-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Location Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($locations)): ?> <?php foreach ($locations as
              $loc): ?>
              <tr>
                <td><?= $loc['id'] ?></td>
                <td><?= $loc['name'] ?></td>
                <td>
                  <a
                    href="?delete_location=<?= $loc['id'] ?>"
                    onclick="return confirm('Delete location?');"
                  >
                    Delete
                  </a>
                </td>
              </tr>
              <?php endforeach; ?> <?php else: ?>
              <tr>
                <td colspan="3">No locations found</td>
              </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </section>
      </div>
    </div>
  </div>
</main>
