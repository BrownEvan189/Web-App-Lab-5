<?php 
session_start(); 
$possible_captcha_letters = 'bcdfghjkmnpqrstvwxyz23456789';
$total_characters_on_image = 6;
$text = ''; 
$_SESSION["vercode"] = $text; 
$height = 25; 
$width = 65; 

$count = 0;
while ($count < $total_characters_on_image) { 
$text .= substr(
	$possible_captcha_letters,
	mt_rand(0, strlen($possible_captcha_letters)-1),
	1);
$count++;
}

$image_p = imagecreate($width, $height); 
$black = imagecolorallocate($image_p, 0, 0, 0); 
$white = imagecolorallocate($image_p, 255, 255, 255); 
$font_size = 14; 

$random_captcha_lines = 3;

for( $count=0; $count<$random_captcha_lines; $count++ ) {
imageline(
	$image_p,
	mt_rand(0,$width),
	mt_rand(0,$height),
	mt_rand(0,$width),
	mt_rand(0,$height),
	$white
	);
}

$_SESSION['captcha'] = $text;
imagestring($image_p, $font_size, 5, 5, $text, $white); 
if(!imagejpeg($image_p, null, 80)) {
	echo "!";
}
?>