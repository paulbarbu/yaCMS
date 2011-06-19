<?php

const BASE_DIR = __DIR__;

require_once '.' . DIRECTORY_SEPARATOR . 'functions.php';
require_once '.' . DIRECTORY_SEPARATOR . 'global_const.php';
$modules = require_once '.' . DIRECTORY_SEPARATOR . 'modules.php';

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
    $module = 'gbook';
}

if(isset($modules[$module]['pre-process']) && !empty($modules[$module]['pre-process'])){
    foreach($modules[$module]['pre-process'] as $pre){
        if(FALSE != stristr($pre, '.php')){
            require BASE_DIR . DIRECTORY_SEPARATOR . 'modules'
            . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . $pre;
        }
        else{//our module has another module as pre-dependency
            foreach($modules[$pre]['pre-process'] as $dep_pre){
                require BASE_DIR . DIRECTORY_SEPARATOR . 'modules'
                . DIRECTORY_SEPARATOR . $pre . DIRECTORY_SEPARATOR . $dep_pre;

            }
        }
    }
}

if(isset($modules[$module]['BL'])){
    foreach($modules[$module]['BL'] as $blName => $blFile){
        $feedback[$blName] = require BASE_DIR . DIRECTORY_SEPARATOR . 'modules'
            . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . $blFile;
    }
}

render('layout.php', compact('module', 'feedback', 'modules'));

if(isset($modules[$module]['post-process']) && !empty($modules[$module]['post-process'])){
    foreach($modules[$module]['post-process'] as $post){
        if(FALSE != stristr($post, '.php')){
            require BASE_DIR . DIRECTORY_SEPARATOR . 'modules'
            . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . $post;
        }
        else{//our module has another module as post-dependency
            foreach($modules[$post]['post-process'] as $dep_post){
                require BASE_DIR . DIRECTORY_SEPARATOR . 'modules'
                . DIRECTORY_SEPARATOR . $post . DIRECTORY_SEPARATOR . $dep_post;

            }
        }
    }
}
