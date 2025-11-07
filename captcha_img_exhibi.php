<?php
session_start(); 
$ranStr=$_SESSION['vercode_ex'];
$newImage = imagecreatefromjpeg("cap_bg.jpg");
$txtColor = imagecolorallocate($newImage, 0, 0, 0);
imagestring($newImage, 5, 5, 5, $ranStr, $txtColor);
header("Content-type: image/jpeg");
imagejpeg($newImage);
?>
  