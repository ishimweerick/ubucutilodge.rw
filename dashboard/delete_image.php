<?php
include "z_db.php"; // Replace with your database connection script

if (isset($_GET['delete_image_id'])) {
    $delete_image_id = mysqli_real_escape_string($con, $_GET['delete_image_id']);

    // Fetch the image path
    $query = "SELECT location FROM photo WHERE photoid='$delete_image_id'";
    $result = mysqli_query($con, $query);
    if ($row = mysqli_fetch_array($result)) {
        $image_path = $row['location'];
        
        // Delete the image file from the server
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        // Delete the image record from the database
        mysqli_query($con, "DELETE FROM photo WHERE photoid='$delete_image_id'");
    }


    
    // Redirect with status
    header("Location: editpackages.php?id=" . mysqli_real_escape_string($con, $_GET['package_id']) . "&status=success");
    exit();
}
?>
