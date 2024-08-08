<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get booking data from the form
    $checkin = htmlspecialchars($_POST['checkin']);
    $checkout = htmlspecialchars($_POST['checkout']);
    $adults = htmlspecialchars($_POST['adults']);
    $children = htmlspecialchars($_POST['children']);
    $room = htmlspecialchars($_POST['room']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);

    // Validate data (optional, add your own validation rules)
    if (empty($checkin) || empty($checkout) || empty($adults) || empty($room) || empty($email) || empty($phone)) {
        echo "All fields are required.";
        exit;
    }

    // Prepare the email content
    $subject = "New Room Booking Request";
    $message = "
    <html>
    <head>
        <title>Room Booking Request</title>
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
                <h2>New Room Booking Request</h2>
            </div>
            <div class='email-content'>
                <p><strong>Check-in Date:</strong> $checkin</p>
                <p><strong>Check-out Date:</strong> $checkout</p>
                <p><strong>Adults:</strong> $adults</p>
                <p><strong>Children:</strong> $children</p>
                <p><strong>Room Type:</strong> $room</p>
                <hr>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Phone:</strong> $phone</p>
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
