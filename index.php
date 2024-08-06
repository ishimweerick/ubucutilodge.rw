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


 
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol viewBox="0 0 43.763 23.214">
            <g id="arrow-left" transform="translate(2.886 2.823)">
                <line id="Line_183" data-name="Line 183" x1="38.495" transform="translate(0.382 8.862)" fill="none"
                    stroke-linecap="round" stroke-miterlimit="10" stroke-width="4" />
                <line id="Line_184" data-name="Line 184" y1="8.205" x2="9.256" transform="translate(0.382 0)"
                    fill="none" stroke-linecap="round" stroke-miterlimit="10" stroke-width="4" />
                <line id="Line_185" data-name="Line 185" x2="10" y2="9" transform="translate(-0.062 8.566)" fill="none"
                    stroke-linecap="round" stroke-miterlimit="10" stroke-width="4" />
            </g>
        </symbol>
        <symbol id="arrow" viewBox="0 0 400.004 400.004" style="enable-background:new 0 0 400.004 400.004;"
            xml:space="preserve">
            <g>
                <path d="M382.688,182.686H59.116l77.209-77.214c6.764-6.76,6.764-17.726,0-24.485c-6.764-6.764-17.73-6.764-24.484,0L5.073,187.757
            c-6.764,6.76-6.764,17.727,0,24.485l106.768,106.775c3.381,3.383,7.812,5.072,12.242,5.072c4.43,0,8.861-1.689,12.242-5.072
            c6.764-6.76,6.764-17.726,0-24.484l-77.209-77.218h323.572c9.562,0,17.316-7.753,17.316-17.315
            C400.004,190.438,392.251,182.686,382.688,182.686z" />
            </g>
        </symbol>
    </svg>

<section class="half-color-box">
        <div class="container spacer por">
            <div class="text-whtie text-center ml-3">
                <h1 class="bold">What Clients Say</h1>
                <p class="lead">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem, at!
                </p>
            </div>
            <div class="test-arrowbox">

                <div class="swiper-button-prev-test">
                    <svg fill="red" height="34" class="arrow left">
                        <use xlink:href="#arrow" />
                    </svg>
                </div>
                <div class="swiper-button-next-test">
                    <div class="arrow-right">
                        <svg fill="red" height="60" width="60" class="arrow">
                            <use xlink:href="#arrow" />
                        </svg>
                    </div>

                </div>
            </div>
            <div class="swiper-container swiper-testimonial">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="review-box">
                            <div class="media">
                                <img class="mr-3" src="https://picsum.photos/50/50" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5>Amanda Jackson</h5>
                                    <p class="user-post">CEO, NRD Group</p>
                                </div>
                            </div>
                            <p class="read">
                                It has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the race.
                            </p>
                            <img class="quote" src="img/icons/quote.svg" alt="">

                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review-box">
                            <div class="media">
                                <img class="mr-3" src="https://picsum.photos/50/50/" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5>Amanda Jackson</h5>
                                    <p class="user-post">CEO, NRD Group</p>
                                </div>
                            </div>
                            <p class="read">
                                It has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the race.
                            </p>
                            <img class="quote" src="img/icons/quote.svg" alt="">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review-box">
                            <div class="media">
                                <img class="mr-3" src="https://picsum.photos/50/50" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5>Amanda Jackson</h5>
                                    <p class="user-post">CEO, NRD Group</p>
                                </div>
                            </div>
                            <p class="read">
                                It has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the race.
                            </p>
                            <img class="quote" src="img/icons/quote.svg" alt="">

                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review-box">
                            <div class="media">
                                <img class="mr-3" src="img/icons/user.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5>Amanda Jackson</h5>
                                    <p class="user-post">CEO, NRD Group</p>
                                </div>
                            </div>
                            <p class="read">
                                It has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the race.
                            </p>
                            <img class="quote" src="img/icons/quote.svg" alt="">
                        </div>
                    </div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>

            </div>
        </div>
    </section>

    <style>
        :root {
  --theme-color: #3950ca;
  --bg-color: rgba(79, 48, 183, 0.06);
  --comp-color: #ff6584;
  --gradient: linear-gradient(#6a5fdd 0%, #241d8c 100%);
}
@import url('https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,900&display=swap');
body {
     font-family: 'Poppins', sans-serif;
  margin:0;
  pading:0
}
.text-center {
  text-align:center;
  
}
h2,h1 {
  margin:0;
  padding-top:30px;
}

.bg-color {
  background: var(--bg-color);
}

.half-color-box {
  background: var(--gradient);
  height: 300px;
  margin-bottom: 100px;
}

.text-whtie {
  color: #fff !important;
}

.bold {
  font-weight: bolder;
}

.por {
  position: relative;
}

.review-box .quote {
  position: absolute;
  width: 40px;
  right: 10px;
  bottom: 10px;
}

.test-arrowbox {
  position: absolute;
  right: 20px;
  display: flex;
  top: 70px;
}

.review-box {
  border-radius: 3px;
  background: #fff;
  box-shadow: 0px 3px 20px rgba(0, 0, 0, 0.1);
  padding: 30px;
}

.review-box h5 {
  margin: 0;
}

.review-box p {
  margin-bottom: 0;
  margin-top: 10px;
  color: #7d8597;
}

.user-post {
  font-size: 14px;
  margin: 0 !important;
 
}

.swiper-testimonial {
  padding: 100px 20px;
  padding-top: 30px;
}

.half-color-box {
  background: var(--gradient);
  height: 300px;
  margin-bottom: 140px;
}

.test-arrowbox .swiper-button-next-test,
.test-arrowbox .swiper-button-prev-test {
  margin-right: 20px;
  /* background: var(--comp-color);2 */
  border-radius: 50%;
  --size: 55px;
  width: var(--size);
  height: var(--size);
  display: flex;
  align-items: center;
  justify-content: center;
}

.arrow-right {
  transform: rotate(180deg);
  margin-top: -8px;
}

.arrow {
  cursor: pointer;
  transition: all 0.2s ease-in;
}

.arrow:hover {
  transform: translateX(-15px);
}
</style>
<script>
    var swiper = new Swiper('.swiper-container.swiper-testimonial', {
    slidesPerView: 3,
    spaceBetween: 30,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next-test',
        prevEl: '.swiper-button-prev-test',
    },
});
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
