<?php
/**
 * Module list
 *
 * A configuration file to hold all available modules
 * From this file a menu is build and pages are loaded
 */
return array(
    'home' => array(
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
            'content' => 'gb_content.php',
        ),
        'BL' => array(
            'gbook_const' => 'gb_constants.php',
            'gbook_func' => 'gb_functions.php',
            'gbook' => 'gbook.php',
        ),
    ),
    'gbook_panel' => array(
        'pre-process' => array(
            'autologin' => 'login_admin'
        ),
        'VL' => array(
            'title' => 'Admin panel',
            'content' => 'gp_content.php',
            'show_in_menu' => FALSE,
            'login_need' => TRUE,
        ),
        'BL' => array(
            'const' => 'gp_constants.php',
            'func' => 'gp_functions.php',
            'panel' => 'panel.php',
        ),
    ),
    'login_admin' => array(
        'pre-process' => array(
            'autologin' => 'autologin_admin.php',
        ),
        'VL' => array(
            'title' => 'Admin Log In',
            'content' => 'lia_content.php',
            'show_in_menu' => FALSE,
        ),
        'BL' => array(
            'login_const' => 'lia_constants.php',
            'login' => 'login_admin.php',
        ),
    ),
    'logout_admin' => array(
        'pre-process' => array(
            'autologin_admin' => 'login_admin',
        ),
        'VL' => array(
            'title' => 'Admin logged out',
            'content' => 'loa_content.php',
            'show_in_menu' => FALSE,
        ),
        'BL' => array(
            'logout' => 'logout_admin.php'
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
            'autologin' => 'autologin_user.php',
        ),
        'VL' => array(
            'title' => 'User Log in',
            'content' => 'liu_content.php',
            'show_in_menu' => FALSE,
        ),
        'BL' => array(
            'login_const' => 'liu_constants.php',
            'login' => 'login_user.php',
        ),

    ),
    'logout_user' => array(
        'pre-process' => array(
            'autologin_user' => 'login_user',
        ),
        'VL' => array(
            'title' => 'User logged out',
            'content' => 'lou_content.php',
            'show_in_menu' => FALSE,
        ),
        'BL' => array(
            'logout' => 'logout_user.php'
        ),
    ),
    'gallery' => array(
        'pre-process' => array(
            'autologin_user' => 'login_user',
        ),
        'VL' => array(
            'title' => 'Gallery',
            'content' => 'g_content.php',
            'login_need' => TRUE,
        ),
        'BL' => array(
            'const' => 'g_constants.php',
            'gallery' => 'gallery.php',
        ),
    ),
);
