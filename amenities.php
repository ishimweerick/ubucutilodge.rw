<?php include "include/header.php"; ?>
<!-- Header Banner -->
<div class="banner-header section-padding valign bg-img bg-fixed bg-position-bottom" data-overlay-dark="5" data-background="dashboard/uploads/banner/<?php print $banner_image;?>">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center caption">
                <h1>Amenities                </h1>
            </div>
        </div>
    </div>
    <!-- button scroll -->
    <a href="rooms.html#" data-scroll-nav="1" class="mouse smoothscroll"> <span class="mouse-icon">
            <span class="mouse-wheel"></span> </span>
    </a>
</div>



<!-- Services -->
    




<section class="service4 section-padding" data-scroll-index="1">
        <div class="container">
            <div class="row">

            <?php
      
      $result = mysqli_query($con,"SELECT * FROM `service` ORDER BY `service`.`id` DESC");
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


<?php include "include/footer.php"; ?>