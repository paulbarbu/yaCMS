<?php
if(!isset($_SESSION['id'])){
?>
<form action="" method="post" >
<label for="id-p">Password:</label>
<input type="password" name="pass" id="id-p" />
<br />
<input type="checkbox" name="r_me" id="id-r_me" />
<label for="id-r_me"> Remember me</label>
<br />
<input type="submit" name="adminlogin" value="Log in"/>
</form>
<?php
    if(is_numeric($feedback['gbook_admin'])){
        echo '<h3>';

        switch($feedback['gbook_admin']){
            case ERR_PASS: echo 'Invalid password! - ' , ERR_PASS;
                break;
            case ERR_READING: echo 'Could not read from DB! - ' , ERR_READING;
                break;
            case ERR_FOPEN_ADMIN: echo 'Could not open DB! - ' , ERR_FOPEN_ADMIN;
                break;
            case ERR_DIR: echo 'Invalid directory! - ', ERR_DIR;
                break;
            case ERR_NO_PASS: echo 'Plase fill in a password! - ' , ERR_NO_PASS;
                break;
            case ERR_COOKIE: echo 'error setting cookie! - ' , ERR_COOKIE;
                break;
            default;
        }

        echo '</h3>';
    }
}
else{
    /**
     * Admin is logged in and must use his CONTROLS
     */
    echo '<span id="adminlogin"><a href="index.php?show=logout">Log out</a></span>';
?>
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
    if(is_numeric($feedback['gbook_controls'])){
        echo '<h3>';

        switch($feedback['gbook_controls']){
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
