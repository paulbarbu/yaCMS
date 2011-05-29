<?php
return array(
	'home' => array(
		'title' => 'Home',
		'content' => 'home.php',
	),
	'upload' => array(
	    'title' => 'Upload',
            'content' => 'upload_content.php',
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
            'preprocess' => array(
                'text_const' => 'text_const.php',
                'text' => 'text.php',
            ),
        ),
);
