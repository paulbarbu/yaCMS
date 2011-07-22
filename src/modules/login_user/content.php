<form action="index.php?show=login_user
<?php
    if(!empty($feedback_pre['autologin'])){
?>
&action=
<?php
     echo $feedback_pre['autologin'];
}
?>
" method="post">
<label for="id-u">User name:</label><input type="text" id="id-u" name="user" />
<br /><label for="id-p">Password:</label>
    <input type="password" id="id-p" name="pass" />
<br /><input type="checkbox" name="r_me" id="id-r" />
    <label for="id-r">Remember me</label>
<br />
<br /><input type="submit" name="go" value="Log In" />
</form>
<?php
echo '<h3>';
if(is_numeric($feedback['login'])){
    switch($feedback['login']){
        case LU_ERR_USER: printf('Inexistent user! (#%d)', LU_ERR_USER);
            break;
        case LU_ERR_FOPEN_USER: printf('Error opening users.csv! (#%d)', LU_ERR_FOPEN_USER);
            break;
        case LU_ERR_PASS: printf('Incorrect password! (#%d)', LU_ERR_PASS);
            break;
        case LU_ERR_NO_USER: printf('Please fill in a user name! (#%d)', LU_ERR_NO_USER);
            break;
        case LU_ERR_NO_PASS: printf('Please provide a password! (#%d)', LU_ERR_NO_PASS);
            break;
        case LU_ERR_SESS: printf('Error starting session! (#%d)', LU_ERR_SESS);
            break;
        case LU_ERR_COOKIE: printf('Cannot set cookie! (#%d)', LU_ERR_COOKIE);
            break;
        default;
    }
}
elseif($feedback['login']){
    echo 'Authentified!';
}
echo '</h3>';
?>
