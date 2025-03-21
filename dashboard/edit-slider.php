<?php include"header.php";?>
<?php include"sidebar.php";
 $slideid = $_GET['id']; ?>

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
                                <h4 class="mb-sm-0">Edit Slider</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Slider</a></li>
                                        <li class="breadcrumb-item active">Edit</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


                    <div class="row">
              <?php
                     $query="SELECT * FROM  slider where id='$slideid' ";


 $result = mysqli_query($con,$query);
$i=0;
while($row = mysqli_fetch_array($result))
{
    $id="$row[id]";
    $service_title="$row[slide_title]";
  $service_detail="$row[slide_text]";
  $ufile="$row[ufile]";
}
  ?>
                        <!--end col-->
                        <div class="col-xxl-9">
                            <div class="card mt-xxl-n5">
                                <div class="card-header">
                                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab" aria-selected="false">
                                                <i class="fas fa-home"></i> Edit Slider
                                            </a>
                                        </li>


                                    </ul>
                                </div>


<?php
$status = "OK"; //initial status
$msg="";
if(ISSET($_POST['save'])){
    $slide_id = mysqli_real_escape_string($con,$slideid);
    $slide_title = mysqli_real_escape_string($con,$_POST['slide_title']);
    $slide_text = mysqli_real_escape_string($con,$_POST['slide_text']);

    if ( strlen($slide_title) < 5 ){
        $msg=$msg."Slider Title Must Be More Than 5 Char Length.<BR>";
        $status= "NOTOK";
    }
    if ( strlen($slide_text) > 300 ){
        $msg=$msg."Slider Text description Must Be Less Than 300 Char Length.<BR>";
        $status= "NOTOK";
    }

    $uploads_dir = 'uploads/slider';
    $file_name = $_FILES["ufile"]["name"];

    if ($file_name != "") {
        // A new file has been uploaded, move it to the uploads directory
        $tmp_name = $_FILES["ufile"]["tmp_name"];
        // basename() may prevent filesystem traversal attacks;
        // further validation/sanitation of the filename may be appropriate
        $name = basename($_FILES["ufile"]["name"]);
        $random_digit=rand(0000,9999);
        $new_file_name=$random_digit.$name;

        move_uploaded_file($tmp_name, "$uploads_dir/$new_file_name");

        $sql = "UPDATE slider SET slide_title='$slide_title', slide_text='$slide_text', ufile='$new_file_name' WHERE id=$slide_id";
    } else {
        // No new file has been uploaded, only update the title and text fields
        $sql = "UPDATE slider SET slide_title='$slide_title', slide_text='$slide_text' WHERE id=$slide_id";
    }

    if($status=="OK") {
        $qb=mysqli_query($con, $sql);

        if($qb){
            $errormsg= "
<div class='alert alert-success alert-dismissible alert-outline fade show'>
                 Slider has been updated successfully.
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>
 "; //printing error if found in validation
  echo "<meta http-equiv='refresh' content='2;url=slider'>";
         
        }
    } elseif ($status!=="OK") {
        $errormsg= "
<div class='alert alert-danger alert-dismissible alert-outline fade show'>
                     ".$msg." <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>"; //printing error if found in validation

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
if($_SERVER['REQUEST_METHOD'] == 'POST')
						{
						print $errormsg;
						}
   ?>
              <form action="" method="post" enctype="multipart/form-data">
                                                <div class="row">



   <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label"> Slider Title</label>
                                                           
                                                            <input type="text" class="form-control" id="firstnameInput" name="slide_title" value="<?php print $service_title ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label"> Slider Text</label>
                                                            <input type="text" class="form-control" id="firstnameInput" name="slide_text" value="<?php print $service_title ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Photo (1920x781)</label>
                                                            <input type="file" class="form-control" id="firstnameInput" name="ufile" >
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="submit" name="save" class="btn btn-primary">Upload Slider</button>

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
