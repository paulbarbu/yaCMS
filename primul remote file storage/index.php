<?php

require_once '.' . DIRECTORY_SEPARATOR . 'functions.php';
require_once '.' . DIRECTORY_SEPARATOR . 'const.php';

const BASE_DIR = __DIR__;

if(isset($_POST['upload'])){
	require '.' . DIRECTORY_SEPARATOR . 'upload.php';
	require '.' . DIRECTORY_SEPARATOR . 'layout.php';
}
else{
	require '.' . DIRECTORY_SEPARATOR . 'layout.php';
}