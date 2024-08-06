<?php
include "z_db.php"; // Adjust path as needed

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = $_POST['file'];

    // Delete from database
    $sql = "DELETE FROM portfolio WHERE ufile = '$file'";
    if (mysqli_query($con, $sql)) {
        // Delete from server
        $file_path = 'dashboard/uploads/portfolio/' . $file;
        if (file_exists($file_path)) {
            unlink($file_path);
            echo 'Success';
        } else {
            echo 'File not found';
        }
    } else {
        echo 'Error deleting from database';
    }
}
?>
