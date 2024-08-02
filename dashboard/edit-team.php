<?php include "header.php";?>
<?php include "sidebar.php";
$teamid = $_GET['id']; ?>

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
                                <h4 class="mb-sm-0">Add Team</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Team</a></li>
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
                                                <i class="fas fa-home"></i> New Team
                                            </a>
                                        </li>


                                    </ul>
                                </div>
             <?php
                     $query="SELECT * FROM  team where id='$teamid' ";


 $result = mysqli_query($con,$query);
$i=0;
while($row = mysqli_fetch_array($result))
{
    $id="$row[id]";
    $fullname="$row[fullname]";
  $position="$row[position]";
  $description="$row[description]";
  $email="$row[email]";
  $phonenumber="$row[phonenumber]";
}
  ?>

<?php
$status = "OK"; //initial status
$msg="";
if(ISSET($_POST['save'])){
    // $team_id = mysqli_real_escape_string($con,$teamid);
    $fullname = mysqli_real_escape_string($con,$_POST['fullname']);
    $position = mysqli_real_escape_string($con,$_POST['position']);
    $description = mysqli_real_escape_string($con,$_POST['description']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $phonenumber = mysqli_real_escape_string($con,$_POST['phonenumber']);

    if ( strlen($fullname) < 5 ){
        $msg=$msg."Fullname Must Be More Than 2 Char Length.<BR>";
        $status= "NOTOK";
    }
    

    $uploads_dir = 'uploads/team';
    $file_name = $_FILES["image"]["name"];

    if ($file_name != "") {
        // A new file has been uploaded, move it to the uploads directory
        $tmp_name = $_FILES["image"]["tmp_name"];
        // basename() may prevent filesystem traversal attacks;
        // further validation/sanitation of the filename may be appropriate
        $name = basename($_FILES["image"]["name"]);
        $random_digit=rand(0000,9999);
        $new_file_name=$random_digit.$name;

        move_uploaded_file($tmp_name, "$uploads_dir/$new_file_name");

        $sql = "UPDATE team SET fullname='$fullname', position='$position',description='$description', email='$email',phonenumber='$phonenumber',image='$new_file_name' WHERE id=$teamid";
    } else {
        // No new file has been uploaded, only update the title and text fields
        $sql = "UPDATE team SET fullname='$fullname', position='$position',description='$description', email='$email',phonenumber='$phonenumber' WHERE id=$teamid";
    }

    if($status=="OK") {
        $qb=mysqli_query($con, $sql);

        if($qb){
            $errormsg= "
<div class='alert alert-success alert-dismissible alert-outline fade show'>
                 Team has been updated successfully.
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
                                                            <label for="firstnameInput" class="form-label"> Full Name</label>
                                                            <input type="text" class="form-control"  name="fullname" value="<?php print $fullname ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Position</label>
                                                            <input type="text" class="form-control"  name="position" value="<?php print $position ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Phone Number</label>
                                                            <input type="text" class="form-control"  name="phonenumber" value="<?php print $phonenumber ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Email</label>
                                                            <input type="text" class="form-control"  name="email" value="<?php print $email ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Description</label>
                                                            <textarea name="description" id="content" class="summernote form-control" style="color:#fff" required><?php print $description ?></textarea>
                                                        </div>
                                                    </div>
                                                   




                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Profile</label>
                                                            <input type="file" class="form-control" name="image" >
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="submit" name="save" class="btn btn-primary">Add Team</button>

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
            <?php include "footer.php";?>
