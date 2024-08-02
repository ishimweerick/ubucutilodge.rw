<?php include "include/header.php";?>
    <!-- Room Page Slider -->
    <header class="header slider">
        <div class="owl-carousel owl-theme">
        <?php
            $portfolio_query = mysqli_query($con, "SELECT * FROM `partner`");
            $active = true;
            $hasImages = false;
            while ($portfolio_row = mysqli_fetch_array($portfolio_query)) {
                $location = $portfolio_row['ufile'];
                $hasImages = true;
        ?>
            <!-- The opacity on the image is made with "data-overlay-dark="number". You can change it using the numbers 0-9. -->
            <div class="text-center item bg-img" data-overlay-dark="5" data-background="dashboard/uploads/partner/<?php echo $location; ?>"></div>
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
     <!-- Faqs -->
     <section class="section-padding">
        <div class="container">
            <div class="row mb-30">
                <div class="col-md-3">
                    <div class="sub-title border-bot-light">Wellness</div>
                </div>
                <div class="col-md-9">
                    <p><?php echo $site_desc; ?></p>
                    <ul class="accordion-box clearfix">
                       
                    <?php
      
      $result = mysqli_query($con,"SELECT * FROM `why_us` ORDER BY `why_us`.`id` DESC");
      if (mysqli_num_rows($result) > 0) {
$i=0;
while($row = mysqli_fetch_array($result)) {
  $title="$row[title]";
  $detail="$row[detail]";
?>
                    <li class="accordion block">
                            <div class="acc-btn"><?php echo $title?></div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text"><?php echo $detail?></div>
                                </div>
                            </div>
                        </li>
                        <?php
            $i++;
        }
}
else{
echo "No result found";
}?>  
                        
                        
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <?php include "include/footer.php";?>