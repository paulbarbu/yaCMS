<?php
/**
 * BL for captcha code generator
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
echo $_SESSION['captcha'];
