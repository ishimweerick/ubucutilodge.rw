<?php
include "header.php";
include "sidebar.php";
include "include/db_connection.php"; // Adjust path as needed

$status = "OK"; // Initial status
$msg = "";
$errormsg = "";

if (isset($_POST['save'])) {
    $destination = mysqli_real_escape_string($con, $_POST['destination']);
    $uploads_dir = 'uploads/portfolio';

    // Process each uploaded file
    if (isset($_FILES['ufiles'])) {
        $files = $_FILES['ufiles'];

        for ($i = 0; $i < count($files['name']); $i++) {
            $tmp_name = $files["tmp_name"][$i];
            $name = basename($files["name"][$i]);
            $random_digit = rand(0000, 9999);
            $new_file_name = $random_digit . $name;
            $file_destination = "$uploads_dir/$new_file_name";

            if (move_uploaded_file($tmp_name, $file_destination)) {
                $sql = "INSERT INTO portfolio (ufile, destination) VALUES ('$new_file_name', '$destination')";
                if (!mysqli_query($con, $sql)) {
                    $status = "ERROR";
                    $msg = "Database insert failed: " . mysqli_error($con);
                }
            } else {
                $status = "ERROR";
                $msg = "Failed to upload file: $name";
            }
        }

        if ($status == "OK") {
            $errormsg = "
                <div class='alert alert-success alert-dismissible alert-outline fade show'>
                    Portfolio has been added successfully.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        } else {
            $errormsg = "
                <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                    $msg
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
    } else {
        $errormsg = "
            <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                No files uploaded.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }
}
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Add Portfolio</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Portfolio</a></li>
                                <li class="breadcrumb-item active">Add</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xxl-9">
                    <div class="card mt-xxl-n5">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab" aria-selected="false">
                                        <i class="fas fa-home"></i> Add Portfolio
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body p-4">
                            <div class="tab-content">
                                <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                        print $errormsg;
                                    } ?>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="photoInput" class="form-label">Photos</label>
                                                    <input type="file" class="form-control" id="photoInput" name="ufiles[]" multiple onchange="previewImages(event)">
                                                    <div id="imagePreview"></div>
                                                    <script>
                                                        function previewImages(event) {
                                                            const files = event.target.files;
                                                            const output = document.getElementById('imagePreview');
                                                            output.innerHTML = '';
                                                            for (let i = 0; i < files.length; i++) {
                                                                const reader = new FileReader();
                                                                reader.onload = function(e) {
                                                                    const img = document.createElement('img');
                                                                    img.src = e.target.result;
                                                                    img.classList.add('img-thumbnail');
                                                                    img.style.maxWidth = '150px';
                                                                    img.style.margin = '5px';
                                                                    output.appendChild(img);
                                                                }
                                                                reader.readAsDataURL(files[i]);
                                                            }
                                                        }
                                                    </script>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="destinationSelect" class="form-label">Destination</label>
                                                    <select class="form-select" id="destinationSelect" name="destination">
                                                        <option value="Rwanda">Rwanda</option>
                                                        <option value="Tanzania">Tanzania</option>
                                                        <option value="Burundi">Burundi</option>
                                                        <option value="Kenya">Kenya</option>
                                                        <option value="Uganda">Uganda</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" name="save" class="btn btn-primary">Add Portfolio</button>
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
    </div>
</div>

<?php include "footer.php"; ?>
