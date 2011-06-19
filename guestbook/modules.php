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
            'content' => 'gbook_content.php',
        ),
        'BL' => array(
            'gbook_func' => 'gbook_func.php',
            'gbook_const' => 'gbook_const.php',
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
            'content' => 'gbook_panel_content.php',
        ),
        'BL' => array(
            'gbook_panel_func' => 'gbook_panel_func.php',
            'gbook_panel_const' => 'gbook_panel_const.php',
            'gbook_panel' => 'gbook_panel.php',
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
            'content' => 'login_content.php',
        ),
        'BL' => array(
            'login_const' => 'login_const.php',
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
            'content' => 'logout_content.php',
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
