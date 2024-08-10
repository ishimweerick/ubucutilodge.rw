<?php include "include/header.php";?>
<!-- slider -->

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

 <!-- Promo Video -->
 <section class="banner-video-wrapper" data-overlay-dark="3">
        <video width="100%" height="100%" autoplay="autoplay" muted="" preload="auto" loop="loop">
            <source src="ubucuti-video.mp4" type="video/mp4">
        </video>
        <div class="wrap-content v-middle">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <h1>Ubucuti Lodge</h1>
                        <h4 style="font-size: 25px;">Come as a guest,<br> Leave as a friend</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

  <!-- Slider -->
 
    <!-- Booking Search -->



    <!-- About -->
    <section class="about section-padding bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="sub-title border-bot-light">Welcome to</div>
                </div>
                <div class="col-md-9">
                    <div class="section-title"><?php print $about_heading;?></div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <p style="text-align:justifiy"><?php print $about_content;?></p>
                            
                        </div>
                        <div class="col-lg-6 col-md-12">
                         
                             <img class="img-fluid rounded w-full wow zoomIn" data-wow-delay="0.1s" src="dashboard/uploads/about/<?php print $about_image;?>">
                               
                        
                        </div>
                    </div>
                </div><div class="col-md-3">
                    <div class="sub-title border-bot-light">On Booking</div>
                </div>
                <div class="row mb-30">
                                <div class="col-lg-4 col-md-12">
                                    <div class="reservations mb-15">
                                    <div class="icon"><span class="flaticon-location-pin"></span></div>
                                    <div class="text">
                                            <p>Ubucuti Lodge</p>9.5</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="reservations mb-15">
                                    <div class="icon"><span class="flaticon-location-pin"></span></div>
                                    <div class="text">
                                            <p>Lake Kivu Serena Hotel</p> 8.3</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="reservations mb-15">
                                        <div class="icon"><span class="flaticon-location-pin"></span></div>
                                        <div class="text">
                                            <p>Kivu Peace View Hotel</p>8.1
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Rooms -->
    <section class="rooms1 section-padding">
        <div class="container">
            <div class="row mb-30">
                <div class="col-md-3">
                    <div class="sub-title border-bot-light">Discover</div>
                </div>
                <div class="col-md-9">
                    <div class="section-title">Rooms <span>&amp;</span> Suites</div>
                </div>
            </div>
            <div class="rooms1-carousel owl-theme owl-carousel">


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
    <div class="rooms1-single">
        <div class="rooms1-img"> 
            <img src="dashboard/uploads/packages/<?php echo $row["ufile"]; ?>" alt=""> 
        </div>
        <div class="rooms1-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="rooms1-title">
                    <a href="room-details.php?id=<?php echo $row["id"]; ?>"><?php echo htmlspecialchars($row['package_title']); ?></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="book">
                        <div>
                            <a href="room-details.php?id=<?php echo $row["id"]; ?>" class="butn-dark2"><span>Book</span></a>
                        </div>
                        <div>
                            <span>from</span>

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
   
   
   <!-- Testimonials -->
<section class="testimonials">
    <div class="background bg-img bg-fixed section-padding pb-0" data-background="img/rooms/17.jpg" data-overlay-dark="4">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h3 class="sub-title border-bot-dark">Testimonials</h3>
                </div>
                <div class="col-md-8">
                    <div class="section-title whte">Guest Feedback</div>
                    <div class="testimonials-box">
                        <div class="owl-carousel owl-theme">
                            <?php
                                $result = mysqli_query($con, "SELECT * FROM testimony");
                                if (mysqli_num_rows($result) > 0) {
                                    $i=0;
                                    while($row = mysqli_fetch_array($result)) {
                            ?>
                            <div class="item"> 
                                <span>
                                    <i class="star-rating"></i>
                                    <i class="star-rating"></i>
                                    <i class="star-rating"></i>
                                    <i class="star-rating"></i>
                                    <i class="star-rating"></i>
                                </span>
                                <h5>"<?php echo $row['message']; ?>"</h5>
                            </div>
                            <?php
                                        $i++;
                                    }
                                } else {
                                    echo "No Slide found";
                                }
                            ?>     
                        </div>
                        <!-- Custom Red Arrows -->
                        <button class="custom-nav custom-prev">‹</button>
                        <button class="custom-nav custom-next">›</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- jQuery (necessary for Owl Carousel) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Owl Carousel CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<!-- Initialize Owl Carousel -->
<script>
$(document).ready(function(){
    var owl = $(".owl-carousel");
    owl.owlCarousel({
        loop: true,
        margin: 10,
        items: 1,
        dots: false // Hide the dots
    });

    // Custom navigation events
    $(".custom-prev").click(function() {
        owl.trigger('prev.owl.carousel');
    });

    $(".custom-next").click(function() {
        owl.trigger('next.owl.carousel');
    });
});
</script>

    




    <section class="service4 section-padding" data-scroll-index="1">
        <div class="container">
            <div class="row">

            <?php
      
      $result = mysqli_query($con,"SELECT * FROM `service` ORDER BY `service`.`id` DESC limit 3");
      if (mysqli_num_rows($result) > 0) {
$i=0;
while($row = mysqli_fetch_array($result)) {
  $title="$row[service_title]";
  $detail="$row[service_desc]";
  $ufile="$row[ufile]";
?>


                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="services4">
                        <div class="service-img"><img src="dashboard/uploads/services/<?php echo $ufile?>" alt="" class="w-100"></div>
                        <div class="service-header">
                            <h3 class="service-label" style="text-transform: uppercase;"><?php echo $title?></h3>
                        </div>
                        <div class="service-wrap">
                            <div class="service-cont">
                                <h4 class="service-title" style="text-transform: uppercase;"><?php echo $title?></h4>
                                <p class="service-text"><?php echo $detail?></p>
                            </div>
                           
                        </div>
                    </div>
                </div>
              
                <?php
            $i++;
        }
}
else{
echo "No result found";
}?>  
        
        <div class="butn-dark" ><center> <a href="amenities"><span>Learn More</span></a></center> </div>
            </div>
        </div>
    </section>


   <!-- Testiominals -->
   <section class="testimonials">
        <div class="background bg-img bg-fixed section-padding pb-0" data-background="dashboard/uploads/about/<?php print $about_banner;?>" data-overlay-dark="4">
            <div class="container">
                <div class="row">
                  
                    <div class="col-md-12" style="text-align:center">
                        <div class="section-title whte">Enjoiy</div>
                        <div class="testimonials-box">
                        <div class="owl-carousel owl-theme">
                       <H2>the taste of life</H2>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
    <?php include "include/footer.php";?>
