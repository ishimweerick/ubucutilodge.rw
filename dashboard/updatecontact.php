<?php 
include "header.php";
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
           <h4 class="mb-sm-0">Site Contact</h4>
           <div class="page-title-right">
             <ol class="breadcrumb m-0">
               <li class="breadcrumb-item"><a href="javascript: void(0);">Update</a></li>
               <li class="breadcrumb-item active">Contact</li>
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
                   <i class="fas fa-home"></i> Update Contact
                 </a>
               </li>
             </ul>
           </div>

           <?php
           $status = "OK"; // initial status
           $msg = "";

           if (isset($_POST['save'])) {
             $company_officeatel = mysqli_real_escape_string($con, $_POST['company_officeatel']);
             $company_officemob = mysqli_real_escape_string($con, $_POST['company_officemob']);
             $titleone = mysqli_real_escape_string($con, $_POST['titleone']);
             $titletwo = mysqli_real_escape_string($con, $_POST['titletwo']);
             $titlethree = mysqli_real_escape_string($con, $_POST['titlethree']);
             $company_email = mysqli_real_escape_string($con, $_POST['company_email']);
             $company_website = mysqli_real_escape_string($con, $_POST['company_website']);
             $company_officeaddress = mysqli_real_escape_string($con, $_POST['company_officeaddress']);
             $company_officeaddress_map = mysqli_real_escape_string($con, $_POST['company_officeaddress_map']);

             if (strlen($company_officeatel) < 10) {
               $msg .= "Phone field cannot be empty.<br>";
               $status = "NOTOK";
             }
             if (strlen($company_email) < 5) {
               $msg .= "Email field must contain an email.<br>";
               $status = "NOTOK";
             }

             if ($status == "OK") {
               $qb = mysqli_query($con, "UPDATE sitecontact SET company_officeatel='$company_officeatel', company_officemob='$company_officemob', titleone='$titleone', titletwo='$titletwo', titlethree='$titlethree', company_email='$company_email', company_website='$company_website', company_officeaddress='$company_officeaddress', company_officeaddress_map='$company_officeaddress_map' WHERE id=1");

               if ($qb) {
                 $errormsg = "
                 <div class='alert alert-success alert-dismissible alert-outline fade show'>
                   Contact data updated successfully.
                   <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                 </div>";
               }
             } elseif ($status !== "OK") {
               $errormsg = "
               <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                 $msg
                 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
               </div>";
             } else {
               $errormsg = "
               <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                 Some technical glitch is there. Please try again later or ask admin for help.
                 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
               </div>";
             }
           }
           ?>

           <div class="card-body p-4">
             <div class="tab-content">
               <div class="tab-pane active" id="personalDetails" role="tabpanel">
                 <?php
                 $query = "SELECT * FROM sitecontact WHERE id=1";
                 $result = mysqli_query($con, $query);
                 $row = mysqli_fetch_array($result);

                 $company_officeatel = $row['company_officeatel'];
                 $company_officemob = $row['company_officemob'];
                 $titleone = $row['titleone'];
                 $titletwo = $row['titletwo'];
                 $titlethree = $row['titlethree'];
                 $company_email = $row['company_email'];
                 $company_website = $row['company_website'];
                 $company_officeaddress = $row['company_officeaddress'];
                 $company_officeaddress_map = $row['company_officeaddress_map'];

                 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                   print $errormsg;
                 }
                 ?>
                 <form action="" method="post" enctype="multipart/form-data">
                   <div class="row">
                     <div class="col-lg-6">
                       <div class="mb-3">
                         <label for="officeTel" class="form-label">Phone</label>
                         <input type="text" class="form-control" id="officeTel" name="company_officeatel" value="<?php print $company_officeatel ?>">
                       </div>
                     </div>
                     <div class="col-lg-6">
                       <div class="mb-3">
                         <label for="officeMob" class="form-label">Alternative Phone</label>
                         <input type="text" class="form-control" id="officeMob" name="company_officemob" value="<?php print $company_officemob ?>">
                       </div>
                     </div>
                     <div class="col-lg-6">
                       <div class="mb-3">
                         <label for="officeAddress" class="form-label">Our Office</label>
                         <input type="text" class="form-control" id="officeAddress" name="company_officeaddress" value="<?php print $company_officeaddress ?>">
                       </div>
                     </div>
                     <div class="col-lg-6">
                       <div class="mb-3">
                         <label for="officeEmail" class="form-label">Email</label>
                         <input type="email" class="form-control" id="officeEmail" name="company_email" value="<?php print $company_email ?>">
                       </div>
                     </div>
                     <div class="col-lg-6">
                       <div class="mb-3">
                         <label for="officeWebsite" class="form-label">Website URL</label>
                         <input type="text" class="form-control" id="officeWebsite" name="company_website" value="<?php print $company_website ?>">
                       </div>
                     </div>
                     <div class="col-lg-6">
                       <div class="mb-3">
                         <label for="officeMap" class="form-label">Map Frame</label>
                         <input type="text" class="form-control" id="officeMap" name="company_officeaddress_map" value="<?php print $company_officeaddress_map ?>">
                       </div>
                     </div>
                     <div class="col-lg-6">
                       <div class="mb-3">
                         <label for="titleOne" class="form-label">Main Title</label>
                         <input type="text" class="form-control" id="titleOne" name="titleone" value="<?php print $titleone ?>">
                       </div>
                     </div>
                     <div class="col-lg-6">
                       <div class="mb-3">
                         <label for="titleTwo" class="form-label">Second Title</label>
                         <input type="text" class="form-control" id="titleTwo" name="titletwo" value="<?php print $titletwo ?>">
                       </div>
                     </div>
                     <div class="col-lg-6">
                       <div class="mb-3">
                         <label for="titleThree" class="form-label">Third Title</label>
                         <input type="text" class="form-control" id="titleThree" name="titlethree" value="<?php print $titlethree ?>">
                       </div>
                     </div>
                     <div class="col-lg-12">
                       <div class="hstack gap-2 justify-content-end">
                         <button type="submit" name="save" class="btn btn-primary">Update Changes</button>
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

 <?php include "footer.php"; ?>
