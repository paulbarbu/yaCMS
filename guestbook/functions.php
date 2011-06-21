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
 * string build_menu_from_modules(array $modules, string $currentModule)
 *
 * this function will build an HTMl menu based on the array received as
 * parameter and will return it as a string
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
 * array find_files_by_mime($path, $mime)
 *
 * searches recursively in the path provided by $path the files which have the
 * MIME type set to $mime
 *
 * @param string $path path to a directory
 * @param string $mime MIME type to be matched
 * @param bool $recursive search recursively or not in the provided directory
 * (default: TRUE)
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
 * array csv_search(resource $file_handle, int $column, string $criteria)
 *
 * Read line by line the file stored in $file_handle and search on the $column
 * the $criteria.
 * The $column is the number of CSV separator + 1, example:
 * john|31
 * Here the CSV separator is | and "31" is on the second column, because it is
 * found after the first separator
 *
 * $line represents one line from the CSV file to be checked against $criteria
 *
 * Returns the line containing the $criteria as array if $criteria was found otherwise
 * FALSE
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
