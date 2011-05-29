<form action="" method="post" >
<?php
if(is_numeric($feedback['text'])){
    echo '<h3>';
    switch($feedback['text']){
        case 1: echo 'Incorrect passphrase!';
            break;
        case 2: echo 'Error on reading the file!';
            break;
        case 3: echo 'Error on writing to file!';
        default;
    }
    echo '</h3>';
}
elseif(NULL != $feedback['text']['contents']){
    echo '<label for="id-c">Edit here:</label><br /><textarea name="contents" id="id-c" rows="15" cols="100">' , $feedback['text']['contents'] , '</textarea><br />' , PHP_EOL;
    echo '<input type="hidden" name="file" value="' , $feedback['text']['msg'] , '" />';
}
elseif(NULL != $feedback['text']['files']){

    foreach($feedback['text']['files'] as $file){
        echo '<input type="radio" name="filelist" id="id-' , $file , '" value="' , $file , '" /><label for="id-' , $file , '">' , $file , '</label><br />' , PHP_EOL; 
    }
    echo '<input type="hidden" name="sec" value="' , $feedback['text']['msg'] , '" />';
}
elseif(NULL != $feedback['text']['msg']){
    echo '<h3>' , $feedback['text']['msg'] , '</h3>';
}
else{ //we don't have to show the file list so the user must specify the 'secret'
    echo '<label for="id-s">Passphrase</label><input type="password" name="secret" id="id-s" />';
}
?>
<input type="submit" value="Edit" name="edit" />
</form>
