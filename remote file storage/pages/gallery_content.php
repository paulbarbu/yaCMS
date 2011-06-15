<?php
if(is_array($feedback['gallery'])){
    echo '<p>';
    foreach($feedback['gallery'] as $img){
        //XSS here :)
        echo '<img src="' . $img . '" />&nbsp;';
    }
    echo '</p>';
}
else{
?>
<form method="post" action="" >
<label for="id-dir">Directory containing images</label>
<input type="text" name="dir" id="id-dir" />
<br />
<input type="submit" name="submit" value="Display" />
</form>
<?php
}
if(NULL != $feedback['gallery'] && is_numeric($feedback['gallery'])){
    switch($feedback['gallery']){
        case 1: echo 'Invalid directory name! - ', ERR_IS_DIR;
            break;
        case 2: echo 'Please provide a directory name! - ', ERR_NO_DIR;
            break;
        case 3: echo 'Failed to open directory! - ', ERR_OPEN_DIR;
            break;
        case 4: echo 'The directory does not contain only images! - ',
                ERR_ONLY_IMAGES;
            break;
        default;
    }
}
?>
