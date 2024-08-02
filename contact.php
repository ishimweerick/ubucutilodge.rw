<?php include "include/header.php";?>
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
                                    <h3>Get in touch</h3>
                                    <form method="post" class="contact-form">
    <!-- form message -->
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
        </div>
    </div>
    <!-- form elements -->
    <div class="row">
        <div class="col-md-6 form-group">
            <input name="name" type="text" placeholder="Your Name *" required>
        </div>
        <div class="col-md-6 form-group">
            <input name="email" type="email" placeholder="Your Email *" required>
        </div>
        <div class="col-md-6 form-group">
            <input name="phone" type="text" placeholder="Your Number *" required>
        </div>
        <div class="col-md-6 form-group">
            <input name="subject" type="text" placeholder="Subject *" required>
        </div>
        <div class="col-md-12 form-group">
            <textarea name="message" id="message" cols="30" rows="4" placeholder="Message *" required></textarea>
        </div>
        <div class="col-md-12 mt-10">
            <input type="submit" name="submit" class="butn-dark2" value="Send Message">
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

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Email details
    $to = 'clapton955@gmail.com';
    $email_subject = "Contact Form: $subject";
    $email_body = "You have received a new message from the contact form.\n\n".
                  "Name: $name\n".
                  "Email: $email\n".
                  "Phone: $phone\n".
                  "Subject: $subject\n".
                  "Message:\n$message";

    $headers = "From: $email\n";
    $headers .= "Reply-To: $email";

    // Send email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "<script>alert('Your message was sent successfully.');</script>";
    } else {
        echo "<script>alert('There was an error sending your message. Please try again later.');</script>";
    }
}
?>

    <!-- Map -->
        <section class="map">
            <div class="full-width">
                <iframe src="<?php print $company_officeaddress_map?>" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </section>
        <?php include "include/footer.php";?>