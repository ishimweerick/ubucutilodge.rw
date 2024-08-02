<?php
include "header.php";
$todo = mysqli_real_escape_string($con, $_GET['id']);
include "sidebar.php";
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
                                <h4 class="mb-sm-0">Edit Service</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                                        <li class="breadcrumb-item active">Service</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <?php
                    $query = "SELECT * FROM destination WHERE id='$todo'";
                    $result = mysqli_query($con, $query);
                    $row = mysqli_fetch_array($result);
                    $destination_title = $row['destination_title'];
                    $description = $row['description'];
                    $destination_image = $row['destination_image'];
                    ?>

                    <div class="row">
                        <div class="col-xxl-9">
                            <div class="card mt-xxl-n5">
                                <div class="card-header">
                                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab" aria-selected="false">
                                                <i class="fas fa-home"></i> Edit Service
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <?php
                                $status = "OK"; //initial status
                                $msg = "";
                                if (isset($_POST['save'])) {
                                    $destination_title = mysqli_real_escape_string($con, $_POST['destination_title']);
                                    $description = mysqli_real_escape_string($con, $_POST['description']);

                                    if (strlen($destination_title) < 2) {
                                        $msg .= "Title Must Have At Least 2 Characters.<br>";
                                        $status = "NOTOK";
                                    }

                                    $uploads_dir = 'uploads/destinations';
                                    $file_name = $_FILES["destination_image"]["name"];

                                    if ($file_name != "") {
                                        // A new file has been uploaded, move it to the uploads directory
                                        $tmp_name = $_FILES["destination_image"]["tmp_name"];
                                        $name = basename($_FILES["destination_image"]["name"]);
                                        $random_digit = rand(0000, 9999);
                                        $new_file_name = $random_digit . $name;

                                        move_uploaded_file($tmp_name, "$uploads_dir/$new_file_name");

                                        $sql = "UPDATE destination SET destination_title='$destination_title', description='$description', destination_image='$new_file_name' WHERE id='$todo'";
                                    } else {
                                        // No new file has been uploaded, only update the title and text fields
                                        $sql = "UPDATE destination SET destination_title='$destination_title', description='$description' WHERE id='$todo'";
                                    }

                                    if ($status == "OK") {
                                        $qb = mysqli_query($con, $sql);

                                        if ($qb) {
                                            $errormsg = "
                                            <div class='alert alert-success alert-dismissible alert-outline fade show'>
                                                Service has been updated successfully.
                                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>";
                                        } else {
                                            $errormsg = "
                                            <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                                                Some Technical Glitch Is There. Please Try Again Later Or Ask Admin For Help.
                                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>";
                                        }
                                    } else {
                                        $errormsg = "
                                        <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                                            " . $msg . "
                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                        </div>";
                                    }
                                }
                                ?>

                                <div class="card-body p-4">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                        <?php
                                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                            echo $errormsg;
                                        }
                                        ?>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="firstnameInput" class="form-label">Destination Title</label>
                                                        <input type="text" class="form-control" id="firstnameInput" name="destination_title" value="<?php echo $destination_title ?>" placeholder="Enter Service Title">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="firstnameInput" class="form-label">Destination Description</label>
                                                        <textarea id="content" class="summernote" name="description" rows="3"><?php echo $description ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="firstnameInput" class="form-label">Cover</label>
                                                        <input type="file" class="form-control" name="destination_image">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="firstnameInput" class="form-label">Current Icon</label><br>
                                                        <img src="uploads/destinations/<?php echo $destination_image; ?>" alt="<?php echo $destination_title ?>" width="60px">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <button type="submit" name="save" class="btn btn-primary">Update Service</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            <script>
              $('.summernote').summernote({
                placeholder: 'Create your content here.',
                tabsize: 5,
                height: '20vh',
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
        </div>
    </div>
</div>
