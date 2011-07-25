<?php
$status = check_ip($_SERVER['REMOTE_ADDR']);

if(is_numeric($status)){
    echo '<h3>';

    switch($status){
        case GB_ERR_IP_STRING: printf('Invalid supplied IP! (#%d)' , GB_ERR_IP_STRING);
            break;
        case GB_ERR_FOPEN_BAN_FILE: printf('Error opening DB! (#%d)' , GB_ERR_FOPEN_BAN_FILE);
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
<?php
    if(isset($_SESSION['admin'])){
        echo '<br/> <input type="submit" name="del" value="Delete selected" />';
    }

    if(is_numeric($feedback['gbook'])){
        echo '<h3>';

        switch($feedback['gbook']){
            case GB_ERR_NO_NICK: printf('Please provide a nickname! (#%d)', GB_ERR_NO_NICK);
                break;
            case GB_ERR_NO_MSG: printf('Please write a message! (#%d)', GB_ERR_NO_MSG);
                break;
            case GB_ERR_OPEN_MSG_FILE: printf('Could not open file for writing! (#%d)', GB_ERR_OPEN_MSG_FILE);
                break;
            case GB_ERR_WRITE_POST: printf('Could not write your message! (#%d)', GB_ERR_WRITE_POST);
                break;
            case GB_POST_SUCCESS: echo 'Posted!';
                break;
            case GB_DEL_SUCCESS: echo 'Deleted!';
                break;
            case GB_ERR_NO_SELECTED: printf('No posts selected! (#%d)', GB_ERR_NO_SELECTED);
                break;
            case GB_ERR_NO_MSG_FILE: printf('Database does not exists! (#%d)', GB_ERR_NO_MSG_FILE);
                break;
            case GB_ERR_READONLY: printf('Database is readonly! (#%d)', GB_ERR_READONLY);
                break;
            case GB_ERR_CANNOT_READ: printf('Cannot read from database! (#%d)', GB_ERR_CANNOT_READ);
                break;
            default;
        }

        echo '</h3>';
    }

    if(isset($_SESSION['admin']) && $_SESSION['admin']){
        $messages = post_to_div(PATH_MSG_FILE, TRUE);
    }
    else{
        $messages = post_to_div();
    }

    if(is_numeric($messages)){
        echo '<h3>';
        switch($messages){
            case GB_ERR_OPEN: printf('Error opening file! (#%d)', GB_ERR_OPEN);
                break;
            case GB_ERR_DECODE: printf('Message cannot be decoded! (#%d)', GB_ERR_DECODE);
                break;
            case GB_ERR_EMPTY: printf('No posts! (#%d)', GB_ERR_EMPTY);
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
</form>
