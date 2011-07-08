<?php
/**
 * @file src/functions.php
 * @brief Global scope functions
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
 *
 * @return string representing the menu's HTML code
 */
function build_menu_from_modules($modules, $currentModule){
    $menu = '<ul>' .PHP_EOL;
    foreach($modules as $moduleName => $metaData){
        if(!isset($modules[$moduleName]['VL']['show_in_menu']) ||
            FALSE != $modules[$moduleName]['VL']['show_in_menu']){
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
 * @param bool $recursive search recursively or not in the provided directory
 *
 * @return array $files containing the the directory name as key and the
 * path to the file as the value
 */
function find_files_by_mime($path, $mime, $recursive = TRUE){
    $files = array();
    $finfo = finfo_open(FILEINFO_MIME_TYPE);

    if(DIRECTORY_SEPARATOR == substr($path, -1)){
        $path = substr($path, 0, strlen(path)-2);
    }

    if(is_dir($path)){
        $d = opendir($path);

        while($entry = readdir($d)){
            $mime_type = finfo_file($finfo, $path . DIRECTORY_SEPARATOR . $entry);

            if("." != $entry && ".." != $entry){

                if(is_dir($path . DIRECTORY_SEPARATOR . $entry) && $recursive){
                    $files =  array_unique(array_merge(find_files_by_mime(
                        $path . DIRECTORY_SEPARATOR . $entry, $mime), $files));
                }
                elseif(FALSE !== stristr($mime_type, $mime)){
                        $files[] = $path . DIRECTORY_SEPARATOR . $entry;
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
