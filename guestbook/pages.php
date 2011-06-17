<?php
/**
 * Page list
 */
return array(
    'gbook' => array(
        'title' => 'G - book',
        'content' => 'gbook_content.php', //VL depending on the state, if admin is logged in or not
        'preprocess' => array(
            'gbook_func' => 'gbook_func.php',
            'gbook_const' => 'gbook_const.php',
            'gbook' => 'gbook.php',
            'gbook_admin' => 'gbook_admin.php', //BL for admin page
        ),
    ),
    'notfound' => array(
        'title' => 'Inexistent page',
        'content' => 'notfound.php',
    ),
);
