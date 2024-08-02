 <!-- Footer -->
 <footer class="footer">
        <div class="top">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 mb-30">
                        <div class="sub-title border-footer-light whte">Contact Us!</div>
                    </div>
                    <div class="col-md-4 offset-md-1">
                        <div class="item">
                            <h3>Get in touch</h3>
                            <p><?php print $company_officeaddress?>
                            </p>
                            <p class="phone"><?php print $company_officeatel?></p>
                            <p class="mail"><?php print $company_email?></p>
                            <div class="social mt-2"> 
                            <?php
    $social_query = mysqli_query($con, "SELECT `id`, `name`, `fa`, `social_link` FROM `social`");
    while ($social_row = mysqli_fetch_array($social_query)) {
        $social_name = $social_row['name'];
        $social_fa = $social_row['fa'];
        $social_link = $social_row['social_link'];
    ?>
 
        <a href="<?php echo $social_link; ?>" target="_blank">
            <i class="<?php echo $social_fa; ?>" aria-hidden="true"></i>
        </a>

    <?php } ?>
                               
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="item">
                            <h3>Rooms & Suites</h3>
                            <ul class="footer-explore-list list-unstyled">
                            <?php
      
      $result = mysqli_query($con,"SELECT * FROM `packages` ORDER BY `packages`.`id` DESC");
      if (mysqli_num_rows($result) > 0) {
$i=0;
while($row = mysqli_fetch_array($result)) {
  $title="$row[package_title]";
  $id="$row[id]";
?>
                                <li><a href="room-details.php?id=<?php echo $row["id"]; ?>"><?php echo $title?></a></li>
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
            </div>
        </div>
        <div class="bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <p>&copy; <?php echo date("Y")." - ".$site_footer." Designed and Developed by " ?><a href="https://www.ikonmind.rw">Ikonmind.rw</a></p>
                    </div>
                    <div class="col-lg-8 col-md-6">
                        <!-- <p class="right"><a href="index.html#">Terms &amp; Conditions</a></p> -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- jQuery -->
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.min.js"></script>
    <script src="js/modernizr-2.6.2.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/jquery.isotope.v3.0.2.js"></script>
    <script src="js/pace.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scrollIt.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.magnific-popup.js"></script>
    <script src="js/YouTubePopUp.js"></script>
    <script src="js/select2.js"></script>
    <script src="js/datepicker.js"></script>
    <script src="js/smooth-scroll.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>