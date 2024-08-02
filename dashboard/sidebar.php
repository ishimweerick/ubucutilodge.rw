<?php
include "../z_db.php";
$username=$_SESSION['username'];
?>
<div class="app-menu navbar-menu">
  <!-- LOGO -->
  <div class="navbar-brand-box">
    <!-- Dark Logo-->
<?php
    $rr=mysqli_query($con,"SELECT ufile FROM logo");
$r = mysqli_fetch_row($rr);
$ufile = $r[0];
?>

    <a href="index.html" class="logo logo-dark">
      <span class="logo-sm">
        <img src="uploads/logo/<?php print $ufile?>" alt="" height="22">
      </span>
      <span class="logo-lg">
        <img src="uploads/logo/<?php print $ufile?>" alt="" height="30">
      </span>
    </a>
    <!-- Light Logo-->
    <a href="index.html" class="logo logo-light">
      <span class="logo-sm">
        <img src="uploads/logo/<?php print $ufile?>" alt="" height="30">
      </span>
      <span class="logo-lg">
        <img src="uploads/logo/<?php print $ufile?>" alt="" height="130">
      </span>
    </a>
    <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
      <i class="ri-record-circle-line"></i>
    </button>
  </div>

  <div id="scrollbar">
    <div class="container-fluid">

      <div id="two-column-menu">
      </div>
      <ul class="navbar-nav" id="navbar-nav">
        <li class="menu-title"><span data-key="t-menu">Menu</span></li>


        <li class="nav-item">
                <a href="dashboard" class="nav-link" data-key="t-analytics">  <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards"> Dashboard </span></a>
              </li>

              <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarpagesection" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarpagesection">
                                <i class="ri-checkbox-multiple-line"></i> <span data-key="t-landing">Page Section</span>
                            </a>
                            <div class="menu-dropdown collapse" id="sidebarpagesection" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="page-home" class="nav-link" data-key="t-one-page"> Home Page </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="page-about" class="nav-link" data-key="t-nft-landing"> About Page </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

              <!-- <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarB" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarLanding">
                                <i class="ri-file-list-3-line"></i> <span data-key="t-landing">Manage Blog</span>
                            </a>
                            <div class="menu-dropdown collapse" id="sidebarB" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="createblog" class="nav-link" data-key="t-one-page"> Add New </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="blog" class="nav-link" data-key="t-nft-landing">Blog lists </a>
                                    </li>
                                </ul>
                            </div>
                        </li> -->

              <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarservice" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarservice">
                                <i class="ri-checkbox-multiple-line"></i> <span data-key="t-landing">Manage Services</span>
                            </a>
                            <div class="menu-dropdown collapse" id="sidebarservice" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="createservice" class="nav-link" data-key="t-one-page"> Add Service </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="services" class="nav-link" data-key="t-nft-landing"> Services List </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebardestination" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebardestination">
                                <i class="ri-checkbox-multiple-line"></i> <span data-key="t-landing">Manage Destinations</span>
                            </a>
                            <div class="menu-dropdown collapse" id="sidebardestination" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="createdestination" class="nav-link" data-key="t-one-page"> Add Destination </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="destinations" class="nav-link" data-key="t-nft-landing"> Destinations List </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarpackage" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarpackage">
                                <i class="ri-checkbox-multiple-line"></i> <span data-key="t-landing">Manage Packages</span>
                            </a>
                            <div class="menu-dropdown collapse" id="sidebarpackage" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="createpackage" class="nav-link" data-key="t-one-page"> Add Package </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="packages" class="nav-link" data-key="t-nft-landing"> Packages List </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="bookings" class="nav-link" data-key="t-nft-landing"> Packages Bookings </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarPot" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarLanding">
                                <i class="ri-rhythm-fill"></i> <span data-key="t-landing">Manage Gallery</span>
                            </a>
                            <div class="menu-dropdown collapse" id="sidebarPot" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="createportfolio" class="nav-link" data-key="t-one-page"> Add New </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="portfolio" class="nav-link" data-key="t-nft-landing"> Portfolio List </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarslider" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarslider">
                                <i class="ri-image-fill"></i> <span data-key="t-landing">Manage Slider</span>
                            </a>
                            <div class="menu-dropdown collapse" id="sidebarslider" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="createslide" class="nav-link" data-key="t-one-page"> Add New </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="slider" class="nav-link" data-key="t-nft-landing"> Sliders List </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="static" class="nav-link" data-key="t-nft-landing"> Static Sliders</a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarpartner" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarpartner">
                                <i class="ri-image-fill"></i> <span data-key="t-landing">Manage Partners</span>
                            </a>
                            <div class="menu-dropdown collapse" id="sidebarpartner" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="createpartner" class="nav-link" data-key="t-one-page"> Add New </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="partners" class="nav-link" data-key="t-nft-landing"> Partner List </a>
                                    </li>
                                  
                                </ul>
                            </div>
                        </li>

                    


                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarsocial" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarsocial">
                                <i class="ri-chrome-fill"></i> <span data-key="t-landing">Manage Social</span>
                            </a>
                            <div class="menu-dropdown collapse" id="sidebarsocial" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="createsocial" class="nav-link" data-key="t-one-page"> Add New </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="social" class="nav-link" data-key="t-nft-landing">Social List </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarteam" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarteam">
                                <i class="ri-group-line"></i> <span data-key="t-landing">Manage Team</span>
                            </a>
                            <div class="menu-dropdown collapse" id="sidebarteam" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="newteam" class="nav-link" data-key="t-one-page">New Team</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="team" class="nav-link" data-key="t-nft-landing"> All Team </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarwhy" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarwhy">
                                <i class="ri-rocket-line"></i> <span data-key="t-landing"> Why Choose Us</span>
                            </a>
                            <div class="menu-dropdown collapse" id="sidebarwhy" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="addwhy" class="nav-link" data-key="t-one-page"> Add New </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="why" class="nav-link" data-key="t-nft-landing"> All lists </a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarK" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarK">
                                <i class="ri-tools-fill"></i> <span data-key="t-landing"> Site Configuration </span>
                            </a>
                            <div class="menu-dropdown collapse" id="sidebarK" style="">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="settings" class="nav-link" data-key="t-one-page"> Site Settings </a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="sections" class="nav-link" data-key="t-nft-landing"> Section Titles </a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a href="logo" class="nav-link" data-key="t-nft-landing"> Update Logo </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="contact" class="nav-link" data-key="t-nft-landing"> Update Contact </a>
                                    </li>
                                </ul>
                            </div>
                        </li>









      </ul>
    </div>
    <!-- Sidebar -->
  </div>

  <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
