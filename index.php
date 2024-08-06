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

  <!-- Slider -->
  <header class="header slider-fade">
        <div class="owl-carousel owl-theme">
            <!-- The opacity on the image is made with "data-overlay-dark="number". You can change it using the numbers 0-9. -->
           
            <?php
            $result = mysqli_query($con,"SELECT * FROM slider");
if (mysqli_num_rows($result) > 0) {
    $i=0;
while($row = mysqli_fetch_array($result)) {
?>
            <div class="text-center item bg-img" data-overlay-dark="6" data-background="dashboard/uploads/slider/<?php print $row["ufile"]?>">
                <div class="v-middle caption">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-md-12"> <span>
                                    <i class="star-rating"></i>
                                    <i class="star-rating"></i>
                                    <i class="star-rating"></i>
                                    <i class="star-rating"></i>
                                    <i class="star-rating"></i>
                                </span>
                                <!-- <h4>Resort & Spa Hotel</h4> -->
                                <h1><?php echo $row["slide_title"]; ?></h1>
                                <h4><?php echo $row["slide_text"]; ?></h4>
                                <!-- <div class="butn-light mt-30 mb-30"> <a href="index.html#"><span>Explore More</span></a> </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>
               <?php
            
            $i++;
            }
}
else{
echo "No Slide found";
}
?>
        </div>
    </header>
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
    <!-- Promo Video -->
    <section class="banner-video-wrapper" data-overlay-dark="3">
        <video width="100%" height="100%" autoplay="autoplay" muted="" preload="auto" loop="loop">
            <source src="ubucuti-video.mp4" type="video/mp4">
        </video>
        <div class="wrap-content v-middle">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <h1>Welcome to Ubucuti Lodge</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
    <!-- Testiominals -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>





    <div class="container-fluid bg-body-tertiary py-3">
  <div id="testimonialCarousel" class="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="card shadow-sm rounded-3">
          <div class="quotes display-2 text-body-tertiary">
            <i class="bi bi-quote"></i>
          </div>
          <div class="card-body">
            <p class="card-text">"Some quick example text to build on the card title and make up the
              bulk of
              the card's content."</p>
            <div class="d-flex align-items-center pt-2">
              <img src="https://codingyaar.com/wp-content/uploads/square-headshot-1.png" alt="bootstrap testimonial carousel slider 2">
              <div>
                <h5 class="card-title fw-bold">Jane Doe</h5>
                <span class="text-secondary">CEO, Example Company</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="card shadow-sm rounded-3">
          <div class="quotes display-2 text-body-tertiary">
            <i class="bi bi-quote"></i>
          </div>
          <div class="card-body">
            <p class="card-text">"Some quick example text to build on the card title and make up the
              bulk of
              the card's content."</p>
            <div class="d-flex align-items-center pt-2">
              <img src="https://codingyaar.com/wp-content/uploads/square-headshot-2.png" alt="bootstrap testimonial carousel slider 2">
              <div>
                <h5 class="card-title fw-bold">June Doe</h5>
                <span class="text-secondary">CEO, Example Company</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="card shadow-sm rounded-3">
          <div class="quotes display-2 text-body-tertiary">
            <i class="bi bi-quote"></i>
          </div>
          <div class="card-body">
            <p class="card-text">"Some quick example text to build on the card title and make up the
              bulk of
              the card's content."</p>
            <div class="d-flex align-items-center pt-2">
              <img src="https://codingyaar.com/wp-content/uploads/bootstrap-profile-card-image.jpg" alt="bootstrap testimonial carousel slider 2">
              <div>
                <h5 class="card-title fw-bold">John Doe</h5>
                <span class="text-secondary">CEO, Example Company</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="card shadow-sm rounded-3">
          <div class="quotes display-2 text-body-tertiary">
            <i class="bi bi-quote"></i>
          </div>
          <div class="card-body">
            <p class="card-text">"Some quick example text to build on the card title and make up the
              bulk of
              the card's content."</p>
            <div class="d-flex align-items-center pt-2">
              <img src="https://codingyaar.com/wp-content/uploads/bootstrap-profile-card-image.jpg" alt="bootstrap testimonial carousel slider 2">
              <div>
                <h5 class="card-title fw-bold">John Doe</h5>
                <span class="text-secondary">CEO, Example Company</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="card shadow-sm rounded-3">
          <div class="quotes display-2 text-body-tertiary">
            <i class="bi bi-quote"></i>
          </div>
          <div class="card-body">
            <p class="card-text">"Some quick example text to build on the card title and make up the
              bulk of
              the card's content."</p>
            <div class="d-flex align-items-center pt-2">
              <img src="https://codingyaar.com/wp-content/uploads/bootstrap-profile-card-image.jpg" alt="bootstrap testimonial carousel slider 2">
              <div>
                <h5 class="card-title fw-bold">John Doe</h5>
                <span class="text-secondary">CEO, Example Company</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="card shadow-sm rounded-3">
          <div class="quotes display-2 text-body-tertiary">
            <i class="bi bi-quote"></i>
          </div>
          <div class="card-body">
            <p class="card-text">"Some quick example text to build on the card title and make up the
              bulk of
              the card's content."</p>
            <div class="d-flex align-items-center pt-2">
              <img src="https://codingyaar.com/wp-content/uploads/bootstrap-profile-card-image.jpg" alt="bootstrap testimonial carousel slider 2">
              <div>
                <h5 class="card-title fw-bold">John Doe</h5>
                <span class="text-secondary">CEO, Example Company</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="card shadow-sm rounded-3">
          <div class="quotes display-2 text-body-tertiary">
            <i class="bi bi-quote"></i>
          </div>
          <div class="card-body">
            <p class="card-text">"Some quick example text to build on the card title and make up the
              bulk of
              the card's content."</p>
            <div class="d-flex align-items-center pt-2">
              <img src="https://codingyaar.com/wp-content/uploads/bootstrap-profile-card-image.jpg" alt="bootstrap testimonial carousel slider 2">
              <div>
                <h5 class="card-title fw-bold">John Doe</h5>
                <span class="text-secondary">CEO, Example Company</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="card shadow-sm rounded-3">
          <div class="quotes display-2 text-body-tertiary">
            <i class="bi bi-quote"></i>
          </div>
          <div class="card-body">
            <p class="card-text">"Some quick example text to build on the card title and make up the
              bulk of
              the card's content."</p>
            <div class="d-flex align-items-center pt-2">
              <img src="https://codingyaar.com/wp-content/uploads/bootstrap-profile-card-image.jpg" alt="bootstrap testimonial carousel slider 2">
              <div>
                <h5 class="card-title fw-bold">John Doe</h5>
                <span class="text-secondary">CEO, Example Company</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="card shadow-sm rounded-3">
          <div class="quotes display-2 text-body-tertiary">
            <i class="bi bi-quote"></i>
          </div>
          <div class="card-body">
            <p class="card-text">"Some quick example text to build on the card title and make up the
              bulk of
              the card's content."</p>
            <div class="d-flex align-items-center pt-2">
              <img src="https://codingyaar.com/wp-content/uploads/bootstrap-profile-card-image.jpg" alt="bootstrap testimonial carousel slider 2">
              <div>
                <h5 class="card-title fw-bold">John Doe</h5>
                <span class="text-secondary">CEO, Example Company</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>

