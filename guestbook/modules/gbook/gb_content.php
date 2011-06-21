<?php
$status = check_ip($_SERVER['REMOTE_ADDR']);

if(is_numeric($status)){
    echo '<h3>';

    switch($status){
        case ERR_IP_STRING: echo 'Invalid supplied IP! - ' , ERR_IP_STRING;
            break;
        case ERR_FOPEN_BAN_FILE: echo 'Error opening DB! - ' , ERR_FOPEN_BAN_FILE;
            break;
        default;
    }

    echo '</h3>';
}
elseif(TRUE == $status){
    echo '<h3>This IP is banned, <u>' , $_SERVER['REMOTE_ADDR'] , '</u>!</h3>';
}
else{
?>
<span id="adminlogin">
<a href="index.php?show=gbook_panel">Admin panel</a>
</span>
<br />
<form action="" method="post" >
<label for="id-n">Name: </label>
<input type="text" name="nick" id="id-n" />
<br />
<label for="id-m">Mail: </label>
<input type="text" name="mail" id="id-m" />
<br />
<label for="id-u">Web - site: </label>
<input type="text" name="url" id="id-u" />
<br />
<label for="id-msg">Message: </label>
<br />
<textarea name="message" id="id-msg" cols="60" rows="5">
Your message here...
</textarea>
<br />
<input type="submit" name="post" value="Post" />
</form>
<?php
    if(is_numeric($feedback['gbook'])){
        echo '<h3>';

        switch($feedback['gbook']){
            case ERR_NO_NICK: echo 'Please provide a nickname! - ', ERR_NO_NICK;
                break;
            case ERR_NO_MSG: echo 'Please write a message! - ', ERR_NO_MSG;
                break;
            case ERR_OPEN_MSG_FILE: echo 'Could not open file for writing! - ', ERR_OPEN_MSG_FILE;
                break;
            case ERR_WRITE_POST: echo 'Could not write your message! - ', ERR_WRITE_POST;
                break;
            case POST_SUCCESS: echo 'Posted!';
                break;
            default;
        }

        echo '</h3>';
    }

    if(!isset($_SESSION['id'])){
        $messages = post_to_div();
    }
    else{
        $messages = post_to_div(PATH_MSG_FILE, TRUE);
    }

    if(is_numeric($messages)){
        echo '<h3>';
        switch($messages){
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
        for($i=count($messages) - 1;$i>=0;$i--){
            echo $messages[$i];
        }
    }
}
?>
