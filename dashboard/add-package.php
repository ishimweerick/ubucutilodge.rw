<?php include "header.php";?> <?php include "sidebar.php";?>
<link rel="stylesheet" href="./summernote/summernote-lite.css">
<script src="./js/jquery-3.6.0.min.js"></script>
<script src="./summernote/summernote-lite.js"></script>


<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
  <div class="page-content">
    <div class="container-fluid">
      <!-- start page title -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Add Packages</h4>
            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                  <a href="javascript: void(0);">Packages</a>
                </li>
                <li class="breadcrumb-item active">Add</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <!-- end page title -->
      <div class="row">
        <!--end col-->
        <div class="col-xxl-9">
          <div class="card mt-xxl-n5">
            <div class="card-header">
              <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab" aria-selected="false">
                    <i class="fas fa-home"></i> Add Packages </a>
                </li>
              </ul>
            </div> <?php
           $status = "OK"; //initial status
$msg="";
           if(ISSET($_POST['save'])){
$package_title = mysqli_real_escape_string($con,$_POST['package_title']);
$package_description = mysqli_real_escape_string($con,$_POST['package_description']);
$package_price = mysqli_real_escape_string($con,$_POST['package_price']);
$package_day = mysqli_real_escape_string($con,$_POST['package_day']);
$package_guest = mysqli_real_escape_string($con,$_POST['package_guest']);
$package_category = mysqli_real_escape_string($con,$_POST['package_category']);

 if ( strlen($package_title) < 5 ){
$msg=$msg."Package Title Must Be More Than 5 Char Length.
							<BR>";
$status= "NOTOK";}


if ( strlen($package_price) < 2 ){
  $msg=$msg."Enter Price
								<BR>";
  $status= "NOTOK";}



$uploads_dir = 'uploads/packages';

        $tmp_name = $_FILES["ufile"]["tmp_name"];
        // basename() may prevent filesystem traversal attacks;
        // further validation/sanitation of the filename may be appropriate
        $name = basename($_FILES["ufile"]["name"]);
        $random_digit=rand(0000,9999);
        $new_file_name=$random_digit.$name;

        move_uploaded_file($tmp_name, "$uploads_dir/$new_file_name");

if($status=="OK")
{
$qb=mysqli_query($con,"INSERT INTO packages (package_title, package_category, package_description, package_price, package_day, package_guest, ufile) VALUES ('$package_title', '$package_category', '$package_description', '$package_price', '$package_day', '$package_guest', '$new_file_name')");


		if($qb){
		    	$errormsg= "

									<div class='alert alert-success alert-dismissible alert-outline fade show'>
                  Service has been added successfully.
                  
										<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
									</div>
 "; //printing error if found in validation

		}
	}

        elseif ($status!=="OK") {
            $errormsg= "

									<div class='alert alert-danger alert-dismissible alert-outline fade show'>
                     ".$msg." 
										<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
									</div>"; //printing error if found in validation


    }
    else{
			$errormsg= "
      
									<div class='alert alert-danger alert-dismissible alert-outline fade show'>
                 Some Technical Glitch Is There. Please Try Again Later Or Ask Admin For Help.
                 
										<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
									</div>"; //printing error if found in validation


		}
           }
           ?> <div class="card-body p-4">
              <div class="tab-content">
                <div class="tab-pane active" id="personalDetails" role="tabpanel"> <?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
						{
						print $errormsg;
						}
   ?> <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="mb-3">
                          <label for="firstnameInput" class="form-label"> Packages Title</label>
                          <input type="text" class="form-control" id="firstnameInput" name="package_title" placeholder="Enter Package Title">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-3">
                          <label for="firstnameInput" class="form-label"> Packages Price</label>
                          <input type="text" class="form-control" id="firstnameInput" name="package_price" placeholder="Enter Price Amount">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-3">
                          <label for="firstnameInput" class="form-label"> Packages Day</label>
                          <input type="text" class="form-control" id="firstnameInput" name="package_day" placeholder="Enter Day's">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-3">
                          <label for="firstnameInput" class="form-label"> Packages Guest</label>
                          <input type="text" class="form-control" id="firstnameInput" name="package_guest" placeholder="Enter Guest Number">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-3">
                          <label for="firstnameInput" class="form-label">Cover</label>
                          <input type="file" class="form-control" id="firstnameInput" name="ufile">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-3">
                          <label for="firstnameInput" class="form-label"> Packages Type</label>
                          <select class="form-control" id="packageType" name="package_category"> <?php
                // Assume $con is your database connection
                $query = mysqli_query($con, "SELECT `id`, `cat_name` FROM `packages_category`");
                while ($row = mysqli_fetch_array($query)) {
                    echo "
																						<option value='" . $row['id'] . "'>" . $row['cat_name'] . "</option>";
                }
            ?> </select>
                        </div>
                      </div>
                   
                      <div class="col-lg-12">
                        <div class="mb-3">
                          <label for="firstnameInput" class="form-label"> Packages Description</label>
                          <textarea name="package_description" id="content" class="summernote" required></textarea>
                        </div>
                      </div>
                      <!--end col-->
                      <div class="col-lg-12">
                        <div class="hstack gap-2 justify-content-end">
                          <button type="submit" name="save" class="btn btn-primary">Add Package</button>
                        </div>
                      </div>
                      <!--end col-->
                    </div>
                    <!--end row-->
                  </form>

                  
                </div>
                <!--end tab-pane-->
                <!--end tab-pane-->
                <!--end tab-pane-->
              </div>
            </div>
          </div>
        </div>
        <!--end col-->
      </div>
    </div>
    <!-- container-fluid -->
  </div>
  <!-- End Page-content -->
  <script>
    $('.summernote').summernote({
      placeholder: 'Create you content here.',
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
  </script> <?php include "footer.php";?>