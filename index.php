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
   
   
   <script>
    $(document).ready(function(){
    var owl = $('.owl-carousel');

    owl.owlCarousel({
        loop:true,
        margin:10,
        nav:false, // Disable default navigation
        items:1, // Adjust the number of visible items as needed
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true
    });

    // Custom Navigation Events
    $('.custom-next').click(function() {
        owl.trigger('next.owl.carousel');
    });
    $('.custom-prev').click(function() {
        owl.trigger('prev.owl.carousel');
    });
});

</script>
<style>
   /* Custom red arrow buttons */
.custom-nav {
    background-color: red;
    border: none;
    color: white;
    font-size: 30px;
    padding: 10px 15px;
    cursor: pointer;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    border-radius: 50%;
    z-index: 1000; /* Ensures it stays above other content */
    opacity: 0.9; /* Slight transparency */
}

/* Positioning of the previous button */
.custom-prev {
    left: -20px; /* Adjust the left position to your preference */
}

/* Positioning of the next button */
.custom-next {
    right: -20px; /* Adjust the right position to your preference */
}

/* Darken the arrows slightly on hover */
.custom-nav:hover {
    background-color: darkred;
    color: white;
    opacity: 1; /* Full opacity on hover */
}

</style>
<!-- Testimonial Section -->
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
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <div class="item">
                                        <span>
                                            <i class="star-rating"></i>
                                            <i class="star-rating"></i>
                                            <i class="star-rating"></i>
                                            <i class="star-rating"></i>
                                            <i class="star-rating"></i>
                                        </span>
                                        <h5>"<?php echo $row["message"]; ?>"</h5>
                                    </div>
                                    <?php
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




<div class="testimonials-section">
    <input type="radio" name="slider" title="slide1" checked="checked" class="slider__nav"/>
    <input type="radio" name="slider" title="slide2" class="slider__nav"/>
    <input type="radio" name="slider" title="slide3" class="slider__nav"/>
    <input type="radio" name="slider" title="slide4" class="slider__nav"/>
    <input type="radio" name="slider" title="slide5" class="slider__nav"/>
  <div class="slider__inner">
    <div class="slider__contents">
      <quote>&rdquo;</quote>
      <p class="slider__txt">We love you guys. It's easy to order, we get shipments quick and my rep solves tough problems the right way. We get answers that work.</p>
      <h2 class="slider__caption">Rhonda | NylonCraft</h2>
    </div>
    <div class="slider__contents">
      <quote>&rdquo;</quote>
      <p class="slider__txt">You all bend over backwards to get it done. Inside sales and the Account Managers are great! It's your service...you all know that it's not just about taking orders it's about service. Why do we choose you guys - your people, your prices, you're quick and you have a ton of technical knowledge.</p>
      <h2 class="slider__caption">Jared | Rexam</h2>
    </div>
    <div class="slider__contents">
      <quote>&rdquo;</quote>
      <p class="slider__txt">It's the long-term relationship we have with Proheat that keeps me calling you guys. I trust you, you're quick, and everybody I've ever spoken to there are all great people. Our CEO, Bill, talks about building relationships. That's exactly what Proheat does, and I couldn't be happier.</p>
      <h2 class="slider__caption">Chris | C&M Fine Pack</h2>
    </div>
    <div class="slider__contents">
      <quote>&rdquo;</quote>
      <p class="slider__txt">You answer my questions, always takes care of problems, and I never have a hassle.</p>
      <h2 class="slider__caption">Rex | LNP Engineering Plastics</h2>
    </div>
    <div class="slider__contents">
      <quote>&rdquo;</quote>
      <p class="slider__txt">Proheat's staff are all so friendly and everybody goes above and beyond. Everyone is courteous, everything is quick and you get us what we need. I have to shop around for everything and we ALWAYS come back to Proheat.</p>
      <h2 class="slider__caption">Darlene | Russel Stover</h2>
    </div>
  </div>
</div>

<style>
    *, *:before, *:after {
  box-sizing: border-box;
}
html, body {
  height: 100%;
}
.testimonials-section {
  background: #fff;
  height: 600px;
  position: relative;
  overflow: hidden;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-flex-flow: row nowrap;
  -ms-flex-flow: row nowrap;
  flex-flow: row nowrap;
  -webkit-box-align: end;
  -webkit-align-items: flex-end;
  -ms-flex-align: end;
  align-items: flex-end;
  -webkit-box-pack: center;
  -webkit-justify-content: center;
  -ms-flex-pack: center;
  justify-content: center;
}
.slider__nav {
  width: 12px;
  height: 12px;
  margin: 80px 12px;
  border-radius: 50%;
  z-index: 10;
  outline: 6px solid #ccc;
  outline-offset: -6px;
  box-shadow: 0 0 0 0 #333, 0 0 0 0 rgba(51, 51, 51, 0);
  cursor: pointer;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}
.slider__nav:checked {
  -webkit-animation: check 0.4s linear forwards;
  animation: check 0.4s linear forwards;
}
.slider__nav:checked:nth-of-type(1) ~ .slider__inner {
  left: 0%;
}
.slider__nav:checked:nth-of-type(2) ~ .slider__inner {
  left: -100%;
}
.slider__nav:checked:nth-of-type(3) ~ .slider__inner {
  left: -200%;
}
.slider__nav:checked:nth-of-type(4) ~ .slider__inner {
  left: -300%;
}
.slider__nav:checked:nth-of-type(5) ~ .slider__inner {
  left: -400%;
}
.slider__inner {
  position: absolute;
  top: 80px;
  left: 0;
  width: 500%;
  height: auto;
  -webkit-transition: left 0.4s;
  transition: left 0.4s;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-flex-flow: row nowrap;
  -ms-flex-flow: row nowrap;
  flex-flow: row nowrap;
}
.slider__contents {
  height: 100%;
  text-align: center;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-flex: 1;
  -webkit-flex: 1;
  -ms-flex: 1;
  flex: 1;
  -webkit-flex-flow: column nowrap;
  -ms-flex-flow: column nowrap;
  flex-flow: column nowrap;
  -webkit-box-align: center;
  -webkit-align-items: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -webkit-justify-content: center;
  -ms-flex-pack: center;
  justify-content: center;
}
.slider__caption {
  font-size: 14px;
  color: #111;
  opacity: .5;
  font-family: 'Roboto';
  font-weight: bold;
}
.slider__txt {
  font-size: 22px;
  font-weight: bold;
  font-family: 'Roboto';
  line-height: 1.7;
  color: #111;
  margin-top: -20px;
  margin-bottom: 20px;
  max-width: 750px;
}
quote {
  font-family: 'Arial';
  font-weight: bold;
  font-size: 100px;
  color: #ec2027;
  margin-bottom: 0;
}

@-webkit-keyframes check {
  50% {
    outline-color: #333;
    box-shadow: 0 0 0 12px #333, 0 0 0 36px rgba(51, 51, 51, 0.2);
  }
  100% {
    outline-color: #333;
    box-shadow: 0 0 0 0 #333, 0 0 0 0 rgba(51, 51, 51, 0);
  }
}

@keyframes check {
  50% {
    outline-color: #333;
    box-shadow: 0 0 0 12px #333, 0 0 0 36px rgba(51, 51, 51, 0.2);
  }
  100% {
    outline-color: #333;
    box-shadow: 0 0 0 0 #333, 0 0 0 0 rgba(51, 51, 51, 0);
  }
}

</style>

    




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
