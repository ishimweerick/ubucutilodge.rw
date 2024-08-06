<?php
include "z_db.php"; // Adjust path as needed

// Fetch images from database
$result = mysqli_query($con, "SELECT * FROM portfolio");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Gallery</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your CSS file -->
    <script src="script.js" defer></script> <!-- Add your JavaScript file -->
</head>
<body>
    <?php include "include/header.php"; ?>
    <!-- Header Banner -->
    <div class="banner-header full-height section-padding valign bg-img bg-fixed" data-overlay-dark="4" data-background="img/slider/17.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center caption">
                    <h5>Hotel Gallery</h5>
                    <h1>Image Gallery</h1>
                </div>
            </div>
        </div>
        <!-- button scroll -->
        <a href="#gallery" data-scroll-nav="1" class="mouse smoothscroll"> <span class="mouse-icon">
                <span class="mouse-wheel"></span> </span>
        </a>
    </div>

    <!-- Image Upload Form -->
    <section class="section-padding" data-scroll-index="0">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>Upload New Images</h2>
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="images[]" multiple required>
                        <input type="submit" value="Upload Images" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Image Gallery -->
    <section class="section-padding" data-scroll-index="1" id="gallery">
        <div class="container">
            <div class="row">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $portfolio = $row['ufile'];
                        ?>
                        <div class="col-md-4 gallery-item">
                            <div class="img-card">
                                <a href="dashboard/uploads/portfolio/<?php echo $portfolio; ?>" title="" class="img-zoom">
                                    <div class="img-block">
                                        <div class="wrapper-img">
                                            <img src="dashboard/uploads/portfolio/<?php echo $portfolio; ?>" class="img-fluid mx-auto d-block" alt="work-img" width="380px" height="237.33px">
                                        </div>
                                    </div>
                                </a>
                                <button class="btn btn-danger btn-sm delete-btn" data-file="<?php echo $portfolio; ?>">Delete</button>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "No result found";
                }
                ?>
            </div>
        </div>
    </section>

    <?php include "include/footer.php"; ?>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const file = this.getAttribute('data-file');
            if (confirm('Are you sure you want to delete this image?')) {
                fetch('delete.php', {
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
                    if (data === 'Success') {
                        location.reload();
                    } else {
                        alert('Failed to delete image.');
                    }
                });
            }
        });
    });
});

    </script>

    <style>
        /* Example CSS - customize as needed */
body {
    font-family: Arial, sans-serif;
}

.banner-header {
    /* Your styles for the header */
}

.section-padding {
    padding: 60px 0;
}

.gallery-item {
    margin-bottom: 30px;
}

.img-card {
    position: relative;
    overflow: hidden;
}

.img-zoom {
    display: block;
}

.delete-btn {
    position: absolute;
    top: 10px;
    right: 10px;
}
</style>