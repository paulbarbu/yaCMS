<?php
$path = __DIR__ . DIRECTORY_SEPARATOR . 'file.txt';

if(is_readable($path)){
	if(filesize($path)){
		$file = fopen($path, "rb");
		
		while(!feof($file)){
			$bytes = rand(1, 32);
			$content = fread($file, $bytes);
			echo '<pre>' , $content , '</pre>';
		}
	}
	else{
		echo 'Ooops, your file is empty!';
	}
}
else{
	echo 'Sorry, file busy!';
}