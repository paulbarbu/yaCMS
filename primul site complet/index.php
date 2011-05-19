<?php
require_once 'functions.php';

$pages = require_once 'pages.php';

if(isset($_GET['show'])){
	if(array_key_exists($_GET['show'], $pages)){
		$page = $_GET['show'];
	}
	else{
		$page = 'notfound';
	}
}
else{
	$page = 'home';
}

render('layout.php', compact('page', 'pages'));