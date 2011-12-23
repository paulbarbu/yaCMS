<?php
if(isset($feedback['gallery']) && is_array($feedback['gallery'])){
    echo '<p>';
    foreach($feedback['gallery'] as $img){
        echo '<img src="' . strip_tags($img) . '" />&nbsp;';
    }
    echo '</p>';
}
else{
?>
<form method="post" action="?show=gallery" >
<label for="id-dir">Directory containing images</label>
<input type="text" name="dir" id="id-dir" />
<br />
<input type="submit" name="submit" value="Display" />
</form>
<?php
}
if(isset($feedback['gallery']) && NULL != $feedback['gallery'] && is_numeric($feedback['gallery'])){
    echo '<h3>';

    switch($feedback['gallery']){
        case G_ERR_IS_DIR: printf('Invalid directory name! (#%d)', G_ERR_IS_DIR);
            break;
        case G_ERR_NO_DIR: printf('Please provide a directory name! (#%d)', G_ERR_NO_DIR);
            break;
        case G_ERR_OPEN_DIR: printf('Failed to open directory! (#%d)', G_ERR_OPEN_DIR);
            break;
        case G_ERR_NO_IMAGES: printf('The directory does not contain images! (#%d)',
                G_ERR_NO_IMAGES);
            break;
        default;
    }

    echo '</h3>';
}

/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
