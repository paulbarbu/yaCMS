<?php
return array(
    'home' => array(
        'title' => 'Home',
        'content' => 'home.php',
    ),
    'upload' => array(
        'title' => 'Upload',
        'content' => 'upload_content.php',
        'login' => TRUE,
        'preprocess' => array(
            'upload_const' => 'upload_const.php',
            'upload' => 'upload.php',
        ),
    ),
    'notfound' => array(
        'title' => 'Inexistent page',
        'content' => 'notfound.php',
    ),
    'text' => array(
        'title' => 'Edit your text',
        'content' => 'text_content.php',
        'login' => TRUE,
        'preprocess' => array(
            'text_const' => 'text_const.php',
            'text' => 'text.php',
        ),
    ),
    'login' => array(
        'title' => 'Log In',
        'content' => 'login_content.php',
        'preprocess' => array(
            'login_const' => 'login_const.php',
            'login' => 'login.php',
        ),
    ),
    'logout' => array(
        'title' => 'Log out',
        'content' => 'logout_content.php',
        'preprocess' => array(
            'logout' => 'logout.php'
        ),
    ),
    'captcha' => array(
        'preprocess' => array(
            'captcha_img' => 'captcha_img.php',
        ),
    ),
    'gallery' => array(
        'title'=> 'Gallery',
        'content' => 'gallery_content.php',
        'login' => TRUE,
        'preprocess' => array(
            'gallery_const' => 'gallery_const.php',
            'gallery' => 'gallery.php',
        ),
    ),
);
