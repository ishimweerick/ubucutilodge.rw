<?php include "header.php";?>
<?php include "sidebar.php";?>
<style>
                                                        h3.sec_title {
    background: #fbdd9b;
    font-size: 15px;
    color: #000 !important;
    padding: 10px;
    margin-top: 20px;
}</style>
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
                                <h4 class="mb-sm-0">Site Config</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Site</a></li>
                                        <li class="breadcrumb-item active">Config</li>
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
                                                <i class="fas fa-home"></i> Site Configuration
                                            </a>
                                        </li>


                                    </ul>
                                </div>


                                <?php
$status = "OK"; //initial status
$msg = "";

if (isset($_POST['save'])) {
    $destination_title = mysqli_real_escape_string($con, $_POST['destination_title']);
    $destination_subtitle = mysqli_real_escape_string($con, $_POST['destination_subtitle']);
    $package_title = mysqli_real_escape_string($con, $_POST['package_title']);
    $package_subtitle = mysqli_real_escape_string($con, $_POST['package_subtitle']);
    $button_destination = mysqli_real_escape_string($con, $_POST['button_destination']);
    $button_package = mysqli_real_escape_string($con, $_POST['button_package']);

    if (strlen($destination_title) < 1) {
        $msg = $msg . "Destination Title field cannot be empty.<br>";
        $status = "NOTOK";
    }
    if (strlen($destination_subtitle) < 1) {
        $msg = $msg . "Destination Subtitle Field must contain at least one character.<br>";
        $status = "NOTOK";
    }

    $sql = "UPDATE home_section SET destination_title='$destination_title', destination_subtitle='$destination_subtitle', package_title='$package_title', package_subtitle='$package_subtitle', button_destination='$button_destination', button_package='$button_package' WHERE id=1";

    // Execute the SQL query
    $result = mysqli_query($con, $sql);
    
    if ($result) {
        $errormsg = "<div class='alert alert-success alert-dismissible alert-outline fade show'>
                      Home section settings updated successfully.
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
    } else {
        $errormsg = "<div class='alert alert-danger alert-dismissible alert-outline fade show'>
                      Failed to update home section settings. Please try again.
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
    }
}
?>





                                <div class="card-body p-4">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="personalDetails" role="tabpanel">

                                        <?php
					 $query="SELECT * FROM home_section where id=1 ";


 $result = mysqli_query($con,$query);
$i=0;
while($row = mysqli_fetch_array($result))
{
	$destination_title="$row[destination_title]";
	$destination_subtitle="$row[destination_subtitle]";
  $package_title="$row[package_title]";
  $package_subtitle="$row[package_subtitle]";
  $button_destination="$row[button_destination]";
  $button_package="$row[button_package]";
}
  ?>




                                      <?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
						{
						print $errormsg;
						}
   ?>
              <form action="" method="post" enctype="multipart/form-data">
                                                <div class="row">

                                  
                                                    <h3 class="sec_title">Destination Section</h3>
                                                 

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label"> Heading</label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea5" name="destination_title" rows="5"><?php print $destination_title ?></textarea>

                                                        </div>
                                                    </div>

                                                    <!--end col-->

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Content</label>
                                                            <textarea id="content" class="summernote"  name="destination_subtitle" rows="3" placeholder="Enter Content"> <?php print $destination_subtitle ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                     <div class="mb-3">
                                                         <label for="firstnameInput" class="form-label"> Button</label>
                                                         <input type="text" class="form-control" id="firstnameInput" name="button_destination"  value="<?php print $button_destination ?>">
                                                     </div>
                                                 </div>

                                                    <h3 class="sec_title">Package Section</h3>
                                                 

                                                 <div class="col-lg-6">
                                                     <div class="mb-3">
                                                         <label for="firstnameInput" class="form-label"> Heading</label>
                                                         <textarea class="form-control" id="exampleFormControlTextarea5" name="package_title" rows="5"><?php print $package_title ?></textarea>

                                                     </div>
                                                 </div>
                                                 <!--end col-->

                                                 <div class="col-lg-6">
                                                     <div class="mb-3">
                                                         <label for="firstnameInput" class="form-label">Content</label>
                                                         <textarea id="content" class="summernote" name="package_subtitle" rows="3" placeholder="Enter Footer About Text"> <?php print $package_subtitle ?></textarea>
                                                     </div>
                                                 </div>

                                                 <div class="col-lg-12">
                                                     <div class="mb-3">
                                                         <label for="firstnameInput" class="form-label"> Button</label>
                                                         <input type="text" class="form-control" id="firstnameInput" name="button_package"  value="<?php print $button_package ?>">
                                                     </div>
                                                 </div>

                                                  
                                          
                                                    <!--end col-->

                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="submit" name="save" class="btn btn-primary">Update</button>

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
            <?php include "footer.php";?>
