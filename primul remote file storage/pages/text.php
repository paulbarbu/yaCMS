<?php

/**
 * Business Logic of "Edit text on-site"
 *
 * This script will return an array with available text files in the 
 * 'uploads' folder, or a string the will be laoded in a textbox from VL or a 
 * message confirming the file's change or the error that occured.
 *
 * PATH - string containing the path for list_text_files() to look in
 * $file - the file selected to be edited
 */

$result = array(
    'files' => NULL,
    'text' => NULL,
    'msg' => NULL,
);

if(isset($_POST['edit'])){
    
    if(isset($_POST['secret']) && !empty($_POST['secret'])){
        $secret = $_POST['secret'];

        if(is_dir(PATH . DIRECTORY_SEPARATOR . $secret)){
            $result['files'] = list_text_files(PATH . DIRECTORY_SEPARATOR . $secret);
            $result['msg'] = $secret;
        }
        else{ //passphrase incorrect(inexistent directory)
            return 2;
        }
    }
    elseif(isset($_POST['filelist'])){
        $file = PATH . DIRECTORY_SEPARATOR . $_POST['sec'] . DIRECTORY_SEPARATOR . $_POST['filelist'];
        var_dump($file);
    }
    else{ //radio box empty
        //modify the file
        //return message
    }
   
}

return $result;
