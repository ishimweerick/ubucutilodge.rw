<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get booking data from the form
    $package_id = htmlspecialchars($_POST['package_id']);
    $price = htmlspecialchars($_POST['price']);
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $checkin_date = htmlspecialchars($_POST['checkin_date']);
    $checkout_date = htmlspecialchars($_POST['checkout_date']);

    // Validate data (optional, add your own validation rules)
    if (empty($package_id) || empty($price) || empty($name) || empty($phone) || empty($email) || empty($checkin_date) || empty($checkout_date)) {
        echo "All fields are required.";
        exit;
    }

    // Prepare the email content
    $subject = "New Booking Request";
    $message = "
    <html>
    <head>
        <title>Booking Request</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; }
            .email-container { width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; background-color: #f9f9f9; }
            .email-header { background-color: #4CAF50; padding: 10px; color: white; text-align: center; }
            .email-content { padding: 20px; }
            .email-footer { text-align: center; padding: 10px; color: #777; font-size: 12px; }
        </style>
    </head>
    <body>
        <div class='email-container'>
            <div class='email-header'>
                <h2>New Booking Request</h2>
            </div>
            <div class='email-content'>
                <p><strong>Package ID:</strong> $package_id</p>
                <p><strong>Price:</strong> $$price</p>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Phone:</strong> $phone</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Check-in Date:</strong> $checkin_date</p>
                <p><strong>Check-out Date:</strong> $checkout_date</p>
            </div>
            <div class='email-footer'>
                <p>This is an automated message from the booking system.</p>
            </div>
        </div>
    </body>
    </html>
    ";

    // Set email headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: <$email>" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";

    // Send email
    $to = "clapton955@gmail.com";
    if (mail($to, $subject, $message, $headers)) {
        echo "Booking request sent successfully.";
    } else {
        echo "Failed to send booking request. Please try again.";
    }
} else {
    echo "Invalid request method.";
}
?>
