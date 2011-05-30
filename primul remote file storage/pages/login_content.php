<form action="" method="post">
<label for="id-u">Username:</label><input type="text" id="id-u" name="user" />
<br /><label for="id-p">Password:</label><input type="password" id="id-p" name="pass" />
<br /><input type="checkbox" name="r_me" id="id-r" /><label for="id-r">Remember me</label>
<br /><input type="submit" name="go" value="Log In" />
</form>
<?php
//check for other errors too
if(is_numeric($feedback['login'])){
    echo '<h3>';
    switch($feedback['login']){
        case 1: echo 'Inexistent user!';
            break;
        case 2: echo 'Error opening users.csv!';
            break;
        case 3: echo 'Incorrect password!';
            break;
        case 4: echo 'Please fill in a user name!';
            break;
        case 5: echo 'Please provide a password!';
            break;
        case 6: echo 'Error starting session!';
            break;
        default;
    }
    echo '</h3>';
}
elseif($feedback['login']){
    echo '<h3>You\'ve been successfully authentified</h3>';
}
?>
