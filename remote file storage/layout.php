<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
<title>Remote file storage</title>
</head>
<body>
<form enctype="multipart/form-data" action="" method="post" >
	<input type="hidden" name="MAX_FILE_SIZE" value="
		<?php require_once '.' . DIRECTORY_SEPARATOR . 'functions.php';
			  echo $size = return_bytes(ini_get('upload_max_filesize')); ?>" />
	<label for="id-secret">Secret dir. name: </label>
		<input type="text" name="secret" id="id-secret" /><br />
			  
	<label for="up">Your file(max <?php echo ($size/1024)/1024 ?> mB): </label>
		<input type="file" id="up" name="file" /><br />
		
	<input type="submit" name="upload" value="Upload" /> 
</form>
</body>
</html>