<form action="" method="post" >
<?php
if(is_numeric($feedback['text'])){
    echo '<h3>';
    switch($feedback['text']){
        case TXT_ERR_PASS: printf('Incorrect passphrase! (#%d)', TXT_ERR_PASS);
            break;
        case TXT_ERR_READ: printf('Error on reading the file! (#%d)', TXT_ERR_READ);
            break;
        case TXT_ERR_WRITE: printf('Error on writing to file! (#%d)', TXT_ERR_WRITE);
        default;
    }
    echo '</h3>';
}
elseif(NULL != $feedback['text']['contents']){
    echo '<label for="id-c">Edit here:</label><br /><textarea name="contents"
        id="id-c" rows="15" cols="100">' , $feedback['text']['contents']
        , '</textarea><br />' , PHP_EOL;
    echo '<input type="hidden" name="file" value="'
        , $feedback['text']['msg'] , '" />';
}
elseif(NULL != $feedback['text']['files']){

    foreach($feedback['text']['files'] as $file){
        echo '<input type="radio" name="filelist" id="id-' , $file ,
            '" value="' , $file , '" /><label for="id-' , $file , '">'
            , $file , '</label><br />' , PHP_EOL;
    }
    echo '<input type="hidden" name="sec" value="' , $feedback['text']['msg'] ,
        '" />';
}
elseif(NULL != $feedback['text']['msg']){
    echo '<h3><i>' , $feedback['text']['msg'] , '</i> successfully updated!
        </h3>';
}
else{ //the user must specify the 'secret'
    echo '<label for="id-s">Passphrase</label><input type="password"
        name="secret" id="id-s" />';
}
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
?>
<input type="submit" value="Continue" name="edit" />
</form>
