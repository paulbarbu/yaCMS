<?php
/**
 * @file index.php
 * @brief Everything connects and is connected here
 *
 * @author paullik
 *
 * @mainpage
 *
 * @section yaCMS
 * A learning project developed while learning at
 * <a href="https://github.com/OriginalCopy/yap-phpro-book" title="yap-phpro">yap-phpro</a>
 *
 * @section Modules
 * This CMS is mainly module based, login, logout, and every other functionality
 * is based on these(and other) modules.
 *
 * @section Adding modules
 * @b 1. First off you have to add your new module's metadata and data in
 * @c /src/modules.php (please read modules.php page)
 *
 * @b 2. In @c /src/modules/ you have to create a folder named like your module's name
 * and in that folder you have to create all the files specified in @c modules.php
 *
 * @b 3. See the result by accessing: @c index.php?show=your_new_module
 *
 * @section License
 * (C) Copyright 2011 PauLLiK
 *
 * This program is free software: you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or (at your option) any later
 * version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program. If not, see http://www.gnu.org/licenses/.
 */

/**
 * The base directory of the application
 */
define('BASE_DIR', __DIR__ . DIRECTORY_SEPARATOR);

require_once BASE_DIR . 'functions.php';
require_once BASE_DIR . 'global_const.php';

/**
 * Main module structure loaded from modules.php
 */
$modules = require_once BASE_DIR . 'modules.php';

/**
 * Data received from the BL
 */
$feedback = array();

/**
 * Data received from pre-loading a module
 */
$feedback_pre = array();

/**
 * A semaphor variable to check whether a module needs reloading or not
 *
 * This variable is changed by a module
 */
$reload = FALSE;

/**
 * Container for @p render()'s retval
 */
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
                echo ERR_LOAD_FILE;
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
            echo ERR_LOAD_FILE;
            exit();
        }
    }
}

if($reload){
    $reload = FALSE;
    goto load_module;
}

$rendered = render('layout.php', compact('module', 'feedback', 'modules', 'feedback_pre'));

switch($rendered){
    case RENDER_ERR_NO_FILE: echo 'No page to display! - ' , RENDER_ERR_NO_FILE;
        break;
    case RENDER_ERR_FILE: echo 'Cound not read the file! - ' , RENDER_ERR_FILE;
        break;
    default;
}

if(isset($modules[$module]['post-process']) && !empty($modules[$module]['post-process'])){
    foreach($modules[$module]['post-process'] as $post){
        if(FALSE != stristr($post, '.php')){
            if(file_exists(MODULES_ROOT . $module . DIRECTORY_SEPARATOR . $post) &&
               is_readable(MODULES_ROOT . $module . DIRECTORY_SEPARATOR . $post)){
                require_once MODULES_ROOT . $module . DIRECTORY_SEPARATOR . $post;
            }
            else{
                echo ERR_LOAD_FILE;
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
