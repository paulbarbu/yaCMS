<?php
/**
 * Page list
 */
return array(
    'gbook' => array(
        'title' => 'G - book',
        'content' => 'gbook_content.php',
        'preprocess' => array(
            'gbook_func' => 'gbook_func.php',
            'gbook_const' => 'gbook_const.php',
            'gbook' => 'gbook.php',
        ),
    ),
    'notfound' => array(
        'title' => 'Inexistent page',
        'content' => 'notfound.php',
        'show_in_menu' => FALSE,
    ),
    'gbook_admin' => array(
        'title' => 'Admin panel',
        'content' => 'gbook_admin_content.php',
        'preprocess' => array(
            'gbook_admin_func' => 'gbook_admin_func.php',
            'gbook_admin_const' => 'gbook_admin_const.php',
            'gbook_admin' => 'gbook_admin.php',
            'gbook_controls' => 'gbook_controls.php'
        ),
        'show_in_menu' => FALSE,
    ),
     'logout' => array(
        'title' => 'Log out',
        'content' => 'logout_content.php',
        'preprocess' => array(
            'logout' => 'logout.php'
        ),
        'show_in_menu' => FALSE,
    ),
);
