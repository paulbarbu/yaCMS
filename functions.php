<?php
/**
 * void render(string $template, array $vars = NULL)
 * 
 * this function will take a path as first parameter and 
 * an associative array as second, from the array the function will create
 * variables that are necessary for includeing the file specified by $template
 */
function render($template, $vars = NULL){
	if($vars){
		extract($vars);
	}
	require $template;
}

/**
 * string build_menu_from_pages(array $pages)
 *
 * this function will build an HTMl menu based on the array received as 
 * parameter and will return it as a string
 */
function build_menu_from_pages($pages){
	$menu = '<ul>';
	foreach($pages as $pageName => $metaData){
		$menu .= '<li><a href="?show=' .$pageName. '">' .$metaData['title']. '</a></li>' .PHP_EOL;
	}
	$menu .= '</ul>' .PHP_EOL;
	
	return $menu;
}