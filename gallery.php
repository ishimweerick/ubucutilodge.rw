<?php include "include/header.php";?>
    <!-- Header Banner -->
    <div class="banner-header full-height section-padding valign bg-img bg-fixed" data-overlay-dark="4" data-background="dashboard/uploads/portfolio/5008Radiant_Memory-2388.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center caption">
                    <h5>Ubucuti Lodge</h5>
                    <h1>Gallery</h1>
                </div>
            </div>
        </div>
        <!-- button scroll -->
        <a href="gallery-image.html#" data-scroll-nav="1" class="mouse smoothscroll"> <span class="mouse-icon">
                <span class="mouse-wheel"></span> </span>
        </a>
    </div>
    <!-- Image Gallery -->
    <section class="section-padding" data-scroll-index="1">
        <div class="container">
            <div class="row">
                <!-- 3 columns -->
                <?php
      
      $result = mysqli_query($con,"SELECT * FROM portfolio");
      if (mysqli_num_rows($result) > 0) {
$i=0;
while($row = mysqli_fetch_array($result)) {
  $portfolio="$row[ufile]";
  $destination="$row[destination]";
?>
                <div class="col-md-4 gallery-item">
                    <div class="img-card">
                        <a href="dashboard/uploads/portfolio/<?php echo $portfolio; ?>" title="" class="img-zoom">
                            <div class="img-block">
                                <div class="wrapper-img"> <img src="dashboard/uploads/portfolio/<?php echo $portfolio; ?>" class="img-fluid mx-auto d-block" alt="work-img" width="380px" height="237.33px"> </div>
                               
                            </div>
                        </a>
                    </div>
                </div>
             
                <?php
            $i++;
        }
}
else{
echo '  <div class="col-md-12 gallery-item">
                    <div class="img-card">
                        <h2> No Gallery Found</h2>
                    </div>
                </div>';
}?>
            </div>
        </div>
    </section>
    <?php include "include/footer.php";?>