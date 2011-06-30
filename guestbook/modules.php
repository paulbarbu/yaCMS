<?php
/**
 * Module list
 *
 * A configuration file to hold all available modules
 * From this file a menu is build and pages are loaded
 *
 * Every module's structure must be compilant with the following example:
 *
 * 'module_name' => array(
 *      'pre-process' => array(
 *          'script_meta_info' => 'script_name.php',
 *          'module_meta_info' => 'module_name',
 *          'more_meta_info_here' => 'more_modules_to_load',
 *      ),
 *      'VL' => array(
 *          'title' => 'Module Title',
 *          'content' => 'VL_script_name',
 *          'show_in_menu' => <bool value>,
 *          'login_need' => <bool value>,
 *      ),
 *      'BL' => array(
 *          'script_meta_name' => 'name.php',
 *          'script_meta_name2' => 'name_other.php',
 *          'more_script_meta_here' => 'more_BL_scripts_to_load',
 *      ),
 *      'post-process' => array(
 *          'script_meta_info' => 'script_name.php',
 *          'module_meta_info' => 'module_name',
 *          'more_meta_info_here' => 'more_modules_to_load',
 *      ),
 * ),
 *
 * So every module is a dictionary of MAXIMUM four dictionaries.
 * The example shown above is a MAXIMUM of what a module can contain, except for
 * the pre-preprocess, BL, and post-process, these parts can contain a
 * never-ending set of scripts, more on this later.
 *
 * 'module_name' ->
 *      Represents the name which will be shown in the URL '?show='
 *      part and the name by which it will be recognizable by other modules
 *
 * 'pre-process' ->
 *      This part of the module is optional, it's required when the module needs
 *      some pre-processing(e.g.: logging in a user), here simple scripts can be
 *      loaded(if the *.php extension is set on the name part) or whole modules
 *      if there is no extension set, of course the module needed is searched in
 *      this file, if it's found it's 'pre-process' part is loaded before the
 *      callee is loaded.
 *      Here an undetermined number of modules/scripts can be loaded.
 * Example:
 *      'pre-process' => array(
 *          'foo_script' => 'foo.php',
 *          'login' => 'login_user',
 *      ),
 *      In this example 2 things are pre-loaded, the 'foo.php' script and the
 *      pre-process part of the 'login_user' module
 *
 * 'post-process' ->
 *      Acts the same as 'pre-process', the only differece being that the
 *      scripts/modules are post-loaded, so they are loaded after the callee has
 *      made his job. For post-loading modules the same rule applies: only the
 *      post-process part of the modul is loaded after the callee
 *
 *
 *
 */

return array(
    'home' => array(
        'pre-process' => array(
            'autologin' => 'login_user',
        ),
        'VL' => array(
            'title' => 'Home',
            'content' => 'content.php',
        ),
    ),
    'gbook' => array(
        'pre-process' => array(
            'autologin' => 'login_admin',
        ),
        'VL' => array(
            'title' => 'G - book',
            'content' => 'content.php',
        ),
        'BL' => array(
            'gbook_const' => 'constants.php',
            'gbook_func' => 'functions.php',
            'gbook' => 'gbook.php',
        ),
    ),
    'gbook_panel' => array(
        'pre-process' => array(
            'autologin' => 'login_admin'
        ),
        'VL' => array(
            'title' => 'Admin panel',
            'content' => 'content.php',
            'show_in_menu' => FALSE,
            'login_need' => TRUE,
        ),
        'BL' => array(
            'const' => 'constants.php',
            'func' => 'functions.php',
            'panel' => 'panel.php',
        ),
    ),
    'login_admin' => array(
        'pre-process' => array(
            'autologin' => 'autologin.php',
        ),
        'VL' => array(
            'title' => 'Admin Log In',
            'content' => 'content.php',
            'show_in_menu' => FALSE,
        ),
        'BL' => array(
            'login_const' => 'constants.php',
            'login' => 'login.php',
        ),
    ),
    'logout_admin' => array(
        'pre-process' => array(
            'autologin_admin' => 'login_admin',
        ),
        'VL' => array(
            'title' => 'Admin logged out',
            'content' => 'content.php',
            'show_in_menu' => FALSE,
        ),
        'BL' => array(
            'logout' => 'logout.php'
        ),
    ),
    '404' => array(
        'VL' => array(
            'title' => 'Inexistent page',
            'content' => 'content.php',
            'show_in_menu' => FALSE,
            'custom' => TRUE,
        ),
        'BL' => array(
            'notfound' => '404.php',
        ),
    ),
    'login_user' => array(
        'pre-process' => array(
            'autologin' => 'autologin.php',
        ),
        'VL' => array(
            'title' => 'User Log in',
            'content' => 'content.php',
            'show_in_menu' => FALSE,
        ),
        'BL' => array(
            'login_const' => 'constants.php',
            'login' => 'login.php',
        ),

    ),
    'logout_user' => array(
        'pre-process' => array(
            'autologin_user' => 'login_user',
        ),
        'VL' => array(
            'title' => 'User logged out',
            'content' => 'content.php',
            'show_in_menu' => FALSE,
        ),
        'BL' => array(
            'logout' => 'logout.php'
        ),
    ),
    'gallery' => array(
        'pre-process' => array(
            'autologin_user' => 'login_user',
        ),
        'VL' => array(
            'title' => 'Gallery',
            'content' => 'content.php',
            'login_need' => TRUE,
        ),
        'BL' => array(
            'const' => 'constants.php',
            'gallery' => 'gallery.php',
        ),
    ),
    'text' => array(
        'pre-process' => array(
            'autologin' => 'login_user',
        ),
        'VL' => array(
            'title' => 'Text edit',
            'content' => 'content.php',
            'login_need' => TRUE,
        ),
        'BL' => array(
            'const' => 'constants.php',
            'text' => 'text.php',
        ),
    ),
    'upload' => array(
        'pre-process' => array(
            'autologin' => 'login_user',
        ),
        'VL' => array(
            'title' => 'Upload',
            'content' => 'content.php',
            'login_need' => TRUE,
        ),
        'BL' => array(
            'const' => 'constants.php',
            'upload' => 'upload.php'
        ),
    ),
);
