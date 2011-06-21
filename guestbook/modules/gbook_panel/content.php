<?php
if(!isset($_SESSION['id'])){
    header("Location: index.php?show=login_admin");//redirecting to login module
}
else{
?>
<span id="adminlogin"><a href="index.php?show=logout_admin">Log out</a></span>
<h3>Ban IPs:</h3>
<form action="" method="post">
<?php
    $ips = get_ips_ban();

    if(is_numeric($ips)){
        echo '<h3>';
        switch($ips){
            case ERR_OPEN: echo 'Error opening file! - ', ERR_OPEN;
                break;
            case ERR_DECODE: echo 'Message cannot be decoded! - ', ERR_DECODE;
                break;
            case ERR_EMPTY: echo 'No posts! - ', ERR_EMPTY;
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
            case ERR_OPEN: echo 'Error opening file! - ', ERR_OPEN;
                break;
            case ERR_EMPTY: echo 'No bans! - ', ERR_EMPTY;
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
            case ERR_NO_IP: echo 'Please select an IP! - ', ERR_NO_IP;
                break;
            case ERR_FOPEN_BAN_FILE: echo 'Could not access ban DB! - ' , ERR_FOPEN_BAN_FILE;
                break;
            case UNBANNED: echo 'Selected IPs successfully unbanned!';
                break;
            case ERR_INVALID_ARRAY: echo 'Invalid IP list! - ' , ERR_INVALID_ARRAY;
                break;
            case BANNED: echo 'Selected IPs successfully banned!';
            default;
        }

        echo '</h3>';
    }
}
?>
