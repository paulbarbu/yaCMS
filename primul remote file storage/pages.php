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
            'upload_const.php',
            'upload.php',
        ), 
	),
	'notfound' => array(
		'title' => 'Inexistent page',
		'content' => 'notfound.php',
	),
);
