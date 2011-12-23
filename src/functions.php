<?php
/**
 * @file src/functions.php
 * @brief Global scope functions
 * @author Paul Barbu
 * @ingroup kernelFiles
 */

/**
 * @addtogroup globalConstants
 * @{
 */

/**
 * File rendered
 */
const RENDER_OK = 0;

/**
 * No file to render
 */
const RENDER_ERR_NO_FILE = 1;

/**
 * File not readable
 */
const RENDER_ERR_FILE = 2;

/**
 * @}
 */
/**
 * @defgroup functions Functions
 * @defgroup globalFunctions Global Functions
 * @ingroup functions
 * @{
 */

/**
 * Used to convert a shorthand notation like 2M in bytes.
 * Please visit: http://www.php.net/manual/en/function.ini-get.php
 *
 * @param string $val shortnotation (e.g. "2M")
 *
 * @return bytes representation of the shorthand notation
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
 * Creates variables that are necessary for including the file specified by
 * $template and includes it
 *
 * @param string $template path to the file to be required
 * @param array $vars associative array containing variable names needed by
 * $template, default NULL(none)
 *
 * @return returns a status code, if it's the case that status coude is an
 * error
 */
function render($template, $vars = NULL){
    if($vars){
        extract($vars);
    }

    if(!file_exists($template)){
        return RENDER_ERR_NO_FILE;
    }

    if(!is_readable($template)){
        return RENDER_ERR_FILE;
    }

    require $template;

    return RENDER_OK;
}

/**
 * Builds a HTML menu based on the array received as
 * parameter and will return it as a string
 *
 * @param array $modules array to get menu entries from
 * @param string $currentModule name of the module not to wrap in <a> tags
 * @param callback $cb a callback for checking is the user is logged in or not
 *
 * @return string representing the menu's HTML code
 */
function build_menu_from_modules($modules, $currentModule, $cb = NULL){
    $menu = '<ul>' .PHP_EOL;
    foreach($modules as $moduleName => $metaData){
        if((!isset($modules[$moduleName]['VL']['show_in_menu']) ||
            FALSE != $modules[$moduleName]['VL']['show_in_menu']) &&
            (
            (isset($modules[$moduleName]['VL']['login_need']) &&
            $modules[$moduleName]['VL']['login_need'] == TRUE &&
            $cb != NULL && $cb()) ||

            !(isset($modules[$moduleName]['VL']['login_need']) &&
            TRUE == $modules[$moduleName]['VL']['login_need'])
            )
        ){

                if($moduleName == $currentModule){
                    $menu .= '<li>' .$metaData['VL']['title']. '</li>' .PHP_EOL;
                }
                else{
                    $menu .= '<li><a href="?show=' . $moduleName . '">'
                        . $metaData['VL']['title'] . '</a></li>' . PHP_EOL;
                }
        }
    }
    $menu .= '</ul>' .PHP_EOL;

    return $menu;
}

/**
 * Searches recursively in the path provided by $path the files which have the
 * MIME type set to $mime
 *
 * @param string $path path to a directory
 * @param string $mime MIME type to be matched
 * @param bool $recursive if TRUE searches recursively
 *
 * @return array $files containing the path to the files
 */
function find_files_by_mime($path, $mime, $recursive = TRUE){
    $files = array();
    $finfo = finfo_open(FILEINFO_MIME_TYPE);

    if(DIRECTORY_SEPARATOR != substr($path, -1)){
        $path .= DIRECTORY_SEPARATOR;
    }

    if(is_dir($path)){
        $d = opendir($path);

        while($entry = readdir($d)){
            $mime_type = finfo_file($finfo, $path . $entry);

            if("." != $entry && ".." != $entry){

                if(is_dir($path . $entry) && $recursive){
                    $files =  array_unique(array_merge(find_files_by_mime(
                        $path . $entry, $mime), $files));
                }
                elseif(FALSE !== stristr($mime_type, $mime)){
                        $files[] = $path . $entry;
                }

            }
        }

        closedir($d);
    }

    return $files;
}

/**
* Read line by line the file stored in $file_handle and search on the $column
* specified by $criteria.
*
* The $column is the number of CSV separator + 1, example:
*
* @c john|31
*
* Here the CSV separator is | and "31" is on the second column, because it is
* found after the first separator
*
* @param resource $fh file stream for reading the comma separated values
* @param int $column colum to read the data from
* @param string $criteria string to be found
*
* @return the line as an array containing the
* $criteria if $criteria was found, otherwise FALSE
*/
function csv_search($fh, $column, $criteria){
$line = array();

while(FALSE !== ($line = fgetcsv($fh, 1000))){
    if($criteria == $line[$column]){
        return $line;
    }
}

return FALSE;
}

/**
 * app_path()
 *
 * Get the application's directory on the server
 *
 * @return the path to the directory where the application runs
 */
function app_path(){
    $pos = strrpos($_SERVER['REQUEST_URI'], DIRECTORY_SEPARATOR);
    $path = substr($_SERVER['REQUEST_URI'], 0, $pos);

    return $path;
}

/**
 * Get (in a recursive manner) a module's dependendencies
 *
 * Walk the dependency arrays and push every file path onto a stack
 *
 * @param array $modules the complete list of modules
 * @param array $module of which the deps should be loaded
 * @param array $modules_root path to the directory where the modules lay(with a
 * DIRECTORY_SEPARATOR at the end)
 * @param array $stack the stack that will store the paths to the dependencies
 * @param string $part get either post-process or pre-process dependencies
 *
 * @return $stack return the complete list of dependencies
 */
function get_deps($modules, $module, $modules_root, $part = 'pre-process', $stack = array()){
    foreach($modules[$module][$part] as $meta => $dep){
        if(FALSE != stristr($dep, '.php')){
            $stack[] = array($meta => $modules_root . $module . DIRECTORY_SEPARATOR . $dep);
        }
        else{
            $stack = get_deps($modules, $dep, $modules_root, $part, $stack);
        }
    }

    return $stack;
}

/**
 * Load a module's dependencies
 *
 * @param $stack the stack of dependencies genereted by load_deps()
 * @param array $vars associative array containing variable names needed by
 * the dependencies, default NULL(none)
 *
 * @return ERR_LOAD_FILE if a dependency could not be loaded, else a dictionary
 * consisting of the keys in the stack associated with the dependencies retvals
 */
function load_deps($stack, $vars = NULL){
    $result = array();

    if($vars){
        extract($vars);
    }

    foreach($stack as $dep){
        foreach($dep as $meta => $dep_file){
            if(file_exists($dep_file) && is_readable($dep_file)){
                $result[$meta] = require $dep_file;
            }
            else{
                return ERR_LOAD_FILE;
            }
        }
    }

    return $result;
}

/**
 * @}
 */
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
