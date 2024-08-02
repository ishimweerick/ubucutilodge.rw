<?php include "include/header.php";?>
    <!-- Header Banner -->
    <div class="banner-header section-padding valign bg-img bg-fixed bg-position-bottom" data-overlay-dark="4" data-background="dashboard/uploads/banner/<?php print $banner_image;?>">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center caption">
                    
                    <h2><?php echo $about_history; ?></h2>
                    
                </div>
            </div>
        </div>
        <!-- button scroll -->
        <a href="post.html#" data-scroll-nav="1" class="mouse smoothscroll"> <span class="mouse-icon">
                <span class="mouse-wheel"></span> </span>
        </a>
    </div>
    <!-- Post -->
    <section class="section-padding" data-scroll-index="1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12"> 
                    <img src="dashboard/uploads/about/<?php echo $history_image; ?>" class="mb-30" alt="">
                
                </div>
                
            </div>
        </div>
    </section>
    <?php include "include/footer.php";?>