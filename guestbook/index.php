<?php

define('BASE_DIR', __DIR__ . DIRECTORY_SEPARATOR);

require_once BASE_DIR . 'functions.php';
require_once BASE_DIR . 'global_const.php';

$modules = require_once BASE_DIR . 'modules.php';

$feedback = array();
$feedback_pre = array();

$reload = FALSE;
$rendered = NULL;

if(isset($_GET['show'])){
    if(array_key_exists($_GET['show'], $modules)){
        $module = $_GET['show'];
    }
    else{
        $module = '404';
    }
}
else{
    foreach($modules as $candidate => $candidate_content){
        if(!isset($candidate_content['VL']['show_in_menu'])){
            $module = $candidate;
            break;
        }
        elseif(TRUE == $candidate_content['VL']['show_in_menu']){
            $module = $candidate;
            break;
        }
    }
}

load_module:
if(isset($modules[$module]['pre-process']) && !empty($modules[$module]['pre-process'])){
    foreach($modules[$module]['pre-process'] as $pre_key => $pre){
        if(FALSE != stristr($pre, '.php')){
            if(file_exists(MODULES_ROOT . $module . DIRECTORY_SEPARATOR . $pre) &&
                is_readable(MODULES_ROOT . $module . DIRECTORY_SEPARATOR . $pre)){
                $feedback_pre[$pre_key] = require_once MODULES_ROOT . $module . DIRECTORY_SEPARATOR . $pre;
            }
            else{
                echo ERR_LOAD_FILE . MODULES_ROOT . $module . DIRECTORY_SEPARATOR . $pre;
                exit();
            }
        }
        else{//our module has another module as pre-dependency
            foreach($modules[$pre]['pre-process'] as $dep_pre_key => $dep_pre){
                $feedback_pre[$dep_pre_key] = require_once MODULES_ROOT . $pre . DIRECTORY_SEPARATOR . $dep_pre;

            }
        }
    }
}

/**
 * Load BL
 */
if(isset($modules[$module]['BL'])){
    foreach($modules[$module]['BL'] as $blName => $blFile){
        if(file_exists(MODULES_ROOT . $module . DIRECTORY_SEPARATOR . $blFile) &&
            is_readable(MODULES_ROOT . $module . DIRECTORY_SEPARATOR . $blFile)){
            $feedback[$blName] = require_once MODULES_ROOT . $module . DIRECTORY_SEPARATOR . $blFile;
        }
        else{
            echo ERR_LOAD_FILE . MODULES_ROOT . $module . DIRECTORY_SEPARATOR . $blFile;
            exit();
        }
    }
}

if($reload){
    $reload = FALSE;
    goto load_module;
}

if(file_exists('layout.php') && is_readable('layout.php')){

    $rendered = render('layout.php', compact('module', 'feedback', 'modules', 'feedback_pre'));

    switch($rendered){
        case RENDER_ERR_NO_FILE: echo 'No page to display! - ' , RENDER_ERR_NO_FILE;
            break;
        case RENDER_ERR_FILE: echo 'Cound not read the file! - ' , RENDER_ERR_FILE;
            break;
        default;
    }
}
else{
    echo ERR_LOAD_FILE . 'layout.php';
    exit();
}


if(isset($modules[$module]['post-process']) && !empty($modules[$module]['post-process'])){
    foreach($modules[$module]['post-process'] as $post){
        if(FALSE != stristr($post, '.php')){
            if(file_exists(MODULES_ROOT . $module . DIRECTORY_SEPARATOR . $post) &&
               is_readable(MODULES_ROOT . $module . DIRECTORY_SEPARATOR . $post)){
                require_once MODULES_ROOT . $module . DIRECTORY_SEPARATOR . $post;
            }
            else{
                echo ERR_LOAD_FILE . MODULES_ROOT . $module . DIRECTORY_SEPARATOR . $post;
                exit();
            }
        }
        else{//our module has another module as post-dependency
            foreach($modules[$post]['post-process'] as $dep_post){
                require_once MODULES_ROOT . $post . DIRECTORY_SEPARATOR . $dep_post;

            }
        }
    }
}
