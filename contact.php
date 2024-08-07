<?php include "include/header.php";

if (! empty($_POST["send"])) {
    $name = $_POST["userName"];
    $email = $_POST["userEmail"];
    $subject = $_POST["subject"];
    $content = $_POST["content"];
    $stmt = $con->prepare("INSERT INTO tblcontact (user_name, user_email, subject,content) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $content);

    $stmt->execute();
    $message = "Your contact information is saved successfully.";
    $type = "success";
    $stmt->close();
}
             ?>


    <!-- Header Banner -->
    <div class="banner-header section-padding valign bg-img bg-fixed bg-position-bottom" data-overlay-dark="5" data-background="dashboard/uploads/about/<?php print $about_banner;?>">
        <div class="container">
            <div class="row">
                <div class="col-md-12 caption text-center">
                    <h4>Get in touch</h4>
                    <h1>Contact Us</h1>
                </div>
            </div>
        </div>
        <!-- button scroll -->
        <a href="contact.html#" data-scroll-nav="1" class="mouse smoothscroll"> <span class="mouse-icon">
                <span class="mouse-wheel"></span> </span>
        </a>
    </div>
    <!-- Contact -->
    <section class="contact section-padding" data-scroll-index="1">
        <div class="container">
            <div class="row mb-30">
                <div class="col-md-3">
                    <div class="sub-title border-bot-light">Location</div>
                </div>
                <div class="col-md-9">
                    <div class="section-title">Contact Us</div>
                    <div class="row mb-30">
                                <div class="col-lg-4 col-md-12">
                                    <div class="reservations mb-15">
                                        <div class="icon"><span class="flaticon-call"></span></div>
                                        <div class="text">
                                            <p>Reservation</p> <a href="tel:<?php print $company_officeatel?>"><?php print $company_officeatel?><br><?php print $company_officemob?></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="reservations mb-15">
                                        <div class="icon"><span class="flaticon-envelope"></span></div>
                                        <div class="text">
                                            <p>Email Info</p> <a href="mailto:<?php print $company_email?>"><?php print $company_email?><br><?php print $company_website?></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="reservations mb-15">
                                        <div class="icon"><span class="flaticon-location-pin"></span></div>
                                        <div class="text">
                                            <p>Address</p> <?php print $company_officeaddress?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Get in touch</h3><?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
						{
						print $errormsg;
						}
   ?>

                                    <form name="frmContact" id="" frmContact="" method="post"
            action="" enctype="multipart/form-data"
            onsubmit="return validateContactForm()">
                                    <!-- form message -->
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                                            </div>
                                        </div>
                                        <!-- form elements -->
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <input id="userName" name="userName" type="text" placeholder="Your Name *" required>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <input id="userEmail" name="userEmail" type="email" placeholder="Your Email *" required>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <input id="subject" name="subject" type="text" placeholder="Subject *" required>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <textarea name="content" id="content" cols="30" rows="4" placeholder="Write something.." required></textarea>
                                            </div>
                                            <div class="col-md-12 mt-10">
                                            <input type="submit" name="send"  class="butn-dark2"
                                            value="Send Message ->" />
                                            </div>




                                            <div id="statusMessage"> 
                        <?php
                        if (! empty($message)) {
                            ?>
                            <p class='<?php echo $type; ?>Message'><?php echo $message; ?></p>
                        <?php
                        }
                        ?>
                    </div>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Map -->



    <script src="https://code.jquery.com/jquery-2.1.1.min.js"
        type="text/javascript"></script>
    <script type="text/javascript">
        function validateContactForm() {
            var valid = true;

            $(".info").html("");
            $(".input-field").css('border', '#e0dfdf 1px solid');
            var userName = $("#userName").val();
            var userEmail = $("#userEmail").val();
            var subject = $("#subject").val();
            var content = $("#content").val();
            
            if (userName == "") {
                $("#userName-info").html("Required.");
                $("#userName").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (userEmail == "") {
                $("#userEmail-info").html("Required.");
                $("#userEmail").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (!userEmail.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/))
            {
                $("#userEmail-info").html("Invalid Email Address.");
                $("#userEmail").css('border', '#e66262 1px solid');
                valid = false;
            }

            if (subject == "") {
                $("#subject-info").html("Required.");
                $("#subject").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (content == "") {
                $("#userMessage-info").html("Required.");
                $("#content").css('border', '#e66262 1px solid');
                valid = false;
            }
            return valid;
        }
</script>




        <section class="map">
            <div class="full-width">
                <iframe src="<?php print $company_officeaddress_map?>" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </section>
        <?php include "include/footer.php";?>