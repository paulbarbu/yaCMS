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
 * $text - string that holds the contents of the file
 */

$result = array(
    'files' => NULL,
    'contents' => NULL,
    'msg' => NULL,
);

if(isset($_POST['edit'])){
    
    if(isset($_POST['secret']) && !empty($_POST['secret'])){
        $secret = $_POST['secret'];

        if(is_dir(PATH . DIRECTORY_SEPARATOR . $secret)){
            $result['files'] = list_text_files(PATH . DIRECTORY_SEPARATOR
                . $secret);
            $result['msg'] = $secret;
        }
        else{ //passphrase incorrect(inexistent directory)
            return 1;
        }
    }
    elseif(isset($_POST['filelist'])){
        $file = PATH . DIRECTORY_SEPARATOR . $_POST['sec'] 
            . DIRECTORY_SEPARATOR . $_POST['filelist'];

        $text = file_get_contents($file);
        if(FALSE == $text){
            return 2;
        }

        $result['contents'] = $text;
        $result['msg'] = DIRECTORY_SEPARATOR . $_POST['sec'] 
            . DIRECTORY_SEPARATOR . $_POST['filelist'];
    }
    elseif(isset($_POST['contents'])){
        $file = PATH . $_POST['file'];

        $check = file_put_contents($file, $_POST['contents']);
        if(FALSE === $check){
            return 3;
        }
        
        $name = substr(strrchr($file, DIRECTORY_SEPARATOR), 1);
        $result['msg'] = '<i>' . $name . '</i> successfully updated!';
    }
   
}

return $result;
