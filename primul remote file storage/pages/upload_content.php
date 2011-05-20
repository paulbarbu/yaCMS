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

if($result != NULL){
	echo '<h3>' , $result , '</h3>';
}

?>
