<?php
echo '<h3>';
if($feedback['logout']){
    echo 'You\'ve been successfully logged out!';
}
else{
    echo 'An error occured during log out!';
}
echo '</h3>';
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
