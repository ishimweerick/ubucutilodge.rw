<?php
include "header.php";
$todo=  mysqli_real_escape_string($con,$_GET['id']);
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
					 $query="SELECT * FROM  service where id='$todo' ";


 $result = mysqli_query($con,$query);
$i=0;
while($row = mysqli_fetch_array($result))
{
	$id="$row[id]";
	$service_title="$row[service_title]";
  $service_detail="$row[service_detail]";
  $service_desc="$row[service_desc]";
  $ufile_image="$row[ufile]";
}
  ?>

                    <div class="row">

                        <!--end col-->
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
$msg="";
if(ISSET($_POST['save'])){
    $service_title = mysqli_real_escape_string($con,$_POST['service_title']);
    $service_desc = mysqli_real_escape_string($con,$_POST['service_desc']);
    $service_detail = mysqli_real_escape_string($con,$_POST['service_detail']);

    if ( strlen($service_title) < 5 ){
        $msg=$msg."Title Must Have At Least 2 Char Length.<BR>";
        $status= "NOTOK";
    }
    

    $uploads_dir = 'uploads/services';
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

        $sql = "UPDATE service SET service_title='$service_title', service_desc='$service_desc',service_detail='$service_detail',ufile='$new_file_name' WHERE id=$todo";
    } else {
        // No new file has been uploaded, only update the title and text fields
        $sql = "UPDATE service SET service_title='$service_title', service_desc='$service_desc',service_detail='$service_detail' WHERE id=$todo";
    }

    if($status=="OK") {
        $qb=mysqli_query($con, $sql);

        if($qb){
            $errormsg= "
<div class='alert alert-success alert-dismissible alert-outline fade show'>
                 Service has been updated successfully.
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>
 "; //printing error if found in validation
         
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
                                                            <label for="firstnameInput" class="form-label"> Service Title</label>
                                                            <input type="text" class="form-control" id="firstnameInput" name="service_title" value="<?php print $service_title ?>" placeholder="Enter Service Title">
                                                        </div>
                                                    </div>

                                                 

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label"> Service Detail</label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea5" name="service_detail" rows="3"><?php print $service_detail ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Profile</label>
                                                            <input type="file" class="form-control" name="ufile" >
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                          
                                                            <img src="uploads/services/<?php print $ufile_image;?>" alt="<?php print $service_title ?>" width="540px">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label"> Service Description</label>
                                                            <textarea name="service_desc" id="content" class="summernote" required><?php print $service_desc ?></textarea>
                                                        </div>
                                                    </div>
                                                 

                                                    <!--end col-->

                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="submit" name="save" class="btn btn-primary">Update Service</button>

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
    </script>
            <?php include "footer.php";?>
