<?php
echo '<h3>';
if($feedback['logout']){
    echo 'You\'ve been successfully logged out!';
}
else{
    echo 'An error occured during log out!';
}
echo '</h3>';
