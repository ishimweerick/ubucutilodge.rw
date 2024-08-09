<?php
include "include/header.php";
$todo = mysqli_real_escape_string($con, $_GET["id"]);

// Fetch package details along with the category name
$rt = mysqli_query($con, "SELECT p.*, c.cat_name 
                          FROM packages p 
                          INNER JOIN packages_category c 
                          ON p.package_category = c.id 
                          WHERE p.id='$todo'");
$tr = mysqli_fetch_array($rt);
$package_title = $tr['package_title'];
$package_category = $tr['cat_name']; // Accessing category name from joined table
$package_description = $tr['package_description'];
$price_weekday = $tr['price_weekday'];
$price_weekend = $tr['price_weekend'];
$ufile = $tr['ufile'];

// Fetch amenities for the package
$amenities_query = "
SELECT a.title, a.icon
FROM amenities a
JOIN package_amenities pa ON a.id = pa.amenity_id
WHERE pa.package_id = '$todo'
";
$amenities_result = mysqli_query($con, $amenities_query);

// Function to determine if today is a weekday or weekend
function isWeekend($date) {
    return (date('N', strtotime($date)) >= 6);
}

// Determine the price based on the current day
$currentDay = date('Y-m-d');
$isWeekend = isWeekend($currentDay);
$price = $isWeekend ? $price_weekend : $price_weekday;
?>

<!-- Room Page Slider -->
<!-- Room Page Slider -->
<header class="header slider">
    <div class="owl-carousel owl-theme">
        <!-- The opacity on the image is made with "data-overlay-dark="number". You can change it using the numbers 0-9. -->
        <?php
            $portfolio_query = mysqli_query($con, "SELECT * FROM photo WHERE package_id='$todo'");
            $active = true;
            $hasImages = false;
            while ($portfolio_row = mysqli_fetch_array($portfolio_query)) {
                $location = $portfolio_row['location'];
                $hasImages = true;
        ?>
        <div class="text-center item bg-img" data-overlay-dark="5" data-background="dashboard/<?php echo $location; ?>"></div>
        <?php }
            if (!$hasImages) { ?>
                <div class="carousel-item active">
                    <img src="default_image.jpg" class="d-block w-100" alt="Default Image">
                </div>
        <?php } ?>
    </div>
    <!-- button scroll -->
    <a href="room-details2.html#" data-scroll-nav="1" class="mouse smoothscroll"> <span class="mouse-icon">
            <span class="mouse-wheel"></span> </span>
    </a>
</header>

<!-- Room Content -->
<section class="room-details1 section-padding" data-scroll-index="1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title"><?php echo htmlspecialchars($package_title); ?></div>
            </div>
            <div class="col-md-8">
                <p class="mb-30"><?php echo htmlspecialchars($package_description); ?></p>
                <!-- Trigger for Booking Modal -->
                <button type="button" class="btn-form1-submit" data-toggle="modal" data-target="#bookingModal">Book Now</button>
            </div>
            <div class="col-md-3 offset-md-1">
                <h6>Amenities</h6>
                <ul class="list-unstyled page-list mb-30">
                <?php while ($row = mysqli_fetch_assoc($amenities_result)) { ?>
                <li>
                    <div class="page-list-icon"> 
                        <span class="<?php echo htmlspecialchars($row['icon']); ?>"></span> 
                    </div>
                    <div class="page-list-text">
                        <p><?php echo htmlspecialchars($row['title']); ?></p>
                    </div>
                </li>
                <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Displaying price based on the day -->
<section class="price-section section-padding">
    <div class="container">
        <h4>Today's Price: $<?php echo number_format($price, 2); ?></h4>
    </div>
</section>

<?php include "include/footer.php"; ?>

<!-- Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="book_package.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="bookingModalLabel">Book Package</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="package_id" value="<?php echo $todo; ?>">
          <input type="hidden" name="price" value="<?php echo $price; ?>">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" required>
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" name="phone" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" required>
          </div>
          <div class="form-group">
            <label for="checkin_date">Check-in Date</label>
            <input type="text" class="form-control datepicker" name="checkin_date" required>
          </div>
          <div class="form-group">
            <label for="checkout_date">Check-out Date</label>
            <input type="text" class="form-control datepicker" name="checkout_date" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Book Now</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Datepicker JS (if used) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize datepicker
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
    });
});
</script>
