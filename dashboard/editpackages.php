<?php
include "header.php";
include "sidebar.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$todo = mysqli_real_escape_string($con, $_GET['id']);

// Fetch package details
$query = "SELECT * FROM packages WHERE id='$todo'";
$result = mysqli_query($con, $query);
$package = mysqli_fetch_array($result);

// Handle form submission
if (isset($_POST['save'])) {
    $package_category = mysqli_real_escape_string($con, $_POST['package_category']);
    $package_title = mysqli_real_escape_string($con, $_POST['package_title']);
    $package_description = mysqli_real_escape_string($con, $_POST['package_description']);
    $price_weekend = mysqli_real_escape_string($con, $_POST['price_weekend']);
    $price_weekday = mysqli_real_escape_string($con, $_POST['price_weekday']);
    $selected_amenities = $_POST['amenities'] ?? [];

    // Handle file upload for package cover image
    $uploads_dir = 'uploads/packages';
    $file_name = $_FILES["ufile"]["name"];

    if ($file_name != "") {
        $tmp_name = $_FILES["ufile"]["tmp_name"];
        $name = basename($file_name);
        $random_digit = rand(0000, 9999);
        $new_file_name = $random_digit . $name;
        move_uploaded_file($tmp_name, "$uploads_dir/$new_file_name");

        $sql = "UPDATE packages SET package_category='$package_category', package_title='$package_title', package_description='$package_description', price_weekend='$price_weekend', price_weekday='$price_weekday', ufile='$new_file_name' WHERE id=$todo";
    } else {
        $sql = "UPDATE packages SET package_category='$package_category', package_title='$package_title', package_description='$package_description', price_weekend='$price_weekend', price_weekday='$price_weekday' WHERE id=$todo";
    }

    if (mysqli_query($con, $sql)) {
        // Clear existing amenities
        mysqli_query($con, "DELETE FROM package_amenities WHERE package_id='$todo'");

        // Insert selected amenities
        foreach ($selected_amenities as $amenity_id) {
            $amenity_id = mysqli_real_escape_string($con, $amenity_id);
            $insert_query = "INSERT INTO package_amenities (package_id, amenity_id) VALUES ('$todo', '$amenity_id')";
            mysqli_query($con, $insert_query);
        }

        // Uploading photos
        foreach ($_FILES['gallery']['name'] as $key => $name) {
            if ($_FILES['gallery']['error'][$key] === UPLOAD_ERR_OK) {
                $newFilename = time() . "_" . basename($name);
                $target_path = $uploads_dir . '/' . $newFilename;
                if (move_uploaded_file($_FILES['gallery']['tmp_name'][$key], $target_path)) {
                    $location = $target_path;
                    mysqli_query($con, "INSERT INTO photo (location, package_id) VALUES ('$location', '$todo')");
                } else {
                    $errormsg = "<div class='alert alert-danger alert-dismissible alert-outline fade show'>Error uploading file: $name<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                }
            } else {
                $errormsg = "<div class='alert alert-danger alert-dismissible alert-outline fade show'>File upload error: " . $_FILES['gallery']['error'][$key] . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            }
        }

        $errormsg = "<div class='alert alert-success alert-dismissible alert-outline fade show'>Package has been updated successfully.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    } else {
        $errormsg = "<div class='alert alert-danger alert-dismissible alert-outline fade show'>Some Technical Glitch Is There. Please Try Again Later Or Ask Admin For Help.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    }
}

// Handle image deletion
if (isset($_GET['delete_image_id'])) {
    $delete_image_id = mysqli_real_escape_string($con, $_GET['delete_image_id']);

    // Fetch the image path
    $query = "SELECT location FROM photo WHERE photoid='$delete_image_id'";
    $result = mysqli_query($con, $query);
    if ($row = mysqli_fetch_array($result)) {
        $image_path = $row['location'];

        // Delete the image file from the server
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        // Delete the image record from the database
        mysqli_query($con, "DELETE FROM photo WHERE photoid='$delete_image_id'");
    }

    // Redirect with status
    header("Location: editpackages.php?id=" . mysqli_real_escape_string($con, $todo) . "&status=success");
    exit();
}
?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
  <div class="page-content">
    <div class="container-fluid">
      <!-- start page title -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Edit Package</h4>
            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                <li class="breadcrumb-item active">Package</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <!-- end page title -->

      <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { echo $errormsg; } ?>

      <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-lg-6">
            <div class="mb-3">
              <label for="packageTitle" class="form-label">Package Title</label>
              <input type="text" class="form-control" id="packageTitle" name="package_title" value="<?php echo htmlspecialchars($package['package_title']); ?>" placeholder="Enter Package Title">
            </div>
            <div class="mb-3">
              <label for="ufile" class="form-label">Cover Image</label>
              <input type="file" class="form-control" id="ufile" name="ufile">
              <?php if ($package['ufile']) { ?>
                <br>
                <img src="uploads/packages/<?php echo htmlspecialchars($package['ufile']); ?>" alt="package" width="540px">
              <?php } ?>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="mb-3">
              <label for="gallery" class="form-label">Add More Images to Gallery</label>
              <input type="file" class="form-control" id="gallery" name="gallery[]" multiple>
            </div>
          </div>

          <div class="col-lg-12">
            <div class="mb-3">
              <?php
              $query = mysqli_query($con, "SELECT * FROM photo WHERE package_id='$todo'");
              while ($row = mysqli_fetch_array($query)) {
                echo '<div style="display:inline-block;position:relative;margin:5px;">';
                echo '<img src="'.$row['location'].'" height="150px" width="150px">';
                echo '<a href="editpackages.php?delete_image_id='.$row['photoid'].'&package_id='.$todo.'" style="position:absolute;top:0;right:0;background:red;color:white;padding:5px;">Delete</a>';
                echo '</div>';
              }
              ?>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="mb-3">
              <label for="amenities" class="form-label">Select Amenities</label>
              <?php
              // Fetch amenities
              $query = mysqli_query($con, "SELECT * FROM amenities");
              $selected_amenities = mysqli_query($con, "SELECT amenity_id FROM package_amenities WHERE package_id='$todo'");

              $selected_ids = [];
              while ($row = mysqli_fetch_assoc($selected_amenities)) {
                  $selected_ids[] = $row['amenity_id'];
              }

              while ($row = mysqli_fetch_assoc($query)) {
                  $checked = in_array($row['id'], $selected_ids) ? 'checked' : '';
                  echo "<div class='form-check'>";
                  echo "<input type='checkbox' class='form-check-input' id='amenity_" . $row['id'] . "' name='amenities[]' value='" . $row['id'] . "' $checked>";
                  echo "<label class='form-check-label' for='amenity_" . $row['id'] . "'>" . $row['title'] . "</label>";
                  echo "</div>";
              }
              ?>
            </div>
          </div>

          <div class="col-lg-12">
            <div class="mb-3">
              <label for="packageDescription" class="form-label">Package Description</label>
              <textarea name="package_description" id="packageDescription" class="summernote form-control" style="color:#fff" required><?php echo htmlspecialchars($package['package_description']); ?></textarea>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="mb-3">
              <label for="packageCategory" class="form-label">Package Category</label>
              <select class="form-control" id="packageCategory" name="package_category">
                <?php
                // Fetch categories
                $query = mysqli_query($con, "SELECT id, cat_name FROM packages_category");
                while ($row = mysqli_fetch_assoc($query)) {
                    $selected = $row['id'] == $package['package_category'] ? 'selected' : '';
                    echo "<option value='" . $row['id'] . "' $selected>" . $row['cat_name'] . "</option>";
                }
                ?>
              </select>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="mb-3">
              <label for="priceWeekend" class="form-label">Weekend Price</label>
              <input type="text" class="form-control" id="priceWeekend" name="price_weekend" value="<?php echo htmlspecialchars($package['price_weekend']); ?>" placeholder="Enter Weekend Price">
            </div>
          </div>

          <div class="col-lg-6">
            <div class="mb-3">
              <label for="priceWeekday" class="form-label">Weekday Price</label>
              <input type="text" class="form-control" id="priceWeekday" name="price_weekday" value="<?php echo htmlspecialchars($package['price_weekday']); ?>" placeholder="Enter Weekday Price">
            </div>
          </div>

          <div class="col-lg-12">
            <div class="hstack gap-2 justify-content-end">
              <button type="submit" name="save" class="btn btn-primary">Save Changes</button>
            </div>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>

<script>
  $('.summernote').summernote({
    placeholder: 'Create your content here.',
    tabsize: 5,
    height: '50vh',
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link', 'picture', 'video']],
      ['view', ['fullscreen', 'codeview', 'help']]
    ]
  });
</script>

<?php include "footer.php"; ?>
