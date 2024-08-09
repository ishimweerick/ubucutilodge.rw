<?php
//get data from form  
$name = $_POST['name'];
$email= $_POST['email'];
$phone= $_POST['phone'];
$message= $_POST['message'];
$to = "ubucuti.lodge@gmail.com";
$subject = "Mail From Ubucuti Lodge website";
$txt ="Name = ". $name . "\r\n  Email = " . $email . "\r\n Phone = " . $phone . "\r\n  \r\n subject = " . $subject . "\r\n Message =" . $message;
$headers = "From: ubucuti.lodge@gmail.com";
if($email!=NULL){
    mail($to,$subject,$txt,$headers);
}
//redirect
header("Location:thankyou.html");
?>