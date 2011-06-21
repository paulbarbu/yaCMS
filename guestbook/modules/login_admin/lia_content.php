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
var_dump($feedback_pre);
if(is_numeric($feedback['login'])){
    echo '<h3>';

    switch($feedback['login']){
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
