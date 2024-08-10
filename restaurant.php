<?php include "include/header.php"; ?>
    <!-- Slider -->
    <header class="header slider">
        <div class="owl-carousel owl-theme">
            <!-- The opacity on the image is made with "data-overlay-dark="number". You can change it using the numbers 0-9. -->
            <div class="text-center item bg-img" data-overlay-dark="4" data-background="img/restaurant/jocks_74.jpg"></div>
        </div>
        <!-- button scroll -->
        <a href="restaurant.html#" data-scroll-nav="1" class="mouse smoothscroll"> <span class="mouse-icon">
                <span class="mouse-wheel"></span> </span>
        </a>
    </header>
    <!-- Content -->
    <section class="restaurant-page section-padding" data-scroll-index="1">
        <div class="container">
            <div class="row mb-30">
                <div class="col-md-3">
                    <div class="sub-title border-bot-light">Sunday Brunch</div>
                </div>
                <div class="col-md-9">
                    <div class="section-title">Make it a long weekend focused, solely on you and your loved one.</div>
                    <div class="butn-dark"> <a href="post.html"><span>Book Now</span></a> </div><br>

                    
                </div>
            </div>
        </div>
    </section>
    <!-- Restaurant Menu -->
    <section class="section-padding menu faq-1 bg-blck">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h3 class="sub-title border-bot-dark">Our Menu</h3>
                </div>
                <div class="col-md-9">
                   
                    <div class="row menu-book">
                        <div class="col-md-12">
                        <?php

// Fetch data from the restaurant table and group by category
$sql = "SELECT id, title, description, price, category FROM restaurant ORDER BY category DESC";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $currentCategory = "";
    echo '<ul  class="accordion-menu clearfix">';

    while ($row = $result->fetch_assoc()) {
        if ($currentCategory != $row['category']) {
            if ($currentCategory != "") {
                echo '</div></div></div></li>';
            }
            $currentCategory = $row['category'];
            echo '<li class="accordion block">';
            echo '<div class="acc-btn">' . htmlspecialchars($currentCategory) . '</div>';
            echo '<div class="acc-content"><div class="content"><div class="row">';
        }

        echo '<div class="col-lg-12 col-md-12">';
        echo '<div class="menu-list mb-30">';
        echo '<div class="item">';
        echo '<div class="flex">';
        echo '<div class="title">' . ucwords(htmlspecialchars($row['title'])) . '</div>';
        echo '<div class="dots"></div>';
        echo '<div class="price">' . number_format($row['price'], 0) . ' RWF</div>';
        echo '</div>';
        echo '<p><i>' . htmlspecialchars($row['description']) . '</i></p>';
        echo '</div></div></div>';
    }
    echo '</div></div></div></li>';
    echo '</ul>';
} else {
    echo "No menu items found.";
}

?>


                  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php include "include/footer.php"; ?>