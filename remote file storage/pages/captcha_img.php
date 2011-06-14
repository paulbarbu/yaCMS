<?php
/**
 * Captcha code
 */
$chars = '0123456789qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
$used = '!';
$chars_array = array();
$captcha = NULL;

for($i=0;$i<strlen($chars);$i++){
    $chars_array[$i] = $chars[$i];
}

shuffle($chars_array);
$i=0;
while($i<5){
    $pos = rand(0, count($chars_array) - 1);

    if($used != $chars_array[$pos]){
        $captcha .= $chars_array[$pos];
        $chars_array[$pos] = $used;
        $i++;
    }
}

$_SESSION['captcha'] = $captcha;

if(-1 != $_SESSION['captcha']){

    $code = $_SESSION['captcha'];
    //create image
    $im = imagecreatetruecolor(141, 50);
    if(FALSE != $im){
        $bg = imagecolorallocate($im, 251, 249, 226);
        $black = imagecolorallocate($im, 0, 0, 0);
        //set bg color
        if(FALSE !== $bg){
            imagefill($im, 0, 0, $bg);

            //write chars in random positions
            for($i=0;$i<5;$i++){
                $x = rand(1 + (27 * $i), 27 + (27 * $i)); //every char in its part of the image
                $y = rand(1, 36);

                imagechar($im, 5, $x, $y, $code[$i], $black);
            }
            $style = array($bg, $bg, $bg, $bg, $bg, $bg, $bg,
                $black, $black, $black, $black, $black, $black);
            imagesetstyle($im, $style);

            $y_line_top = rand(0, 12);
            $y_line_bot = rand(38, 50);
            imageline($im, 0, $y_line_top, 140, $y_line_bot, IMG_COLOR_STYLED);

            $y_line_top = rand(0, 12);
            $y_line_bot = rand(38, 50);
            imageline($im, 0, $y_line_bot, 140, $y_line_top, IMG_COLOR_STYLED);

            header('Content-Type: image/png');
            imagepng($im);
            imagedestroy($im);
        }
    }
}
