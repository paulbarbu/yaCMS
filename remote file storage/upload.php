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
$file = $_FILES['file'];
$uploadDir = $baseDir . DIRECTORY_SEPARATOR . 'uploads';

if($file['error'] == UPLOAD_ERR_OK){ // if the upload went ok

	if(is_uploaded_file($file['tmp_name'])){ // if the file is legitim(uploaded by POST method)
		if(isset($_POST['secret']) && !empty($_POST['secret'])){ //the directory is a "must"
			$uploadDir .= DIRECTORY_SEPARATOR . $_POST['secret'];
			
			if(!is_dir($uploadDir)){ // create the directory if its inexistent
				$created = mkdir($uploadDir);
				if(!$created){
					return ERR_CREATE_DIR . $_POST['secret'];
				}
			}
			
			$moved = move_uploaded_file($file['tmp_name'], $uploadDir . DIRECTORY_SEPARATOR . $file['name']);
			
			if(!$moved){
				return ERR_MOVE;
			}
			else{
				return SUCCESS;
			}
		}
		else{
			return ERR_SECRET;
		}
	}
	else{
		return ERR_NOT_UPLOADED;
	}
}
else{ //if something went wrong
	switch($file['error']){
		case UPLOAD_ERR_INI_SIZE:  //break omitted intentionally
		case UPLOAD_ERR_FORM_SIZE:
			return ERR_SIZE;
			break;
		case UPLOAD_ERR_PARTIAL:
			return ERR_PARTIAL;
			break;
		case UPLOAD_ERR_NO_FILE:
			return ERR_NO_FILE;
			break;
		case UPLOAD_ERR_NO_TMP_DIR:
			return ERR_NO_TMP;
			break;
		case UPLOAD_ERR_CANT_WRITE:
			return ERR_NO_WRITE;
			break;
		case UPLOAD_ERR_EXTENSION:
			return ERR_EXT;
			break;
		default:
	}
}