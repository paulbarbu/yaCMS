<?php
//include bug => file not found
require_once '.' . DIRECTORY_SEPARATOR . 'functions.php';
require_once '.' . DIRECTORY_SEPARATOR . 'const.php';

$result = NULL;
const BASE_DIR = __DIR__;

if(isset($_POST['upload'])){
	$result = require '.' . DIRECTORY_SEPARATOR . 'upload.php';
}
else{
	render('layout.php');
}

if($result){
	render('result.php', compact('result'));
}