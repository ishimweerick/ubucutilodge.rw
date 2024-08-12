<?php include "include/header.php";?>
    <!-- Header Banner -->
    <div class="banner-header section-padding valign bg-img bg-fixed bg-position-bottom" data-overlay-dark="4" data-background="dashboard/uploads/about/<?php print $about_banner;?>">
        <div class="container">
            <div class="row">
                <div class="col-md-12 caption text-center">
                    <h1>About Us</h1>
                </div>
            </div>
        </div>
        <!-- button scroll -->
        <a href="about.html#" data-scroll-nav="1" class="mouse smoothscroll"> <span class="mouse-icon">
                <span class="mouse-wheel"></span> </span>
        </a>
    </div>
    <!-- About -->
    <section class="about section-padding" data-scroll-index="1">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="sub-title border-bot-light">Welcome to</div>
                </div>
                <div class="col-md-9">
                    <div class="section-title"><?php print $about_heading;?></div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <p style="text-align:justify"><?php print $about_content;?></p>
                            <!-- Rating -->

                            <div class="col-md-12">
                            <h6>Rates on booking.com</h6>
                            <ul class="list-unstyled page-list mb-30">
                                <li>
                                    <div class="page-list-icon"> <span class="ti-time"></span> </div>
                                    <div class="page-list-text">
                                        <p>Ubucuti Lodge | 9.4</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="page-list-icon"> <span class="ti-time"></span> </div>
                                    <div class="page-list-text">
                                        <p>Lake Kivu Serena | 8.3</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="page-list-icon"> <span class="ti-time"></span> </div>
                                    <div class="page-list-text">
                                        <p>Kivu Peace View Hotel | 8.1</p>
                                    </div>
                                </li>
                            </ul>
                          
                        </div>

                            
                          
                          
                        </div>
                        <div class="col-lg-6 col-md-12">
                        
                                <img class="img-fluid rounded w-full wow zoomIn" data-wow-delay="0.1s" src="dashboard/uploads/about/<?php print $about_image;?>" style="margin-top: 25%;"> 
                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Amenities -->
    <section class="amenities section-padding">
        <div class="container">
            <div class="row mb-30">
                <div class="col-md-3">
                    <div class="sub-title border-bot-light">Our Services</div>
                </div>
                <div class="col-md-9">
                    <div class="section-title">Make Your Stay Memorable</div>
                    <!-- <p>Hotel ut nisl quam nestibulum ac quam nec odio elementum sceisue the aucan ligula. Orci varius natoque penatibus et magnis dis parturient monte nascete ridiculus mus nellentesque habitant morbine.</p> -->
                </div>
            </div>
            <div class="row">
            <?php
      
      $result = mysqli_query($con,"SELECT * FROM destination");
      if (mysqli_num_rows($result) > 0) {
$i=1;
while($row = mysqli_fetch_array($result)) {
?>
                <div class="col-lg-4 col-md-6">
                    <div class="item"> <span class="number"><?php echo $i; ?></span>
                        <div class="icon">
                        <img class="gallery-image" src="dashboard/uploads/destinations/<?php echo $row["destination_image"]; ?>" alt="" style="width:65px">
                        
                    </div>
                        <h5><?php echo $row["destination_title"]; ?></h5>
                        <p><?php echo $row["description"]; ?></p>
                    </div>
                </div>
                <?php
            $i++;
        }
}
else{
echo "No result found";
}?>
             
            </div>
        </div>
    </section>
   
    
    <?php include "include/footer.php";?>