<form action="index.php?show=login_admin
<?php
    if(!empty($feedback_pre['autologin']['prev'])){
?>
&action=
<?php
     echo $feedback_pre['autologin']['prev'];
}
?>
" method="post">
<label for="id-p">Password:</label>
<input type="password" name="pass" id="id-p" />
<br />
<input type="checkbox" name="r_me" id="id-r_me" />
<label for="id-r_me"> Remember me</label>
<br />
<input type="submit" name="adminlogin" value="Log in"/>
</form>
<?php
echo '<h3>';

if(is_numeric($feedback['login'])){

    switch($feedback['login']){
        case LA_ERR_PASS: printf('Invalid password! (#%d)' , LA_ERR_PASS);
            break;
        case LA_ERR_READING: printf('Could not read from DB! (#%d)' , LA_ERR_READING);
            break;
        case LA_ERR_FOPEN_ADMIN: printf('Could not open DB! (#%d)' , LA_ERR_FOPEN_ADMIN);
            break;
        case LA_ERR_DIR: printf('Invalid directory! (#%d)', LA_ERR_DIR);
            break;
        case LA_ERR_NO_PASS: printf('Plase fill in a password! (#%d)' , LA_ERR_NO_PASS);
            break;
        case LA_ERR_COOKIE: printf('Error setting cookie! (#%d)' , LA_ERR_COOKIE);
            break;
        default;
    }

}
elseif($feedback['login']){
    echo 'Authentified!';
}

echo '</h3>';
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
