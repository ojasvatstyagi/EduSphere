<?php
session_start();
include '../server/db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login_page.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM profile WHERE user_id = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

// If no profile data found (shouldn't happen with new signup logic, but safe fallback)
if (!$row) {
   $row = [];
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Personal Profile | EduSphere</title>
    <link href="../css/style_profile.css" rel="stylesheet" />
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <div style="max-width: 900px; margin: 0 auto">
      <a href="index.php" class="back-link"
        ><i class="material-icons" style="vertical-align: middle">arrow_back</i>
        Back to Dashboard</a
      >
    </div>

    <div class="container">
      <h2>Student Profile</h2>

      <div class="info-alert">
        <i
          class="material-icons"
          style="vertical-align: middle; margin-right: 5px"
          >info</i
        >
        If you don't have a certificate, please download and upload the
        provisional format without changing the file name.
      </div>

      <form
        action="../server/profile.php"
        method="POST"
        enctype="multipart/form-data"
      >
        <!-- General Information -->
        <div class="section-title">General Information</div>
        <div class="form-grid">
          <div class="form-group">
            <label>First Name <span>*</span></label>
            <input
              type="text"
              name="first_name"
              placeholder="Enter first name"
              value="<?php echo htmlspecialchars($row['first_name'] ?? ''); ?>"
              required
            />
          </div>
          <div class="form-group">
            <label>Last Name <span>*</span></label>
            <input
              type="text"
              name="last_name"
              placeholder="Enter last name"
              value="<?php echo htmlspecialchars($row['last_name'] ?? ''); ?>"
              required
            />
          </div>
          <div class="form-group">
            <label>Full Name (as per Aadhaar) <span>*</span></label>
            <input
              type="text"
              name="full_name_as_per_aadhaar"
              placeholder="As per govt ID"
              value="<?php echo htmlspecialchars($row['aadhaar_name'] ?? ''); ?>"
              required
            />
          </div>
          <div class="form-group">
            <label>Father's Name <span>*</span></label>
            <input type="text" name="father_name" value="<?php echo htmlspecialchars($row['father_name'] ?? ''); ?>" required />
          </div>
          <div class="form-group">
            <label>Mother's Name <span>*</span></label>
            <input type="text" name="mother_name" value="<?php echo htmlspecialchars($row['mother_name'] ?? ''); ?>" required />
          </div>
          <div class="form-group">
            <label>Date of Birth <span>*</span></label>
            <input type="date" name="date_of_birth" value="<?php echo htmlspecialchars($row['dob'] ?? ''); ?>" required />
          </div>
        </div>

        <!-- Personal Information -->
        <div class="section-title">Personal Details</div>
        <div class="form-grid">
          <div class="form-group">
            <label>Gender <span>*</span></label>
            <div class="radio-group">
              <label>
                  <input type="radio" name="gender" value="Male" <?php if(($row['gender'] ?? '') == 'Male') echo 'checked'; ?> required />
                  Male
              </label>
              <label>
                  <input type="radio" name="gender" value="Female" <?php if(($row['gender'] ?? '') == 'Female') echo 'checked'; ?> />
                  Female
              </label>
              <label>
                  <input type="radio" name="gender" value="Other" <?php if(($row['gender'] ?? '') == 'Other') echo 'checked'; ?> />
                   Other
              </label>
            </div>
          </div>
          <div class="form-group">
            <label>Branch <span>*</span></label>
            <input
              type="text"
              name="branch"
              placeholder="Enter branch"
              value="<?php echo htmlspecialchars($row['branch'] ?? ''); ?>"
              required
            />
          </div>
          <div class="form-group">
            <label>Section <span>*</span></label>
            <input
              type="text"
              name="section"
              placeholder="Enter section"
              value="<?php echo htmlspecialchars($row['section'] ?? ''); ?>"
              required
            />
          </div>
          <div class="form-group">
            <label>Languages Known <span>*</span></label>
            <input
              type="text"
              name="languages"
              placeholder="e.g. English, Hindi, Spanish"
              value="<?php echo htmlspecialchars($row['languages_known'] ?? ''); ?>"
              required
            />
          </div>
        </div>

        <!-- Upload -->
        <div class="form-group full-width">
          <label>Photograph <span>*</span> <small>(Max 300kb)</small></label>
          <?php if (!empty($row['photo_path'])): ?>
              <div style="margin-bottom: 10px;">
                  <img src="<?php echo htmlspecialchars($row['photo_path']); ?>" alt="Profile Photo" style="width: 150px; height: 150px; object-fit: cover; border-radius: 5px; border: 1px solid #ddd;">
              </div>
          <?php endif; ?>
          <input type="file" name="photo" accept="image/jpeg, image/png" />
        </div>

        <!-- Buttons -->
        <div class="btn-container">
          <button type="submit" class="btn-save">Update Information</button>
          <button type="reset" class="btn-clear">Clear Form</button>
        </div>
      </form>
    </div>
  </body>
</html>
