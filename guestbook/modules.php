<?php
/**
 * Module list
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
            'content' => 'content.php',
        ),
        'BL' => array(
            'gbook_const' => 'constants.php',
            'gbook_func' => 'functions.php',
            'gbook' => 'gbook.php',
        ),
        'post-process' => array(
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
        ),
        'BL' => array(
            'const' => 'constants.php',
            'func' => 'functions.php',
            'panel' => 'panel.php',
        ),
        'post-process' => array(
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
        'post-process' => array(
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
        'post-process' => array(
        ),
    ),
    'notfound' => array(
        'pre-process' => array(
        ),
        'VL' => array(
            'title' => 'Inexistent page',
            'content' => 'notfound.php',
            'show_in_menu' => FALSE,
        ),
        'BL' => array(
        ),
        'post-process' => array(
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
        'post-process' => array(
        ),
    ),
    'gallery' => array(
        'pre-process' => array(
            'autologin_user' => 'login_user',
        ),
        'VL' => array(
            'title' => 'Gallery',
            'content' => 'content.php',
        ),
        'BL' => array(
            'const' => 'constants.php',
            'gallery' => 'gallery.php',
        ),
    ),
);
