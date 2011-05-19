<?php

require_once '.' . DIRECTORY_SEPARATOR . 'functions.php';
$pages = require_once '.' . DIRECTORY_SEPARATOR . 'pages.php';

const BASE_DIR = __DIR__;

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
