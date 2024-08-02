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
                                <h4 class="mb-sm-0">Edit About Page</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Page Section</a></li>
                                        <li class="breadcrumb-item active">About Page</li>
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
                             


                            <?php
           $status = "OK"; //initial status
$msg="";
           if(ISSET($_POST['save'])){
$about_heading = mysqli_real_escape_string($con,$_POST['about_heading']);
$about_content = mysqli_real_escape_string($con,$_POST['about_content']);
$about_history = mysqli_real_escape_string($con,$_POST['about_history']);
$history = mysqli_real_escape_string($con,$_POST['history']);
$vision = mysqli_real_escape_string($con,$_POST['vision']);
$mission = mysqli_real_escape_string($con,$_POST['mission']);



$uploads_dir = 'uploads/about';
$about_file_name = $_FILES["about_image"]["name"];
$history_file_name = $_FILES["history_image"]["name"];
$about_banner_name = $_FILES["about_banner"]["name"];

if ($about_file_name != "") {
    // Handle about_image file upload
    $about_tmp_name = $_FILES["about_image"]["tmp_name"];
    $about_name = basename($_FILES["about_image"]["name"]);
    $about_random_digit = rand(0000,9999);
    $new_about_file_name = $about_random_digit . $about_name;
    move_uploaded_file($about_tmp_name, "$uploads_dir/$new_about_file_name");
}

if ($history_file_name != "") {
    // Handle history_image file upload
    $history_tmp_name = $_FILES["history_image"]["tmp_name"];
    $history_name = basename($_FILES["history_image"]["name"]);
    $history_random_digit = rand(0000,9999);
    $new_history_file_name = $history_random_digit . $history_name;
    move_uploaded_file($history_tmp_name, "$uploads_dir/$new_history_file_name");
}

if ($about_banner_name != "") {
    // Handle history_image file upload
    $banner_tmp_name = $_FILES["about_banner"]["tmp_name"];
    $banner_name = basename($_FILES["about_banner"]["name"]);
    $banner_random_digit = rand(0000,9999);
    $new_about_banner_name = $banner_random_digit . $banner_name;
    move_uploaded_file($banner_tmp_name, "$uploads_dir/$new_about_banner_name");
}

// Update SQL query to include both about_image and history_image
$sql = "UPDATE about_section SET about_heading='$about_heading', about_content='$about_content', about_history='$about_history', history='$history', vision='$vision', mission='$mission'";

if ($about_file_name != "") {
    // If about_image was uploaded, add it to the SQL query
    $sql .= ", about_image='$new_about_file_name'";
}

if ($history_file_name != "") {
    // If history_image was uploaded, add it to the SQL query
    $sql .= ", history_image='$new_history_file_name'";
}

if ($new_about_banner_name != "") {
    // If history_image was uploaded, add it to the SQL query
    $sql .= ", about_banner='$new_about_banner_name'";
}

$sql .= " WHERE id=1";



if($status=="OK") {
    $qb=mysqli_query($con, $sql);

    if($qb){
        $errormsg= "
                    <div class='alert alert-success alert-dismissible alert-outline fade show'>
            About page has been updated successfully.
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
"; //printing error if found in validation
     
    }
} elseif ($status!=="OK") {
    $errormsg= "

                    <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                 ".$msg." 
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>"; //printing error if found in validation

} else {
    $errormsg= "
  
                    <div class='alert alert-danger alert-dismissible alert-outline fade show'>
             Some Technical Glitch Is There. Please Try Again Later Or Ask Admin For Help.
             
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>"; //printing error if found in validation
}
}
           ?>



                                <div class="card-body p-4">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="personalDetails" role="tabpanel">

                                        <?php
					 $query="SELECT * FROM about_section WHERE id=1";


 $result = mysqli_query($con,$query);
$i=0;
while($row = mysqli_fetch_array($result))
{
	$about_heading="$row[about_heading]";
    $about_content="$row[about_content]";
    $about_history="$row[about_history]";
    $history="$row[history]";
    $vision="$row[vision]";
  $mission="$row[mission]";
  $about_image="$row[about_image]";
  $history_image="$row[history_image]";
  $about_banner="$row[about_banner]";
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
                                                <h3 class="sec_title">About Banner</h3>

<div class="col-lg-12">
                                                       <div class="mb-3">
                                                           <input type="file" class="form-control" id="firstnameInput" name="about_banner" >
                                                           <br>
                                                            <img src="uploads/about/<?php echo $about_banner; ?>" alt="about_image" style="width: 100%; height: 400px; border: 2px solid black;">

                                                       </div>
                                                   </div>


                                                <h3 class="sec_title">About Section</h3>

 <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label"> Heading</label>
                                                            <input type="text" class="form-control" id="firstnameInput" name="about_heading"  value="<?php print $about_heading ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label"> Content</label>
                                                            <textarea name="about_content" id="content" class="summernote" required><?php print $about_content ?></textarea>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Content Cover</label>
                                                            <input type="file" class="form-control" id="firstnameInput" name="about_image" >
                                                            <br>
                                                            <img src="uploads/about/<?php echo $about_image; ?>" alt="about_image" style="width: 100%; height: 250px; border: 2px solid black;">
                                                        </div>
                                                    </div>

                                                    <h3 class="sec_title">History Section</h3>
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label"> Heading</label>
                                                            <input type="text" class="form-control" id="firstnameInput" name="about_history"  value="<?php print $about_history ?>">
                                                        </div>
                                                    </div>

   <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label"> Our History</label>
                                                            <textarea name="history" id="content" class="summernote" required ><?php print $history ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label"> History Cover</label>
                                                            <input type="file" class="form-control" id="firstnameInput" name="history_image" >
                                                            <br>
                          <img src="uploads/about/<?php print $history_image;?>" alt="history_image" style="width: 100%; height: 250px; border: 2px solid black;">
                                                        </div>
                                                    </div>
                                                  

                                                    <h3 class="sec_title">Vision & Mission Section</h3>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Vision</label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea5" name="vision" rows="5"><?php print $vision ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label"> Mission</label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea5" name="mission" rows="5"><?php print $mission ?></textarea>
                                                        </div>
                                                    </div>


                                                 

                                                 

                                               
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
