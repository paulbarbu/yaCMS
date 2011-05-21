<?php

require_once '.' . DIRECTORY_SEPARATOR . 'functions.php';
$pages = require_once '.' . DIRECTORY_SEPARATOR . 'pages.php';

const BASE_DIR = __DIR__;
$feedback = array();

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

if(isset($pages[$page]['preprocess'])){
    foreach($pages[$page]['preprocess'] as $preprocessName => $preprocessFile){
        $feedback[$preprocessName] = require BASE_DIR . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . $preprocessFile;
    }
}
echo '<pre>';
var_dump(compact('page', 'feedback', 'pages'));
echo '</pre>';
render('layout.php', compact('page', 'feedback', 'pages'));
