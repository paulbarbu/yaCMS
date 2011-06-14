<form action="" method="post">
<label for="id-u">User name:</label><input type="text" id="id-u" name="user" />
<br /><label for="id-p">Password:</label>
    <input type="password" id="id-p" name="pass" />
<br /><input type="checkbox" name="r_me" id="id-r" />
    <label for="id-r">Remember me</label>
<br />
<img src="index.php?show=captcha">
<input type="text" name="code" id="id-code" />
<br /><input type="submit" name="go" value="Log In" />
</form>
<?php
if(is_numeric($feedback['login'])){
    echo '<h3>';
    switch($feedback['login']){
        case ERR_USER: echo 'Inexistent user! - ', ERR_USER;
            break;
        case ERR_FOPEN_USER: echo 'Error opening users.csv! - ', ERR_FOPEN_USER;
            break;
        case ERR_PASS: echo 'Incorrect password! - ', ERR_PASS;
            break;
        case ERR_NO_USER: echo 'Please fill in a user name! - ', ERR_NO_USER;
            break;
        case ERR_NO_PASS: echo 'Please provide a password! - ', ERR_NO_PASS;
            break;
        case ERR_SESS: echo 'Error starting session! - ', ERR_SESS;
            break;
        case ERR_COOKIE: echo 'Cannot set cookie! - ', ERR_COOKIE;
            break;
        case ERR_CAPTCHA: echo 'Captcha error! - ', ERR_CAPTCHA;
            break;
        case ERR_NO_CODE: echo 'Please type the captcha code! - ', ERR_NO_CODE;
            break;
        case ERR_W_CODE: echo 'Wrong captcha code! - ', ERR_W_CODE;
            break;
        default;
    }
    echo '</h3>';
}
elseif($feedback['login']){
    echo '<h3>You\'ve been successfully authentified</h3>';
}
?>
