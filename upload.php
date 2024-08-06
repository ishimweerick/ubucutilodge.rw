<?php
include "z_db.php"; // Adjust path as needed

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['images'])) {
        $files = $_FILES['images'];

        for ($i = 0; $i < count($files['name']); $i++) {
            $file_name = $files['name'][$i];
            $file_tmp = $files['tmp_name'][$i];
            $file_size = $files['size'][$i];
            $file_error = $files['error'][$i];
            $file_type = $files['type'][$i];

            if ($file_error === 0) {
                if ($file_size <= 5000000) { // 5MB limit
                    $file_ext = explode('.', $file_name);
                    $file_actual_ext = strtolower(end($file_ext));
                    $allowed = array('jpg', 'jpeg', 'png');

                    if (in_array($file_actual_ext, $allowed)) {
                        $file_name_new = uniqid('', true) . "." . $file_actual_ext;
                        $file_destination = 'dashboard/uploads/portfolio/' . $file_name_new;

                        if (move_uploaded_file($file_tmp, $file_destination)) {
                            $sql = "INSERT INTO portfolio (ufile) VALUES ('$file_name_new')";
                            mysqli_query($con, $sql);
                        } else {
                            echo "Failed to upload file.";
                        }
                    } else {
                        echo "Invalid file type.";
                    }
                } else {
                    echo "File size too big.";
                }
            } else {
                echo "Error uploading file.";
            }
        }
    }
}
header("Location: gallery.php"); // Redirect back to the gallery page
?>
