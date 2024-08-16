<!DOCTYPE html>
<html lang="eng">
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "z_db.php";
header('Content-Type: text/html; charset=utf-8');
    $rrs=mysqli_query($con,"SELECT * FROM section_title Where id=1");
$rs = mysqli_fetch_array($rrs);
$test_title = "$rs[test_title]";
$test_text="$rs[test_text]";
$home_title = "$rs[home_title]";
$home_text="$rs[home_text]";
$enquiry_title="$rs[enquiry_title]";
$enquiry_text="$rs[enquiry_text]";
$enquiry_text="$rs[enquiry_text]";
$contact_title="$rs[contact_title]";
$contact_text="$rs[contact_text]";
$port_title="$rs[port_title]";
$port_text="$rs[port_text]";
$service_title="$rs[service_title]";
$service_text="$rs[service_text]";
$why_title="$rs[why_title]";
$why_text="$rs[why_text]";
$about_title="$rs[about_title]";
$about_text="$rs[about_text]";
$statistics_title="$rs[statistics_title]";
$statistics_text="$rs[statistics_text]";

    $rt=mysqli_query($con,"SELECT * FROM sitecontact where id=1");
    $tr = mysqli_fetch_array($rt);
    $company_officeatel = "$tr[company_officeatel]";
    $company_officemob = "$tr[company_officemob]";
    $titleone = "$tr[titleone]";
    $titletwo = "$tr[titletwo]";
    $titlethree = "$tr[titlethree]";
    $company_email = "$tr[company_email]";
    $company_website = "$tr[company_website]";
    $company_officeaddress = "$tr[company_officeaddress]";
    $company_officeaddress_map = "$tr[company_officeaddress_map]";
    
?>
<?php
$date_in = isset($_POST['date_in']) ? $_POST['date_in'] : date('Y-m-d');
$date_out = isset($_POST['date_out']) ? $_POST['date_out'] : date('Y-m-d',strtotime(date('Y-m-d').' + 3 days'));
?>

<?php
					 $query="SELECT * FROM about_section WHERE id=1";


 $result = mysqli_query($con,$query);
$i=0;
while($row = mysqli_fetch_array($result))
{
	$about_heading="$row[about_heading]";
    $about_content="$row[about_content]";
    $about_history="$row[about_history]";
    $history="$row[history]";
    $vision="$row[vision]";
  $mission="$row[mission]";
  $about_image="$row[about_image]";
  $history_image="$row[history_image]";
  $about_banner="$row[about_banner]";
}
  ?>
<?php
    $rr=mysqli_query($con,"SELECT * FROM siteconfig where id=1");
    $r = mysqli_fetch_array($rr);
    $site_title = "$r[site_title]";
    $site_about = "$r[site_about]";
    $site_footer = "$r[site_footer]";
    $follow_text = "$r[follow_text]";
    $banner_image = "$r[image]";
    $site_desc = "$r[site_desc]";
?>
                      <?php
    $rt=mysqli_query($con,"SELECT * FROM logo where id=1");
    $tr = mysqli_fetch_array($rt);
    $ufilelogo = "$tr[ufile]";
    $xfile = "$tr[xfile]";
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title><?php print $site_title ?></title>
    <link rel="shortcut icon" href="img/favicon.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Caslon+Display&family=Outfit:wght@300;400&display=swap">
    <link rel="stylesheet" href="css/plugins.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>


<embed src="https://www.ubucutilodge.rw/jazzsong_music.mp3" loop="true" autostart="true" width="2" style="    display: none;"
height="0">



<body>
    <!-- Preloader -->
    <div class="preloader-bg"></div>
    <div id="preloader">
        <div id="preloader-status">
            <div class="preloader-position loader"> <span></span> </div>
        </div>
    </div>
    <!-- Progress scroll totop -->
    <div class="progress-wrap cursor-pointer">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <div class="logo-wrapper">
                <a class="logo" href="index.php"> <img src="dashboard/uploads/logo/<?php print $xfile?>" class="logo-img" alt=""> </a>
            </div>
            <!-- Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"><i class="ti-menu"></i></span> </button>
            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav ms-auto">
                    
                  
                    <li class="nav-item"><a class="nav-link" href="home">Home</a></li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="about" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">About Us <i class="ti-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="our-team" class="dropdown-item"><span>Our Team</span></a></li>
                            <li><a href="restaurant" class="dropdown-item"><span>Our Menu</span></a></li>
                        </ul>
                    </li>




                   
                        <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="about" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Services <i class="ti-angle-down"></i></a>
                    <ul class="dropdown-menu">
                       
                            <li lass="dropdown-item" style="color:#000"><a href="wellness">Wellness</a></li>
                            <li lass="dropdown-item" style="color:#000"><a href="#">Laundry service</a></li>
                            <li lass="dropdown-item"><a href="amenities">Our Amenities</a></li>
                            <li class="nav-item dropdown"> <a class="dropdown-toggle" href="index.html#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Promotions <i class="ti-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="valentine" class="dropdown-item"><span>Valentine</span></a></li>
                            <li><a href="eastern" class="dropdown-item"><span>Eastern</span></a></li>
                            <li><a href="mothersday" class="dropdown-item"><span>Mothers Day</span></a></li>
                            <li><a href="fathersday" class="dropdown-item"><span>Fathers Day</span></a></li>
                          
                        </ul>
                    </li>
                        </ul></li>
                    <li class="nav-item"><a class="nav-link" href="accomodation">Rooms</a></li>
                    
                    <li class="nav-item"><a class="nav-link" href="gallery">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
   