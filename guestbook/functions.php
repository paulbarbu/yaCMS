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
 * array list_text_files($path)
 *
 * searches recursively in the path provided by the only parameter the files
 * which have the MIME type set to 'text/plain'
 *
 * returns an array containing the secret name of the directory as key and the
 * path to the file as the value
 */
function list_text_files($path){
    $files = array();

    if(is_dir($path)){
        $d = opendir($path);

        while($entry = readdir($d)){
            if("." != $entry && ".." != $entry){
                if(is_dir($path . DIRECTORY_SEPARATOR . $entry)) {
                    $files =  array_unique(array_merge(list_text_files(
                        $path . DIRECTORY_SEPARATOR . $entry), $files));
                }
                elseif('text/plain' == mime_content_type(
                    $path . DIRECTORY_SEPARATOR . $entry)){
                        $files[] = $entry;
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

/**
 * dir_type_check() checks if a directory is full of $type files or not
 *
 * @param resource $dir directory handle(created by opendir) you want to check
 * @param string $type file type to search into the mime type of the file
 * (default: image)
 * @param string $path path to directory opened in $dir_h
 * @return array|NULL array of strings containing the image names,
 * if the directory does not contain ONLY images then NULL is returned
 */

function dir_type_check($dir_h, $dir_name, $type = 'image'){
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $images = array();
    $num_files = 0;

    while($entry = readdir($dir_h)){
        if('.' != $entry && ".." != $entry && "users.csv" != $entry){
            $entry = '.' . DIRECTORY_SEPARATOR . 'uploads'
                . DIRECTORY_SEPARATOR . $dir_name . DIRECTORY_SEPARATOR . $entry;
            $mime_type = finfo_file($finfo, $entry);
            $num_files++;

            if(FALSE !== stristr($mime_type, $type)){
                $images[] = $entry;
            }
            else{
                return NULL;
            }
        }
    }

    finfo_close($finfo);

    return $num_files ? $images : NULL;
}

