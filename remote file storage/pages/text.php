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
 * $result['files'] - an array containing all the text files from the 'secret'
 * folder
 * $result['content'] - string that holds the content of the chosen file
 * $result['msg'] - string that holds metadatas about the secret folder, the
 * file or the upload itself
 * ERR_PASS - will be returned when passphrase(secret) is incorrect
 * ERR_READ - returned when file_get_contents() fails
 * ERR_WRITE - returned if there is an error on writing the new contents to the
 * file
 */

$result = array(
    'files' => NULL,
    'contents' => NULL,
    'msg' => NULL,
);

if(isset($_POST['edit'])){

    if(isset($_POST['secret']) && !empty($_POST['secret'])){
        $secret = $_POST['secret'];

        if(is_dir(PATH . $secret)){
            $result['files'] = list_text_files(PATH . $secret);
            $result['msg'] = $secret;
        }
        else{ //passphrase incorrect(inexistent directory)
            return ERR_PASS;
        }
    }
    elseif(isset($_POST['filelist'])){
        $file = PATH . $_POST['sec'] . DIRECTORY_SEPARATOR . $_POST['filelist'];

        $result['contents'] = file_get_contents($file);
        if(FALSE == $result['contents']){
            return ERR_READ;
        }

        $result['msg'] = DIRECTORY_SEPARATOR . $_POST['sec']
            . DIRECTORY_SEPARATOR . $_POST['filelist'];
    }
    elseif(isset($_POST['contents'])){
        $file = PATH . $_POST['file'];

        $check = file_put_contents($file, $_POST['contents']);
        if(FALSE === $check){
            return ERR_WRITE;
        }

        $name = substr(strrchr($file, DIRECTORY_SEPARATOR), 1);
        $result['msg'] = $name;
    }

}

return $result;
