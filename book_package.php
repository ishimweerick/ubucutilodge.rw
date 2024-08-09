<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get booking data from the form
    $package_id = isset($_POST['package_id']) ? htmlspecialchars($_POST['package_id']) : '';
    $price = isset($_POST['price']) ? htmlspecialchars($_POST['price']) : '';
    $package_title = isset($_POST['package_title']) ? htmlspecialchars($_POST['package_title']) : ''; // Get the package title
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $checkin_date = isset($_POST['checkin_date']) ? htmlspecialchars($_POST['checkin_date']) : '';
    $checkout_date = isset($_POST['checkout_date']) ? htmlspecialchars($_POST['checkout_date']) : '';

    // Validate data (optional, add your own validation rules)
    if (empty($package_id) || empty($price) || empty($package_title) || empty($name) || empty($phone) || empty($email) || empty($checkin_date) || empty($checkout_date)) {
        echo "<p style='color: red;'>All fields are required.</p>";
        exit;
    }

    // Prepare the email content
    $subject = "New Booking Request for Room: $package_title";
    $room_link = "https://ubucutilodge.rw/room-details.php?id=$package_id";
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
            .room-link { color: #4CAF50; text-decoration: none; }
        </style>
    </head>
    <body>
        <div class='email-container'>
            <div class='email-header'>
                <h2>New Booking Request</h2>
            </div>
            <div class='email-content'>
                <p><strong>Room:</strong> <a href='$room_link' class='room-link'>$package_title</a></p>
                <p><strong>Room ID:</strong> $package_id</p>
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
        echo "<p style='color: green;'>Booking request sent successfully.</p>";
    } else {
        echo "<p style='color: red;'>Failed to send booking request. Please try again.</p>";
    }
} else {
    echo "<p style='color: red;'>Invalid request method.</p>";
}
?>
