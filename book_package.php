<?php
include "z_db.php"; // Ensure this file connects to your database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $checkin_date = mysqli_real_escape_string($con, $_POST['checkin_date']);
    $checkout_date = mysqli_real_escape_string($con, $_POST['checkout_date']);
    $package_id = mysqli_real_escape_string($con, $_POST['package_id']);
    $created_at = date('Y-m-d H:i:s');

    $sql = "INSERT INTO bookings (name, phone, email, checkin_date, checkout_date, package_id, created_at) 
            VALUES ('$name', '$phone', '$email', '$checkin_date', '$checkout_date', '$package_id', '$created_at')";

    if (mysqli_query($con, $sql)) {
        echo "Booking successful!";
        // Optionally, redirect to a success page or display a success message
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
}
?>
<?php
include "include/db_connect.php"; // Ensure this file connects to your database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $checkin_date = mysqli_real_escape_string($con, $_POST['checkin_date']);
    $checkout_date = mysqli_real_escape_string($con, $_POST['checkout_date']);
    $package_id = mysqli_real_escape_string($con, $_POST['package_id']);
    $created_at = date('Y-m-d H:i:s');

    $sql = "INSERT INTO bookings (name, phone, email, checkin_date, checkout_date, package_id, created_at) 
            VALUES ('$name', '$phone', '$email', '$checkin_date', '$checkout_date', '$package_id', '$created_at')";

    if (mysqli_query($con, $sql)) {
        echo "Booking successful!";
        // Optionally, redirect to a success page or display a success message
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
}
?>
