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
    $name = "Ishimwe Eric Clapton"; // or you can retrieve this from form if available
    $address = "Optional Address"; // or you can retrieve this from form if available

    // Validate data (optional, add your own validation rules)
    if (empty($checkin) || empty($checkout) || empty($adults) || empty($room) || empty($email) || empty($phone)) {
        echo "All fields are required.";
        exit;
    }

    // Prepare the email content
    $subject = "New Room Booking Inquiry";
    $message = "
    <html>
    <head>
        <title>Room Booking Inquiry</title>
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
                <h2>Room Booking Inquiry</h2>
            </div>
            <div class='email-content'>
                <p>I hope this message finds you well. I am writing to inquire about the availability of a room at your hotel. I would like to book a room as per the following details:</p>
                <p><strong>Booking Details:</strong></p>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Check-in Date:</strong> $checkin</p>
                <p><strong>Check-out Date:</strong> $checkout</p>
                <p><strong>Room Type:</strong> $room</p>
                <p><strong>Number of Guests:</strong> $adults Adults, $children Children</p>
                <p><strong>Special Requests:</strong></p>
                <p>[e.g., Non-smoking room, late check-in, early check-out, specific bed type, etc.]</p>
                <p>Please let me know if the room is available and the total cost for the stay. Additionally, kindly inform me of any prepayment or deposit requirements.</p>
                <p>I look forward to your confirmation and any further instructions regarding the booking process.</p>
                <p>Thank you for your assistance.</p>
                <p><strong>Best regards,</strong></p>
                <p>$name</p>
                <p><strong>Contact Information:</strong> $email, $phone</p>
                <p><strong>Address:</strong> $address</p>
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
    $to = "ubucuti.lodge@gmail.com";
    if (mail($to, $subject, $message, $headers)) {
        echo "Booking request sent successfully.";
    } else {
        echo "Failed to send booking request. Please try again.";
    }
} else {
    echo "Invalid request method.";
}
?>
