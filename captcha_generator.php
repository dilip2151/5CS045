<?php
// captcha_generator.php

//  Start the session to store the CAPTCHA code
session_start();

//  Image and text settings
$width = 150;
$height = 50;
$length = 5;
$characters = '23456789abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';

//  Generate random CAPTCHA code
$captcha_code = '';
for ($i = 0; $i < $length; $i++) {
    $captcha_code .= $characters[rand(0, strlen($characters) - 1)];
}

//  Store the code in the session (case-insensitive comparison is typically used later)
// Use the lowercase version for comparison to avoid confusing users with case-sensitive codes.
$_SESSION['captcha_code'] = strtolower($captcha_code);

// Create the image resource
$image = imagecreate($width, $height);

//  Define colors (RGB)
$background_color = imagecolorallocate($image, 30, 30, 30); // Dark Grey/Black
$text_color = imagecolorallocate($image, 255, 255, 255); // White Text
$noise_color = imagecolorallocate($image, 100, 100, 100); // Noise

//  Draw background
imagefill($image, 0, 0, $background_color);

// Add noise (random dots and lines)
for ($i = 0; $i < 500; $i++) {
    imagesetpixel($image, rand(0, $width), rand(0, $height), $noise_color);
}
for ($i = 0; $i < 5; $i++) {
    imageline($image, 0, rand(0, $height), $width, rand(0, $height), $noise_color);
}

// Write the text (using a simple font)
$x_start = 15;
for ($i = 0; $i < $length; $i++) {
    $char = $captcha_code[$i];
    // Write text with random angle and position
    imagestring($image, 5, $x_start, rand(5, $height - 20), $char, $text_color);
    $x_start += 25; // Move position for the next character
}

//  Output the image as PNG
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
?>