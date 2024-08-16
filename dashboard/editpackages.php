<?php
include "header.php";
include "sidebar.php";
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
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
              <label for="packageCategory" class="form-label">Category</label>
              <select class="form-select" id="packageCategory" name="package_category">
                <option value="Single" <?php if ($package['package_category'] == 'Single') echo 'selected'; ?>>Single</option>
                <option value="Family" <?php if ($package['package_category'] == 'Family') echo 'selected'; ?>>Family</option>
                <option value="Group" <?php if ($package['package_category'] == 'Group') echo 'selected'; ?>>Group</option>
              </select>
            </div>
          </div>

          <div class="col-lg-12">
            <div class="mb-3">
              <label for="packageDescription" class="form-label">Package Description</label>
              <textarea class="form-control" id="packageDescription" name="package_description" rows="5" placeholder="Enter Package Description"><?php echo htmlspecialchars($package['package_description']); ?></textarea>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="mb-3">
              <label for="priceWeekend" class="form-label">Price (Weekend)</label>
              <input type="text" class="form-control" id="priceWeekend" name="price_weekend" value="<?php echo htmlspecialchars($package['price_weekend']); ?>" placeholder="Enter Price for Weekend">
            </div>
          </div>

          <div class="col-lg-6">
            <div class="mb-3">
              <label for="priceWeekday" class="form-label">Price (Weekday)</label>
              <input type="text" class="form-control" id="priceWeekday" name="price_weekday" value="<?php echo htmlspecialchars($package['price_weekday']); ?>" placeholder="Enter Price for Weekday">
            </div>
          </div>
        </div>
        <button type="submit" name="save" class="btn btn-primary">Save Changes</button>
      </form>

      <!-- Reorder Images Section -->
      <div class="col-lg-12">
        <div class="gallery">
          <ul class="reorder_ul reorder-photos-list">
            <?php
            $query = mysqli_query($con, "SELECT * FROM photo WHERE package_id='$todo' ORDER BY img_order ASC");
            while ($row = mysqli_fetch_array($query)) {
                echo '<li id="image_li_' . $row['photoid'] . '" class="ui-sortable-handle">';
                echo '<a href="javascript:void(0);" class="image_link">';
                echo '<img src="' . $row['location'] . '" alt="image" height="150px" width="150px">';
                echo '<a href="editpackages.php?delete_image_id=' . $row['photoid'] . '&package_id=' . $todo . '" style="position:absolute;top:0;right:0;background:red;color:white;padding:5px;">Delete</a>';
                echo '</a></li>';
            }
            ?>
          </ul>
          <div id="reorderHelper" class="light_box" style="display:none;">
            1. Drag photos to reorder.<br>2. Click 'Save Reordering' when finished.
          </div>
          <a href="javascript:void(0);" class="reorder_link" id="saveReorder">Reorder Photos</a>
        </div>
      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('.reorder_link').on('click',function(){
        $("ul.reorder-photos-list").sortable({ tolerance: 'pointer' });
        $('.reorder_link').html('Save Reordering');
        $('.reorder_link').attr("id","saveReorder");
        $('#reorderHelper').slideDown('slow');
        $('.image_link').css("cursor","move");

        $("#saveReorder").click(function( e ){
            if(!$("#saveReorder i").length){
                $(this).html('').prepend('<img src="images/refresh-animated.gif"/>');
                $("ul.reorder-photos-list").sortable('destroy');
                $("#reorderHelper").html("Reordering Photos - This could take a moment. Please don't navigate away from this page.").removeClass('light_box').addClass('notice notice_error');

                var h = [];
                $("ul.reorder-photos-list li").each(function() {
                    h.push($(this).attr('id').substr(9));
                });

                $.ajax({
                    type: "POST",
                    url: "orderUpdate.php",
                    data: {ids: h.join(",")},
                    success: function(){
                        window.location.reload();
                    }
                });
                return false;
            }
            e.preventDefault();
        });
    });
});
</script>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

<?php include "footer.php"; ?>
