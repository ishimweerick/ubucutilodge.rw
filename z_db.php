<?php
$con = new mysqli("localhost", "lodgeuser", "1UEO^p}XO)Qn", "ubucuti_lodgedb");
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

//Your Website URL Goes Here
$url="https://ubucutilodge.rw/";


//Set Blog Activation Bonus Here (It must be only Number)
$blog_bonus ="10";
//Set Article Activation Bonus Here (It must be only Number)
$art_bonus="10";
//Set Daily Login Bonus Here (It must be only Number)
$login_bonus="10";
//Set Currency Symbol for daily login bonus Here
$money="RWF";
?>
