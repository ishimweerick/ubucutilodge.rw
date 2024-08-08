<?php include "include/header.php";?>

<?php
// Initialize variables
$status = "OK";
$msg = "";

// Check if form is submitted
if(ISSET($_POST['save'])){
    // Sanitize input data
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $message = mysqli_real_escape_string($con, $_POST['message']);

    // Validate input data
    if (strlen($name) < 5) {
        $msg .= "Name Must Be More Than 5 Char Length.<br>";
        $status = "NOTOK";
    }
    if (strlen($email) < 9) {
        $msg .= "Email Must Be More Than 10 Char Length.<br>";
        $status = "NOTOK";
    }
    if (strlen($message) < 10) {
        $msg .= "Message Must Be More Than 10 Char Length.<br>";
        $status = "NOTOK";
    }
    if (strlen($phone) < 8) {
        $msg .= "Phone Must Be More Than 8 Char Length.<br>";
        $status = "NOTOK";
    }

    // If validation passes, send the email
    if ($status == "OK") {
        $recipient = "clapton955@gmail.com";
        $subject = "New Enquiry from ".$name;
        
        // Email content with HTML and CSS
        $formcontent = "
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    color: #333333;
                }
                .container {
                    padding: 20px;
                    border: 1px solid #e2e2e2;
                    border-radius: 5px;
                    max-width: 600px;
                    margin: 0 auto;
                    background-color: #f9f9f9;
                }
                .header {
                    background-color: #aa8454;
                    color: white;
                    padding: 10px;
                    border-radius: 5px 5px 0 0;
                }
                .content {
                    padding: 20px;
                }
                .footer {
                    background-color: #aa8454;
                    color: white;
                    padding: 10px;
                    border-radius: 0 0 5px 5px;
                    text-align: center;
                }
                h2 {
                    margin-top: 0;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>New Enquiry from Ubucuti Lodge Website</h2>
                </div>
                <div class='content'>
                    <p>$name<br>$email<br>$phone</p>
                    <br>
                    <p>$message</p>
                </div>
                <div class='footer'>
                    <p>&copy; 2024 Ubucuti Lodge</p>
                </div>
            </div>
        </body>
        </html>";

        // Headers for HTML email
        $mailheader = "From: $email\r\n";
        $mailheader .= "Reply-To: $email\r\n";
        $mailheader .= "Content-Type: text/html; charset=UTF-8\r\n";

        // Send the email
        $result = mail($recipient, $subject, $formcontent, $mailheader);

        // Display success or error message
        if ($result) {
            $errormsg = "
                <div class='alert alert-success alert-dismissible alert-outline fade show'>
                    Enquiry Sent Successfully. We shall get back to you ASAP.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        } else {
            $errormsg = "
                <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                    Some Technical Glitch Is There. Please Try Again Later Or Ask Admin For Help.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
    } else {
        // Display validation error messages
        $errormsg = "
            <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                $msg
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }
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
    <a href="contact.html#" data-scroll-nav="1" class="mouse smoothscroll">
        <span class="mouse-icon">
            <span class="mouse-wheel"></span>
        </span>
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
                                <p>Reservation</p>
                                <a href="tel:<?php print $company_officeatel?>"><?php print $company_officeatel?><br><?php print $company_officemob?></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="reservations mb-15">
                            <div class="icon"><span class="flaticon-envelope"></span></div>
                            <div class="text">
                                <p>Email Info</p>
                                <a href="mailto:<?php print $company_email?>"><?php print $company_email?><br><?php print $company_website?></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="reservations mb-15">
                            <div class="icon"><span class="flaticon-location-pin"></span></div>
                            <div class="text">
                                <p>Address</p>
                                <?php print $company_officeaddress?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Get in touch</h3>
                                <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    print $errormsg;
                                }
                                ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <!-- form message -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="alert alert-success contact__msg" style="display: none" role="alert">Your message was sent successfully.</div>
                                        </div>
                                    </div>
                                    <!-- form elements -->
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <input id="name" name="name" type="text" placeholder="Your Name *" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <input id="email" name="email" type="email" placeholder="Your Email *" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <input id="phone" name="phone" type="text" placeholder="Your Number *" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <input id="subject" name="subject" type="text" placeholder="Subject *" required>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <textarea name="message" id="message" cols="30" rows="4" placeholder="Write something.." required></textarea>
                                        </div>
                                        <div class="col-md-12 mt-10">
                                            <button type="submit" class="butn-dark2" name="save"><span class="text-white pr-3"><i class="fas fa-paper-plane"></i></span>Send Message -></button>
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
<section class="map">
    <div class="full-width">
        <iframe src="<?php print $company_officeaddress_map?>" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</section>

<?php include "include/footer.php";?>