<p class="mt-5 text-center">Get a step-by-step written explanation here: <a href="https://codingyaar.com/bootstrap-5-testimonial-carousel-slider-2" target="_blank">Bootstrap 5 Testimonial Slider #2</a> </p>

<p class="mt-2 text-center">Get a step-by-step video explanation here: <a href="https://youtu.be/KrIJD3oc0oM" target="_blank">Bootstrap 5 Testimonial Carousel Slider</a> </p>



    <style>
        .carousel img {
  width: 70px;
  max-height: 70px;
  border-radius: 50%;
  margin-right: 1rem;
  overflow: hidden;
}
.carousel-inner {
  padding: 1em;
}

@media screen and (min-width: 576px) {
  .carousel-inner {
    display: flex;
    width: 90%;
    margin-inline: auto;
    padding: 1em 0;
    overflow: hidden;
  }
  .carousel-item {
    display: block;
    margin-right: 0;
    flex: 0 0 calc(100% / 2);
  }
}
@media screen and (min-width: 768px) {
  .carousel-item {
    display: block;
    margin-right: 0;
    flex: 0 0 calc(100% / 3);
  }
}
.carousel .card {
  margin: 0 0.5em;
  border: 0;
}

.carousel-control-prev,
.carousel-control-next {
  width: 3rem;
  height: 3rem;
  background-color: grey;
  border-radius: 50%;
  top: 50%;
  transform: translateY(-50%);
}

</style>
<script>
 const multipleItemCarousel = document.querySelector("#testimonialCarousel");

if (window.matchMedia("(min-width:576px)").matches) {
  const carousel = new bootstrap.Carousel(multipleItemCarousel, {
    interval: false
  });

  var carouselWidth = $(".carousel-inner")[0].scrollWidth;
  var cardWidth = $(".carousel-item").width();

  var scrollPosition = 0;

  $(".carousel-control-next").on("click", function () {
    if (scrollPosition < carouselWidth - cardWidth * 3) {
      console.log("next");
      scrollPosition = scrollPosition + cardWidth;
      $(".carousel-inner").animate({ scrollLeft: scrollPosition }, 800);
    }
  });
  $(".carousel-control-prev").on("click", function () {
    if (scrollPosition > 0) {
      scrollPosition = scrollPosition - cardWidth;
      $(".carousel-inner").animate({ scrollLeft: scrollPosition }, 800);
    }
  });
} else {
  $(multipleItemCarousel).addClass("slide");
}

</script>

























    <section class="testimonials">
        <div class="background bg-img bg-fixed section-padding pb-0" data-background="img/rooms/17.jpg" data-overlay-dark="4">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h3 class="sub-title border-bot-dark">Testiominals</h3>
                    </div>
                    <div class="col-md-8">
                        <div class="section-title whte">Guest Feedback</div>
                        <div class="testimonials-box">
                        <div class="owl-carousel owl-theme">






                        





                        
                        <?php
            $result = mysqli_query($con,"SELECT * FROM testimony");
if (mysqli_num_rows($result) > 0) {
    $i=0;
while($row = mysqli_fetch_array($result)) {
?>
                    
                                <div class="item"> <span>
                                        <i class="star-rating"></i>
                                        <i class="star-rating"></i>
                                        <i class="star-rating"></i>
                                        <i class="star-rating"></i>
                                        <i class="star-rating"></i>
                                    </span>
                                    <h5>"<?php echo $row["message"]; ?>"</h5>
                                    <!-- <div class="info">
                                        <div class="author-img"> <img src="img/team/1.jpg" alt=""> </div>
                                        <div class="cont">
                                            <h6><?php echo $row["name"]; ?></h6> <span>Customer Review</span>
                                        </div>
                                    </div> -->
                                </div>
                               
                       

                            <?php
            
            $i++;
            }
}
else{
echo "No Slide found";
}
?>     </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services -->
    




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
