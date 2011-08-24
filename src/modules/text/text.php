<?php

/**
 * Business Logic of "Edit text on-site"
 *
 * This script will return an array with available text files in the
 * 'uploads' folder, or a string the will be laoded in a textbox from VL or a
 * message confirming the file's change or the error that occured.
 *
 * $file - the file selected to be edited
 * $result['files'] - an array containing all the text files from the 'secret'
 * folder
 * $result['content'] - string that holds the content of the chosen file
 * $result['msg'] - string that holds metadatas about the secret folder, the
 * file or the upload itself
 * TXT_ERR_PASS - will be returned when passphrase(secret) is incorrect
 * TXT_ERR_READ - returned when file_get_contents() fails
 * TXT_ERR_WRITE - returned if there is an error on writing the new contents to the
 * file
 */

$result = array(
    'files' => NULL,
    'contents' => NULL,
    'msg' => NULL,
);

if(isset($_POST['edit'])){

    if(isset($_POST['secret']) && !empty($_POST['secret'])){
        $secret = strip_tags($_POST['secret']);

        if(is_dir(UPLOADS_ROOT . $secret)){
            $result['files'] = find_files_by_mime(UPLOADS_ROOT . $secret, 'text', FALSE);

            foreach($result['files'] as $key => $file){
                $result['files'][$key] = strip_tags(substr($file, strrpos($file, '/')+1));
            }

            $result['msg'] = $secret;
        }
        else{ //passphrase incorrect(inexistent directory)
            return TXT_ERR_PASS;
        }
    }
    elseif(isset($_POST['filelist'])){
        $file = UPLOADS_ROOT . $_POST['sec'] . DIRECTORY_SEPARATOR . $_POST['filelist'];

        $result['contents'] = file_get_contents($file);
        if(FALSE == $result['contents']){
            return TXT_ERR_READ;
        }

        $result['msg'] = $_POST['sec'] . DIRECTORY_SEPARATOR . $_POST['filelist'];
    }
    elseif(isset($_POST['contents'])){
        $file = UPLOADS_ROOT . $_POST['file'];
    if(is_writable($file)) {
        $check = file_put_contents($file, $_POST['contents']);
        if(FALSE === $check){
            return TXT_ERR_WRITE;
        }
    }
    else {
        return TXT_ERR_WPROTECT;
    }
        $name = substr(strrchr($file, DIRECTORY_SEPARATOR), 1);
        $result['msg'] = $name;
    }

}

return $result;
