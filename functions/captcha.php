<?php

session_start();

header("Content-Type: image/jpeg");

$background = "../images/assets/captcha_background.jpg";

$image = imagecreatefromjpeg($background);

$color = imagecolorallocate($image, 0, 0, 0);

$font = "../assets/Elsie-Regular.ttf";

$text = bin2hex(random_bytes(4));

$_SESSION["captcha"] = $text;

imagettftext($image, 26, 0, 20, 45, $color, $font, $text);

imagejpeg($image);

?>