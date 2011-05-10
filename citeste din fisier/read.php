<?php
$path = __DIR__ . DIRECTORY_SEPARATOR . 'file.txt';

$file = fopen($path, "rb");
if(is_readable($path)){
	if(filesize($path)){
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