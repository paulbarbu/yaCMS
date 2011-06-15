<form method="post" action="" >
<label for="id-dir">Directory containing images</label>
<input type="text" name="dir" id="id-dir" />
<br />
<input type="submit" name="submit" value="Display" />
</form>
<?php
if(NULL != $feedback['gallery']){
    switch($feedback['gallery']){
        case 1: echo 'Invalid directory name! - ', ERR_IS_DIR;
            break;
        case 2: echo 'Please provide a directory name! - ', ERR_NO_DIR;
            break;
        default;
    }
}
?>
