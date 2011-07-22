<form enctype="multipart/form-data" action="" method="post" >
	<input type="hidden" name="MAX_FILE_SIZE" value="
		<?php echo $size = return_bytes(ini_get('upload_max_filesize')); ?>" />
	<label for="id-secret">Secret dir. name: </label>
		<input type="text" name="secret" id="id-secret" /><br />

	<label for="up">Your file(max <?php echo ($size/1024)/1024 ?> mB): </label>
		<input type="file" id="up" name="file" /><br />

	<input type="submit" name="upload" value="Upload" />
</form>
<?php

if(is_numeric($feedback['upload'])){
    echo '<h3>' ;

    switch($feedback['upload']){
        case UP_ERR_SIZE: echo 'The input file exceeded the size limit! - ' , UP_ERR_SIZE;
            break;
        case UP_ERR_PARTiAL: echo 'The uploaded file was only partially uploaded! - ' , UP_ERR_PARTiAL;
            break;
        case UP_ERR_NO_FILE: echo 'You must select a file for uploading! - ' , UP_ERR_NO_FILE;
            break;
        case UP_ERR_NO_TMP: echo 'The temporary directory is missing! - ' , UP_ERR_NO_TMP;
            break;
        case UP_ERR_NO_WRITE: echo 'Directory permissions problems! - ' , UP_ERR_NO_WRITE;
            break;
        case UP_ERR_EXT: echo 'Upload stopped by extension! - ' , UP_ERR_EXT;
            break;
        case UP_ERR_SECRET: echo 'Please specify a directory name to upload to! - ' , UP_ERR_SECRET;
            break;
        case UP_ERR_NOT_UPLOADED: echo 'The file you are trying to submit is not a valid uploaded file! - ' , UP_ERR_NOT_UPLOADED;
            break;
        case UP_ERR_CREATE_DIR: echo 'Error creating directory! - ' , UP_ERR_CREATE_DIR;
            break;
        case UP_ERR_MOVE: echo 'An unexpected error occured while moving the file to destination! - ' , UP_ERR_MOVE;
            break;
        case UP_SUCCESS: echo 'File uploaded successfully! - ' , UP_SUCCESS;
            break;
        case UP_ERR_CONTACT_ADMIN: echo 'Please contact website administrator! - (', UP_ERR_CONTACT_ADMIN, ')';
            break;
        default;
    }

    echo '</h3>';
}

?>
