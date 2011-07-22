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
        case UP_ERR_SIZE: printf('The input file exceeded the size limit! (#%d)' , UP_ERR_SIZE);
            break;
        case UP_ERR_PARTiAL: printf('The uploaded file was only partially uploaded! (#%d)' , UP_ERR_PARTIAL);
            break;
        case UP_ERR_NO_FILE: printf('You must select a file for uploading! (#%d)' , UP_ERR_NO_FILE);
            break;
        case UP_ERR_NO_TMP: printf('The temporary directory is missing! (#%d)' , UP_ERR_NO_TMP);
            break;
        case UP_ERR_NO_WRITE: printf('Directory permissions problems! (#%d)' , UP_ERR_NO_WRITE);
            break;
        case UP_ERR_EXT: printf('Upload stopped by extension! (#%d)' , UP_ERR_EXT);
            break;
        case UP_ERR_SECRET: printf('Please specify a directory name to upload to! (#%d)' , UP_ERR_SECRET);
            break;
        case UP_ERR_NOT_UPLOADED: printf('The file you are trying to submit is not a valid uploaded file! (#%d)' , UP_ERR_NOT_UPLOADED);
            break;
        case UP_ERR_CREATE_DIR: printf('Error creating directory! (#%d)' , UP_ERR_CREATE_DIR);
            break;
        case UP_ERR_MOVE: printf('An unexpected error occured while moving the file to destination! (#%d)' , UP_ERR_MOVE);
            break;
        case UP_SUCCESS: printf('File uploaded successfully! (#%d)' , UP_SUCCESS);
            break;
        default;
    }

    echo '</h3>';
}

?>
