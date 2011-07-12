<?php
/**
 * Business logic of "Remote file upload"
 *
 * $_POST['secret'] - string that will represent the directory name to upload to
 * $file - "abbreviation" from $FILES['file']
 * $uploadDir - string that will represent the path for the user's directory
 *		specified by $_POST['secret']
 * $created - check-variable to verify if the directory was created successfully
 * $moved - check-variable to verify if the intendet file was moved in unser's
 * 		directory
 */

//create short variables
$uploadDir = UPLOADS_ROOT;
$result = NULL;

if(isset($_POST['upload'])){
    $file = $_FILES['file'];

    if($file['error'] == UPLOAD_ERR_OK){ // if the upload went ok

        if(is_uploaded_file($file['tmp_name'])){ // if the file is legitim(uploaded by POST method)
            if(isset($_POST['secret']) && !empty($_POST['secret'])){ //the directory is a "must"
                $uploadDir .= DIRECTORY_SEPARATOR . $_POST['secret'];

                if(!is_dir($uploadDir)){ // create the directory if its inexistent
                    umask(0003);// setting the proper mask for http user
                    $created = mkdir($uploadDir, 0774);// creating the dir with the proer permisions for http user and group
                    if(!$created){
                        return UP_ERR_CREATE_DIR;
                    }
                }

                $moved = move_uploaded_file($file['tmp_name'], $uploadDir . DIRECTORY_SEPARATOR . $file['name']);

                if(!$moved){
                    return UP_ERR_MOVE;
                }
                else{
                    $result = UP_SUCCESS;
                }
            }
            else{
                return UP_ERR_SECRET;
            }
        }
        else{
            return UP_ERR_NOT_UPLOADED;
        }
    }
    else{ //if something went wrong
        switch($file['error']){
            case UPLOAD_ERR_INI_SIZE:  //break omitted intentionally
            case UPLOAD_ERR_FORM_SIZE:
                return UP_ERR_SIZE;
                break;
            case UPLOAD_ERR_PARTIAL:
                return UP_ERR_PARTIAL;
                break;
            case UPLOAD_ERR_NO_FILE:
                return UP_ERR_NO_FILE;
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                return UP_ERR_NO_TMP;
                break;
            case UPLOAD_ERR_CANT_WRITE:
                return UP_ERR_NO_WRITE;
                break;
            case UPLOAD_ERR_EXTENSION:
                return UP_ERR_EXT;
                break;
            default:
        }
    }
}

return $result;
