<form action="index.php?show=login_admin&action=<?php echo $feedback_pre['autologin']; ?>" method="post" >
<label for="id-p">Password:</label>
<input type="password" name="pass" id="id-p" />
<br />
<input type="checkbox" name="r_me" id="id-r_me" />
<label for="id-r_me"> Remember me</label>
<br />
<input type="submit" name="adminlogin" value="Log in"/>
</form>
<?php
if(is_numeric($feedback['login'])){
    echo '<h3>';

    switch($feedback['login']){
        case LA_ERR_PASS: echo 'Invalid password! - ' , LA_ERR_PASS;
            break;
        case LA_ERR_READING: echo 'Could not read from DB! - ' , LA_ERR_READING;
            break;
        case LA_ERR_FOPEN_ADMIN: echo 'Could not open DB! - ' , LA_ERR_FOPEN_ADMIN;
            break;
        case LA_ERR_DIR: echo 'Invalid directory! - ', LA_ERR_DIR;
            break;
        case LA_ERR_NO_PASS: echo 'Plase fill in a password! - ' , LA_ERR_NO_PASS;
            break;
        case LA_ERR_COOKIE: echo 'error setting cookie! - ' , LA_ERR_COOKIE;
            break;
        default;
    }

    echo '</h3>';
}
