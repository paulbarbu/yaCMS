<?php
/**
 * Image creator for the captcha
 */
header('Content-Type: image/png');

$im = imagecreatetruecolor(140, 50);
if(FALSE != $im){
    imagepng($im);
    imagedestroy($im);
}
