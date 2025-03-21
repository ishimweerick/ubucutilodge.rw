<?php include"header.php";?>
<?php include"sidebar.php";?>

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
    $site_keyword = mysqli_real_escape_string($con, $_POST['site_keyword']);
    $site_desc = mysqli_real_escape_string($con, $_POST['site_desc']);
    $site_title = mysqli_real_escape_string($con, $_POST['site_title']);
    $site_about = mysqli_real_escape_string($con, $_POST['site_about']);
    $site_footer = mysqli_real_escape_string($con, $_POST['site_footer']);
    $follow_text = mysqli_real_escape_string($con, $_POST['follow_text']);
    $site_url = mysqli_real_escape_string($con, $_POST['site_url']);

    if (strlen($site_keyword) < 1) {
        $msg = $msg . "Site Keyword field cannot be empty.<br>";
        $status = "NOTOK";
    }
    if (strlen($site_desc) < 1) {
        $msg = $msg . "Site Description Field must contain at least one character.<br>";
        $status = "NOTOK";
    }

    $uploads_dir = 'uploads/banner';
    $file_name = $_FILES["image"]["name"];

    if ($file_name != "") {
        // A new file has been uploaded, move it to the uploads directory
        $tmp_name = $_FILES["image"]["tmp_name"];
        $name = basename($_FILES["image"]["name"]);
        $random_digit = rand(0000, 9999);
        $new_file_name = $random_digit . $name;

        move_uploaded_file($tmp_name, "$uploads_dir/$new_file_name");

        $sql = "UPDATE siteconfig SET site_keyword='$site_keyword', site_desc='$site_desc', site_title='$site_title', site_about='$site_about', site_footer='$site_footer', follow_text='$follow_text', site_url='$site_url', image='$new_file_name' WHERE id=1";
    } else {
        // No new file has been uploaded, only update the title and text fields
        $sql = "UPDATE siteconfig SET site_keyword='$site_keyword', site_desc='$site_desc', site_title='$site_title', site_about='$site_about', site_footer='$site_footer', follow_text='$follow_text', site_url='$site_url' WHERE id=1";
    }

    // Execute the SQL query
    $result = mysqli_query($con, $sql);
    
    if ($result) {
        $errormsg = "<div class='alert alert-success alert-dismissible alert-outline fade show'>
                      Site Settings updated successfully.
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
    } else {
        $errormsg = "<div class='alert alert-danger alert-dismissible alert-outline fade show'>
                      Failed to update site settings. Please try again.
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
    }
}
?>




                                <div class="card-body p-4">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="personalDetails" role="tabpanel">

                                        <?php
					 $query="SELECT * FROM siteconfig where id=1 ";


 $result = mysqli_query($con,$query);
$i=0;
while($row = mysqli_fetch_array($result))
{
	$site_title="$row[site_title]";
	$site_keyword="$row[site_keyword]";
  $site_about="$row[site_about]";
  $site_footer="$row[site_footer]";
  $follow_text="$row[follow_text]";
  $site_desc="$row[site_desc]";
  $site_url="$row[site_url]";
  $banner_image="$row[image]";
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


   <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label"> Site Title</label>
                                                            <input type="text" class="form-control" id="firstnameInput" name="site_title"  value="<?php print $site_title ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label"> Site Keywords</label>
                                                            <input type="text" class="form-control" id="firstnameInput" name="site_keyword"  value="<?php print $site_keyword ?>">
                                                        </div>
                                                    </div>


                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label"> Site Description</label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea5" name="site_desc" rows="3" placeholder="Enter Site Description"><?php print $site_desc ?></textarea>
                                                        </div>
                                                    </div>
                                                    <!--end col-->

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Footer About</label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea5"  name="site_about" rows="3" placeholder="Enter Footer About Text"> <?php print $site_about ?></textarea>
                                                        </div>
                                                    </div>


                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Footer Text</label>
                                                            <input type="text" class="form-control" id="firstnameInput" name="site_footer" placeholder="&copy; 2022 All Rights Reserved"  value="<?php print $site_footer ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Social Follow Text</label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea5" name="follow_text" rows="3" placeholder="Enter Footer follow us session Text"><?php print $follow_text ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Website URL </label>
                                                            <input type="text" class="form-control" id="firstnameInput" name="site_url" placeholder="https://website.com"  value="<?php print $site_url ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Banner</label>
                                                            <input type="file" class="form-control" name="image" ><br>
                                                            <img src="uploads/banner/<?php print $banner_image;?>" alt="Italian Trulli" width="340px">
                                                        </div>
                                                    </div>

                                                    <!--end col-->

                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="submit" name="save" class="btn btn-primary">Update Setting</button>

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

            <?php include"footer.php";?>
