<span id="adminlogin"><a href="index.php?show=logout_admin">Log out</a></span>
<h3>Ban IPs:</h3>
<form action="?show=gbook_panel" method="post">
<?php
$ips = get_ips_ban();

if(is_numeric($ips)){
    echo '<h3>';
    switch($ips){
        case GP_ERR_OPEN: printf('Error opening file! (#%d)', GP_ERR_OPEN);
            break;
        case GP_ERR_DECODE: printf('Message cannot be decoded! (#%d)', GP_ERR_DECODE);
            break;
        case GP_ERR_EMPTY: printf('No posts! (#%d)', GP_ERR_EMPTY);
            break;
        default;
    }
    echo '</h3>';
}
else{
    foreach($ips as $ip){
        echo $ip;
    }
}
?>
<input type="submit" name="ban_ip" value="Ban selected IPs" />
<br />
<h3>Unban IPs:</h3>
<?php
$ips = get_ips_unban();

if(is_numeric($ips)){
    echo '<h3>';
    switch($ips){
        case GP_ERR_OPEN: printf('Error opening file! (#%d)', GP_ERR_OPEN);
            break;
        case GP_ERR_EMPTY: printf('No bans! (#%d)', GP_ERR_EMPTY);
            break;
        default;
    }
    echo '</h3>';
}
else{
    foreach($ips as $ip){
        echo $ip;
    }
}
?>
<input type="submit" name="unban_ip" value="Unban selected IPs" />
</form>
<?php
if(is_numeric($feedback['panel'])){
    echo '<h3>';

    switch($feedback['panel']){
        case GP_ERR_NO_IP: printf('Please select an IP! (#%d)', GP_ERR_NO_IP);
            break;
        case GP_ERR_FOPEN_BAN_FILE: printf('Could not access ban DB! (#%d)' , GP_ERR_FOPEN_BAN_FILE);
            break;
        case GP_UNBANNED: printf('Selected IPs successfully unbanned!');
            break;
        case GP_ERR_INVALID_ARRAY: printf('Invalid IP list! (#%d)' , GP_ERR_INVALID_ARRAY);
            break;
        case GP_BANNED: printf('Selected IPs successfully banned!');
        default;
    }

    echo '</h3>';
}
?>
