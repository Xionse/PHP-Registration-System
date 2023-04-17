<?php
session_start();

// Generate a random string for the captcha code
$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$randomString = '';
for ($i = 0; $i < 6; $i++) {
    $randomString .= $characters[rand(0, strlen($characters) - 1)];
}

// Save the captcha code to the session
$_SESSION['captcha'] = $randomString;

// Generate the captcha image
$captchaImage = imagecreatetruecolor(120, 50);
$bgColor = imagecolorallocate($captchaImage, 255, 255, 255);
$textColor = imagecolorallocate($captchaImage, 0, 0, 0);
imagefilledrectangle($captchaImage, 0, 0, 120, 50, $bgColor);
imagettftext($captchaImage, 30, -10, 15, 40, $textColor, 'arial.ttf', $randomString);

// Output the image
header('Content-Type: image/png');
imagepng($captchaImage);
imagedestroy($captchaImage);
?>
