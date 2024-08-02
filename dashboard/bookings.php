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
                                <h4 class="mb-sm-0">Bookings</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">All</a></li>
                                        <li class="breadcrumb-item active">Bookings</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Booking List</h5>
                                </div>
                                <div class="card-body">
                                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>

                                                <th data-ordering="false">Client Details</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        <?php
				   $q="SELECT b.`id` AS booking_id, 
                   b.`name`, 
                   b.`phone`, 
                   b.`email`, 
                   b.`checkin_date`, 
                   b.`checkout_date`, 
                   b.`package_id`, 
                   b.`created_at`, 
                   p.`id` AS package_id, 
                   p.`package_title`, 
                   p.`package_description`, 
                   p.`package_price`, 
                   p.`package_day`, 
                   p.`package_guest`
            FROM `bookings` AS b
            JOIN `packages` AS p ON b.`package_id` = p.`id`";


 $r123 = mysqli_query($con,$q);

while($ro = mysqli_fetch_array($r123))
{

	$name="$ro[name]";
	$phone="$ro[phone]";
	$email="$ro[email]";
	$checkin_date="$ro[checkin_date]";
	$checkout_date="$ro[checkout_date]";
	$package_title="$ro[package_title]";
	$package_description="$ro[package_description]";
	$package_price="$ro[package_price]";
	$package_guest="$ro[package_guest]";
	$package_day="$ro[package_day]";
	$booking_id="$ro[booking_id]";

    $checkin_datetime = new DateTime($checkin_date);
    $checkout_datetime = new DateTime($checkout_date);
    
    // Calculate the difference in days
    $interval = $checkin_datetime->diff($checkout_datetime);
    $days = $interval->days;
  print "<tr>

				  <td> $name |  Phone Number: <b>$phone</b> | Email Address: <b>$email</b></td>
				  <td> From: <b>$checkin_date</b> |  To: <b>$checkout_date</b> | Days: <b>$days</b></td>
				  <td> $package_title <br> <b>Price: $ $package_price | Guest: $package_guest | Day: $package_day</b></td>

          <td>
                                                    <div class='dropdown d-inline-block'>
                                                        <button class='btn btn-soft-secondary btn-sm dropdown' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                            <i class='ri-more-fill align-middle'></i>
                                                        </button>
                                                        <ul class='dropdown-menu dropdown-menu-end'>

                                                            <li>
                                                                <a href='deletebooking.php?booking=$booking_id' class='dropdown-item remove-item-btn'>
                                                                    <i class='ri-delete-bin-fill align-bottom me-2 text-muted'></i> Delete
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>


				  </tr>";

  }
  ?>




                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->




                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?php include"footer.php";?>
