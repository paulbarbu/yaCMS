<form action="" method="post" >
<?php
if(is_numeric($feedback['text'])){
    echo '<h3>';
    switch($feedback['text']){
        case 2: echo 'Incorrect passphrase!'; 
    }
    echo '</h3>';
}
elseif(NULL != $feedback['text']['files']){
    foreach($feedback['text']['files'] as $file){
        echo '<input type="radio" name="filelist" id="id-' , $file , '" value="' , $file , '" /><label for="id-' , $file , '">' , $file , '</label><br />' , PHP_EOL; 
    }
    echo '<input type="hidden" name="sec" value="' , $feedback['text']['msg'] , '" />';
}
else{
    echo '<label for="id-s">Passphrase</label><input type="text" name="secret" id="id-s" />';
}
?>
<input type="submit" value="Edit" name="edit" />
</form>
