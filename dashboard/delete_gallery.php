<?php
include "z_db.php"; // Adjust path as needed

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = mysqli_real_escape_string($con, $_POST['file']);

    // Query to delete the image record from the database
    $sql = "DELETE FROM portfolio WHERE ufile = '$file'";

    if (mysqli_query($con, $sql)) {
        // If the record is deleted from the database, delete the file from the server
        $file_path = "uploads/portfolio/$file";
        if (file_exists($file_path)) {
            if (unlink($file_path)) {
                echo "Success";
            } else {
                echo "Failed to delete file from server.";
            }
        } else {
            echo "File not found.";
        }
    } else {
        echo "Failed to delete record from database: " . mysqli_error($con);
    }
} else {
    echo "Invalid request method.";
}
?>
<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const file = this.getAttribute('data-file');
            if (confirm('Are you sure you want to delete this image?')) {
                fetch('delete_gallery.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        'file': file
                    })
                })
                .then(response => response.text())
                .then(data => {
                    if (data.trim() === 'Success') {
                        location.reload();
                    } else {
                        alert(data); // Display the exact error message from the server
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the image.');
                });
            }
        });
    });
});
</script> -->