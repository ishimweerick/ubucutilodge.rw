<?php include "include/header.php"; ?>
<!-- Header Banner -->
<div class="banner-header section-padding valign bg-img bg-fixed bg-position-bottom" data-overlay-dark="5" data-background="dashboard/uploads/banner/<?php print $banner_image;?>">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center caption">
                <h1>Rooms & Suites</h1>
            </div>
        </div>
    </div>
    <!-- button scroll -->
    <a href="rooms.html#" data-scroll-nav="1" class="mouse smoothscroll"> <span class="mouse-icon">
            <span class="mouse-wheel"></span> </span>
    </a>
</div>
<!-- Rooms -->
<section class="rooms1 section-padding pb-60" data-scroll-index="1">
    <div class="container">
        <div class="row">

        <?php
        // Function to determine if today is a weekday or weekend
        function isWeekend($date) {
            return (date('N', strtotime($date)) >= 6);
        }

        $result = mysqli_query($con, "SELECT * FROM `packages` ORDER BY `packages`.`order` ASC");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                // Determine the price based on the current day
                $currentDay = date('Y-m-d');
                $price = isWeekend($currentDay) ? $row['price_weekend'] : $row['price_weekday'];
        ?>
                <div class="col-md-6 mb-60">
                    <div class="rooms1-single">
                        <div class="rooms1-img">
                            <img src="dashboard/uploads/packages/<?php echo $row["ufile"]; ?>" alt="">
                        </div>
                        <div class="rooms1-content active">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="rooms1-title">
                                        <a href="room-details.php?id=<?php echo $row["id"]; ?>"><?php echo htmlspecialchars($row['package_title']); ?></a>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="book">
                                        <div>
                                            <a href="room-details.php?id=<?php echo $row["id"]; ?>" class="butn-dark2"><span>Book</span></a>
                                        </div>
                                     
                                        <?php if (isWeekend($currentDay)) { ?>
                                            <div>
                                                <!-- <span>Weekend Price: </span> -->
                                                <span class="price">$<?php echo number_format($row['price_weekend'], 2); ?></span>
                                            </div>
                                        <?php } else { ?>
                                            <div>
                                                <!-- <span>Weekday Price: </span> -->
                                                <span class="price">$<?php echo number_format($row['price_weekday'], 2); ?></span>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "No result found";
        }
        ?>
        </div>
    </div>
</section>
<!-- Booking Search -->
<section class="section-padding bg-img bg-fixed" data-overlay-dark="3" data-background="img/rooms/18.jpg">
    <div class="container">
        <div class="booking-inner clearfix">
            <form id="bookingForm" class="form1 clearfix">
                <div class="col1 c1">
                    <div class="input1_wrapper border-l border-b border-t border-r">
                        <label>Check in</label>
                        <div class="input1_inner">
                            <input type="text" class="form-control input datepicker" placeholder="Check in" name="checkin" required>
                        </div>
                    </div>
                </div>
                <div class="col1 c2">
                    <div class="input1_wrapper border-l border-b border-t border-r">
                        <label>Check out</label>
                        <div class="input1_inner">
                            <input type="text" class="form-control input datepicker" placeholder="Check out" name="checkout" required>
                        </div>
                    </div>
                </div>
                <div class="col2 c3">
                    <div class="select1_wrapper border-l border-b border-t border-r">
                        <label>Adults</label>
                        <div class="select1_inner">
                            <select class="select2 select" style="width: 100%" name="adults" required>
                                <option value="1">1 Adult</option>
                                <option value="2">2 Adults</option>
                                <option value="3">3 Adults</option>
                                <option value="4">4 Adults</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col2 c4">
                    <div class="select1_wrapper border-l border-b border-t border-r">
                        <label>Children</label>
                        <div class="select1_inner">
                            <select class="select2 select" style="width: 100%" name="children">
                                <option value="0">Children</option>
                                <option value="1">1 Child</option>
                                <option value="2">2 Children</option>
                                <option value="3">3 Children</option>
                                <option value="4">4 Children</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col2 c5">
                    <div class="select1_wrapper border-l border-b border-t border-r">
                        <label>Rooms</label>
                        <div class="select1_inner">
                            <select class="select2 select" style="width: 100%" name="room">
                                <?php
                                $result = mysqli_query($con,"SELECT * FROM `packages` ORDER BY `packages`.`order` ASC");
                                if (mysqli_num_rows($result) > 0) {
                                    $i=0;
                                    while($row = mysqli_fetch_array($result)) {
                                        $title="$row[package_title]";
                                        $id="$row[id]";
                                        ?>
                                        <option value="<?php echo $title?>"><?php echo $title?></option>
                                        <?php
                                        $i++;
                                    }
                                } else {
                                    echo "No result found";
                                }
                                ?>  
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col3 c6">
                    <button type="button" class="btn-form1-submit" data-bs-toggle="modal" data-bs-target="#contactModal">Check Now</button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Contact Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">Enter Your Contact Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="contactForm">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    // Gather data from both forms
    var bookingData = new FormData(document.getElementById('bookingForm'));
    var contactData = new FormData(document.getElementById('contactForm'));
    for (var pair of contactData.entries()) {
        bookingData.append(pair[0], pair[1]);
    }

    // Send data via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'process_booking.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert('Booking request sent successfully!');
        } else {
            alert('An error occurred. Please try again.');
        }
    };
    xhr.send(bookingData);
    // Close the modal
    var modal = bootstrap.Modal.getInstance(document.getElementById('contactModal'));
    modal.hide();
});
</script>

<?php include "include/footer.php"; ?>