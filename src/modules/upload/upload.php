<?php
/**
 * Business logic of "Remote file upload"
 *
 * $_POST['secret'] - string that will represent the directory name to upload to
 * $file - "abbreviation" from $FILES['file']
 * $uploadDir - string that will represent the path for the user's directory
 * specified by $_POST['secret']
 * $created - check-variable to verify if the directory was created successfully
 * $moved - check-variable to verify if the intendet file was moved in unser's
 * directory
 */

//create short variables
$uploadDir = UPLOADS_ROOT;
$result = NULL;

if(isset($_POST['upload'])){
    $file = $_FILES['file'];

    if($file['error'] == UPLOAD_ERR_OK){ // if the upload went ok

        if(is_uploaded_file($file['tmp_name'])){ // if the file is legitim(uploaded by POST method)
            if(isset($_POST['secret']) && !empty($_POST['secret'])){ //the directory is a "must"
                if(is_dir($uploadDir)){
                    if(!is_writable($uploadDir)){
                        return UP_ERR_WRITE_UPLD_DIR;
                    }
                }
                else{
                    if(!is_writable(YACMS_BASE_DIR)){
                        return UP_ERR_WRITE_BASE_DIR;
                    }
                    umask(0003);
                    if(!mkdir($uploadDir,0774)){
                        return UP_ERR_CREATE_DIR;
                    }
                }

                $uploadDir .= DIRECTORY_SEPARATOR . $_POST['secret'];
                if(!is_dir($uploadDir)){
                    umask(0003);
                    if(!mkdir($uploadDir, 0774)){
                        return UP_ERR_CREATE_DIR;
                    }
                }
                else {
                    if(!is_writable($uploadDir)){
                        return UP_ERR_WRITE_FL_UPLD_DIR;
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
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
