<?php

/**
 * Business Logic of "Edit text on-site"
 *
 * This script will return an array with available text files in the 
 * 'uploads' folder, or a string the will be laoded in a textbox from VL or a 
 * message confirming the file's change or the error that occured.
 *
 * $path - string containing the path for list_text_files() to look in
 * $file - the file selected to be edited
 */

$result = array(
    'files' => NULL,
    'text' => NULL,
    'msg' => NULL,
);

$path = BASE_DIR . DIRECTORY_SEPARATOR . 'uploads';

if(isset($_POST['edit'])){
    
    if(isset($_POST['secret']) && !empty($_POST['secret'])){
        $secret = $_POST['secret'];
        if(is_dir($path . DIRECTORY_SEPARATOR . $secret)){
            $result['files'] = list_text_files($path . DIRECTORY_SEPARATOR . $secret);
            $result['msg'] = $secret;
        }
        else{
            return 2;
        }
    }
    elseif(isset($_POST['filelist'])){
        //return an error or string with the contents of the file
        $file = $_POST['filelist'];
        var_dump($path . DIRECTORY_SEPARATOR . $_POST['sec'] . DIRECTORY_SEPARATOR . $file);
    }
    else{ //radio box empty
        //modify the file
        //return message
    }
   
}

return $result;
