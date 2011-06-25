<?php
/**
 * Module list
 *
 * A configuration file to hold all available modules
 * From this file a menu is build and pages are loaded
 */
return array(
    'home' => array(
        'pre-process' => array(
            'autologin' => 'login_user',
        ),
        'VL' => array(
            'title' => 'Home',
            'content' => 'content.php',
        ),
    ),
    'gbook' => array(
        'pre-process' => array(
            'autologin' => 'login_admin',
        ),
        'VL' => array(
            'title' => 'G - book',
            'content' => 'content.php',
        ),
        'BL' => array(
            'gbook_const' => 'constants.php',
            'gbook_func' => 'functions.php',
            'gbook' => 'gbook.php',
        ),
    ),
    'gbook_panel' => array(
        'pre-process' => array(
            'autologin' => 'login_admin'
        ),
        'VL' => array(
            'title' => 'Admin panel',
            'content' => 'content.php',
            'show_in_menu' => FALSE,
            'login_need' => TRUE,
        ),
        'BL' => array(
            'const' => 'constants.php',
            'func' => 'functions.php',
            'panel' => 'panel.php',
        ),
    ),
    'login_admin' => array(
        'pre-process' => array(
            'autologin' => 'autologin.php',
        ),
        'VL' => array(
            'title' => 'Admin Log In',
            'content' => 'content.php',
            'show_in_menu' => FALSE,
        ),
        'BL' => array(
            'login_const' => 'constants.php',
            'login' => 'login.php',
        ),
    ),
    'logout_admin' => array(
        'pre-process' => array(
            'autologin_admin' => 'login_admin',
        ),
        'VL' => array(
            'title' => 'Admin logged out',
            'content' => 'content.php',
            'show_in_menu' => FALSE,
        ),
        'BL' => array(
            'logout' => 'logout.php'
        ),
    ),
    '404' => array(
        'VL' => array(
            'title' => 'Inexistent page',
            'content' => 'content.php',
            'show_in_menu' => FALSE,
            'custom' => TRUE,
        ),
        'BL' => array(
            'notfound' => '404.php',
        ),
    ),
    'login_user' => array(
        'pre-process' => array(
            'autologin' => 'autologin.php',
        ),
        'VL' => array(
            'title' => 'User Log in',
            'content' => 'content.php',
            'show_in_menu' => FALSE,
        ),
        'BL' => array(
            'login_const' => 'constants.php',
            'login' => 'login.php',
        ),

    ),
    'logout_user' => array(
        'pre-process' => array(
            'autologin_user' => 'login_user',
        ),
        'VL' => array(
            'title' => 'User logged out',
            'content' => 'content.php',
            'show_in_menu' => FALSE,
        ),
        'BL' => array(
            'logout' => 'logout.php'
        ),
    ),
    'gallery' => array(
        'pre-process' => array(
            'autologin_user' => 'login_user',
        ),
        'VL' => array(
            'title' => 'Gallery',
            'content' => 'content.php',
            'login_need' => TRUE,
        ),
        'BL' => array(
            'const' => 'constants.php',
            'gallery' => 'gallery.php',
        ),
    ),
    'text' => array(
        'pre-process' => array(
            'autologin' => 'login_user',
        ),
        'VL' => array(
            'title' => 'Text edit',
            'content' => 'content.php',
            'login_need' => TRUE,
        ),
        'BL' => array(
            'const' => 'constants.php',
            'text' => 'text.php',
        ),
    ),
);
