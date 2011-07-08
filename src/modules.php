<?php
/**
 * @file modules.php
 * @brief A configuration file to hold all available modules, from this file a
 * menu is build and pages are loaded
 *
 * @author paullik
 *
 * Every module's structure must be compilant with the following example:
 *
 * @verbatim
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
 * ),@endverbatim
 *
 * So every module is a dictionary of MAXIMUM four dictionaries.
 * The example shown above is a MAXIMUM of what a module can contain, except for
 * the pre-preprocess, BL, and post-process, these parts can contain a
 * never-ending set of scripts, more on this later.
 *
 * @section module_name
 * Represents the name which will be shown in the URL @p ?show=
 * part and the name by which it will be recognizable by other modules
 *
 * @section pre-process
 * This part of the module is optional, it's required when the module needs
 * some pre-processing(e.g.: logging in a user), here simple scripts can be
 * loaded(if the @p *.php extension is set on the name part) or whole modules
 * if there is no extension set, of course the module needed is searched in
 * this file, if it's found it's @p pre-process part is loaded before the
 * callee is loaded.
 *
 * If a single script is to be pre-loaded then it is searched in the
 * current module's directory, if a module is to be loaded then it's loaded
 * from @p MODULES_ROOT
 *
 * An undetermined number of modules/scripts can be loaded.
 *
 * Example:
 * @verbatim
 * 'pre-process' => array(
 *      'foo_script' => 'foo.php',
 *      'login' => 'login_user',
 * ), @endverbatim
 *
 * In this example two things are pre-loaded, the @p foo.php script(from the
 * current module's directory) and the pre-process part of the @p login_user
 * module
 *
 * @section post-process
 * Acts the same as @p pre-process, the only differece being that the
 * scripts/modules are post-loaded, so they are loaded after the callee has
 * made his job. For post-loading modules the same rule applies: only the
 * post-process part of the module is loaded after the callee
 *
 * @section VL
 * Here you can set a predefined number of characteristics.
 * Entries available at the moment:
 *
 * @verbatim title @endverbatim The user will see this text as title
 *
 *
 * @verbatim content @endverbatim The VL script of the module found in the module's
 * directory
 *
 * @verbatim show_in_menu @endverbatim OPTIONAL - if it's not set the user will
 * see this module in the menu, if it's set to @p FALSE the user will not be able to
 * see it in the menu, else it will be shown
 *
 * @verbatim login_need @endverbatim OPTIONAL - if it's not set and a login
 * module is pre-loaded then it's optional to log in to use this module, if it's
 * set to @p TRUE then the login is mandatory
 *
 * Example:
 * @verbatim
 * 'VL' => array(
 *      'title' => 'BAR',
 *      'content' => 'vl_script.php',
 * ),
 * @endverbatim
 *
 * In this example the user will see the page's title as @e BAR and when
 * accessing the module the file @p vl_script.php will be loaded, in this
 * case loggin in to use the module is optional and the module will be
 * visible in the menu
 *
 * @verbatim
 * 'VL' => array(
 *     'title' => 'foo',
 *     'content' => 'content.php',
 *     'login_need' => TRUE,
 * ),
 * @endverbatim
 *
 * Here the title will be @p foo, the file @p content.php will be loaded and
 * the login is mandatory so this module must have a login module as
 * @p pre-process
 *
 * @section BL
 *
 * This part of a module holds the "brain", the business logic scripts.
 * An undefined number of @p *.php scripts can be loaded, all files are loaded
 * from the module's directory.
 * The key from the array is the name under which the VL part of the
 * module receives feedback after the script finished processing(giving
 * feedback is not mandatory e.g. constants or functions files)
 *
 * Example:
 * @verbatim
 * 'BL' => array(
 *      'constants' => 'constants.php',
 *      'func' => 'functions.php',
 *      'brain' => 'baz.php',
 * ),
 * @endverbatim
 *
 * Here three files are loaded, the VL receives feedback from @p baz.php
 * under this form: @p $feedback['brain']
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
