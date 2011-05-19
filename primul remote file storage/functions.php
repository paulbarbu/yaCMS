<?php
/**
 * int return_bytes( string $val)
 * 
 * this function is used to converd a shorthand notation like 2M in bytes
 * please visit: http://www.php.net/manual/en/function.ini-get.php
 */
function return_bytes($val) {
	$val = trim($val);
	$last = $val[strlen($val)-1];
	
	switch($last) {
		case 'g':
		case 'G':
			$val *= 1024;
		case 'm':
		case 'M':
			$val *= 1024;
		case 'k':
		case 'K':
			$val *= 1024;
	}
	return $val;
}

/**
 * void render(string $template, array $vars = NULL)
 * 
 * this function will take a path as first parameter and 
 * an associative array as second, from the array the function will create
 * variables that are necessary for including the file specified by $template
 */
function render($template, $vars = NULL){
	if($vars){
		extract($vars);
	}
	require $template;
}

/**
 * string build_menu_from_pages(array $pages, string $currentPage)
 *
 * this function will build an HTMl menu based on the array received as 
 * parameter and will return it as a string
 */
function build_menu_from_pages($pages, $currentPage){
	$menu = '<ul>' .PHP_EOL;
	foreach($pages as $pageName => $metaData){
		if($pageName != 'notfound'){
			if($pageName == $currentPage){
				$menu .= '<li>' .$metaData['title']. '</li>' .PHP_EOL;
			}
			else{
				$menu .= '<li><a href="?show=' .$pageName. '">' .$metaData['title']. '</a></li>' .PHP_EOL;
			}
		}
	}
	$menu .= '</ul>' .PHP_EOL;
	
	return $menu;
}
