<?php 
	session_start();
	$text = $_SESSION['vercode_enq'];
	$height = 25;
	$width = 65;   
	 
	$image_p = imagecreate($width, $height); 
	$black = imagecolorallocate($image_p, 100, 100, 100); 
	$white = imagecolorallocate($image_p, 255, 255, 255); 
	$font_size = 14; 
	
	imagestring($image_p, $font_size, 5, 5, $text, $white); 
	imagejpeg($image_p, null, 80);	
?>