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

    <div class="col-md-3">
                        <h3 class="sub-title border-bot-dark">Reviews</h3>
                    </div>




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



                    <div class="container-fluid bg-body-tertiary py-3">
  <div id="testimonialCarousel" class="carousel">
    <div class="carousel-inner">
    <?php
            $result = mysqli_query($con,"SELECT * FROM testimony");
if (mysqli_num_rows($result) > 0) {
    $i=0;
while($row = mysqli_fetch_array($result)) {
?>
      <div class="carousel-item">
        <div class="card shadow-sm rounded-3">
          <div class="quotes display-2 text-body-tertiary">
            <i class="bi bi-quote"></i>
          </div>
          <div class="card-body">
            <p class="card-text"><?php echo $row["message"]; ?></p>
            <div class="d-flex align-items-center pt-2">
              <div>
                <h5 class="card-title fw-bold"><?php echo $row["name"]; ?></h5>
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



                    <div class="col-md-8">
                        <div class="section-title whte">Guest Feedback</div>
                        <div class="testimonials-box">
                        <div class="owl-carousel owl-theme">






                        

    </div>
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
   





    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <section class="testimonial-area">
	<div class="container">
		<div class="sec-title white-title">
			<h2>Testimonials</h2>
			<p>What Client Say About Us?</p>
		</div>
		<div class="testimonial-content owl-carousel">


        <?php
            $result = mysqli_query($con,"SELECT * FROM testimony");
if (mysqli_num_rows($result) > 0) {
    $i=0;
while($row = mysqli_fetch_array($result)) {
?>
			<!-- Single Testimonial -->
			<div class="single-testimonial">
				<div class="round-1 round"></div>
				<div class="round-2 round"></div>
				<p><?php echo $row["message"]; ?><</p>
				<div class="client-info">
					<div class="client-video">
						<a href="#"><img src="https://i.ibb.co/DWhSr6S/play-button2.png" alt=""></a>
					</div>
					<div class="client-details">
						<h6>Yeasin Arafat</h6>
						<span>Designer, LLCG Team</span>
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
			<!-- Single Testimonial -->
			<div class="single-testimonial">
				<div class="round-1 round"></div>
				<div class="round-2 round"></div>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
				<div class="client-info">
					<div class="client-video">
						<a href="#"><img src="https://i.ibb.co/DWhSr6S/play-button2.png" alt=""></a>
					</div>
					<div class="client-details">
						<h6>Yeasin Arafat</h6>
						<span>Designer, LLCG Team</span>
					</div>
				</div>

			</div>
			<!-- Single Testimonial -->
			<div class="single-testimonial">
				<div class="round-1 round"></div>
				<div class="round-2 round"></div>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
				<div class="client-info">
					<div class="client-video">
						<a href="#"><img src="https://i.ibb.co/DWhSr6S/play-button2.png" alt=""></a>
					</div>
					<div class="client-details">
						<h6>Yeasin Arafat</h6>
						<span>Designer, LLCG Team</span>
					</div>
				</div>

			</div>
			<!-- Single Testimonial -->
			<div class="single-testimonial">
				<div class="round-1 round"></div>
				<div class="round-2 round"></div>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
				<div class="client-info">
					<div class="client-video">
						<a href="#"><img src="https://i.ibb.co/DWhSr6S/play-button2.png" alt=""></a>
					</div>
					<div class="client-details">
						<h6>Yeasin Arafat</h6>
						<span>Designer, LLCG Team</span>
					</div>
				</div>

			</div>
			<!-- Single Testimonial -->
			<div class="single-testimonial">
				<div class="round-1 round"></div>
				<div class="round-2 round"></div>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
				<div class="client-info">
					<div class="client-video">
						<a href="#"><img src="https://i.ibb.co/DWhSr6S/play-button2.png" alt=""></a>
					</div>
					<div class="client-details">
						<h6>Yeasin Arafat</h6>
						<span>Designer, LLCG Team</span>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>

<style>
    * {
	margin: 0;
	padding: 0;
}
body {
	font-family: "Montserrat", sans-serif;
}
:root {
	--mon: "Montserrat", sans-serif;
	--blue: #8a6bff;
	--darkblue: #0a0a36;
}
.container {
	max-width: 1140px;
	width: 100%;
	margin: auto;
	padding: 0 15px;
}
.sec-title {
	margin-bottom: 50px;
	padding-bottom: 15px;
	position: relative;
}
.sec-title::after {
	content: "";
	position: absolute;
	left: 0;
	bottom: 0;
	width: 100px;
	height: 3px;
	background: #000;
}
.sec-title h2 {
	font-size: 60px;
	font-family: "Montserrat", sans-serif;
	font-weight: 900;
	letter-spacing: 0px;
	text-transform: uppercase;
	color: var(--blue);
}
.sec-title p {
	font-size: 18px;
	line-height: 28px;
}
.testimonial-area {
	background: var(--blue);
	position: relative;
	z-index: 2;
	padding: 50px 0;
}
.testimonial-area .owl-carousel {
	overflow: hidden;
	padding: 0 20px;
	margin: 0px -40px;
	padding-right: 40px;
}
.testimonial-area .owl-stage-outer {
	padding: 30px 50px;
	margin-left: -34px;
	width: calc(100% + 100px);
}
.single-testimonial {
	border: 7px solid #fff;
	text-align: center;
	border-radius: 45px;
	position: relative;
	z-index: 2;
}
.single-testimonial p {
	color: #fff;
	font-size: 15px;
	line-height: 24px;
	padding: 50px;
	padding-bottom: 30px;
	position: relative;
	z-index: 3;
}
.single-testimonial::before {
	content: "";
	position: absolute;
	left: -35px;
	top: -35px;
	background: url(https://i.ibb.co/nb8Hjms/quote.png) no-repeat var(--blue);
	background-size: 60%;
	width: 126px;
	height: 100px;
	transform: rotate(180deg);
	background-position: 34px 15px;
}
.single-testimonial::after {
	content: "";
	position: absolute;
	right: -35px;
	bottom: -34px;
	background: url(https://i.ibb.co/nb8Hjms/quote.png) no-repeat var(--blue);
	background-size: 60%;
	width: 126px;
	height: 100px;
	background-position: 34px 19px;
}
.round {
	width: 100%;
	height: 100%;
	position: absolute;
	z-index: 1;
}
.round-1::before {
	content: "";
	position: absolute;
	left: 88px;
	top: -7px;
	width: 50px;
	height: 7px;
	background: #fff;
	border-radius: 30px;
}
.round-1::after {
	content: "";
	position: absolute;
	left: -7px;
	top: 62px;
	width: 7px;
	height: 50px;
	background: #fff;
	border-radius: 30px;
}
.round-2::before {
	content: "";
	position: absolute;
	right: 87px;
	bottom: -7px;
	width: 50px;
	height: 7px;
	background: #fff;
	border-radius: 30px;
	z-index: 1;
}
.round-2::after {
	content: "";
	position: absolute;
	right: -7px;
	bottom: 62px;
	width: 7px;
	height: 50px;
	background: #fff;
	border-radius: 30px;
	z-index: 1;
}
.client-video {
	padding-right: 15px;
}
.client-info {
	position: relative;
	z-index: 3;
}
.client-info a {
	width: 40px;
	height: 40px;
	border-radius: 100px;
	display: flex;
	justify-content: center;
	align-items: center;
	box-shadow: 0 0 16px rgba(0, 0, 0, 0.16);
	font-size: 22px;
}
.client-info {
	display: flex;
	align-items: center;
	justify-content: center;
	text-align: left;
	padding-bottom: 50px;
}
.client-info h6 {
	color: #000;
	font-weight: 700;
	font-size: 18px;
	color: #fff;
}
.client-info span {
	display: inline-block;
	color: #fff;
	font-size: 12px;
}
.sec-title.white-title h2 {
	color: #fff;
}
.owl-dots button {
	background: #fff !important;
	width: 10px;
	height: 10px;
	border-radius: 26px;
	margin: 0 5px;
	transition: 0.3s;
}
.owl-dots {
	text-align: center;
	margin-top: 50px;
}
.owl-dots button.active {
	width: 30px;
}
</style>

<script>
    $(".testimonial-content").owlCarousel({
	loop: true,
	items: 2,
	margin: 50,
	dots: true,
	nav: false,
	mouseDrag: true,
	autoplay: false,
	autoplayTimeout: 4000,
	smartSpeed: 800
});

</script>









    <?php include "include/footer.php";?>
