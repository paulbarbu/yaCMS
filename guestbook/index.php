<?php

define('BASE_DIR', __DIR__ . DIRECTORY_SEPARATOR);

require_once BASE_DIR . 'functions.php';
require_once BASE_DIR . 'global_const.php';
$modules = require_once BASE_DIR . 'modules.php';

$feedback = array();

if(isset($_GET['show'])){
    if(array_key_exists($_GET['show'], $modules)){
        $module = $_GET['show'];
    }
    else{
        $module = 'notfound';
    }
}
else{
    $module = 'home'; //default module
}
if(isset($modules[$module]['pre-process']) && !empty($modules[$module]['pre-process'])){
    foreach($modules[$module]['pre-process'] as $pre){
        if(FALSE != stristr($pre, '.php')){
            require MODULES_ROOT . $module . DIRECTORY_SEPARATOR . $pre;
        }
        else{//our module has another module as pre-dependency
            foreach($modules[$pre]['pre-process'] as $dep_pre){
                require MODULES_ROOT . $pre . DIRECTORY_SEPARATOR . $dep_pre;

            }
        }
    }
}

if(isset($modules[$module]['BL'])){
    foreach($modules[$module]['BL'] as $blName => $blFile){
        $feedback[$blName] = require MODULES_ROOT . $module . DIRECTORY_SEPARATOR . $blFile;
    }
}

render('layout.php', compact('module', 'feedback', 'modules'));

if(isset($modules[$module]['post-process']) && !empty($modules[$module]['post-process'])){
    foreach($modules[$module]['post-process'] as $post){
        if(FALSE != stristr($post, '.php')){
            require MODULES_ROOT . $module . DIRECTORY_SEPARATOR . $post;
        }
        else{//our module has another module as post-dependency
            foreach($modules[$post]['post-process'] as $dep_post){
                require MODULES_ROOT . $post . DIRECTORY_SEPARATOR . $dep_post;

            }
        }
    }
}
