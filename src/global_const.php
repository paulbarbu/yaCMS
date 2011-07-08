<?php
/**
 * @file global_const.php
 * @brief Global constants
 * @author paullik
 */

/**
 * Modules directory
 */
define('MODULES_ROOT', BASE_DIR . 'modules' . DIRECTORY_SEPARATOR);

/**
 * Data directory, all modules should
 * place configuration files and databases at this location
 */
define('DATA_ROOT', BASE_DIR . 'data' . DIRECTORY_SEPARATOR);

/**
 * Uploads directory, every upload
 * should be placed at the location pointed by this string
 */
define('UPLOADS_ROOT', 'uploads' . DIRECTORY_SEPARATOR);


/**
 * A file cannot be included
 */
const ERR_LOAD_FILE = 'Cannot use current file, it does not exists or it\'s not
    readable, check your modules! <br /> <a href="javascript:history.go(-1)">
    Go back!</a>';

