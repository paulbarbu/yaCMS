<?php
/**
 * Module list
 */
return array(
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
        ),
        'BL' => array(
            'gbook_panel_const' => 'constants.php',
            'gbook_panel_func' => 'functions.php',
            'gbook_panel' => 'panel.php',
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
        ),
        'BL' => array(
            'login_const' => 'constants.php',
            'login' => 'login.php',
        ),
        'post-process' => array(
        ),
    ),
    'logout' => array(
        'pre-process' => array(
            'autologin' => 'login_admin'
        ),
        'VL' => array(
            'title' => 'Log out',
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
);
