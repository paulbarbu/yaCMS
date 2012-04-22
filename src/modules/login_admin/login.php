<?php
/**
 * Login BL
 * This script the verifies the admin's credentials and logs him in(starts a
 * session registering his ID) or rejects him
 *
 * The password must match the one in DATA_ROOT/gbook/admin_pass
 *
 * $auth - stores a boolean, if the user is authentified or not
 */

$currentPass = NULL;
$out = array();
$out['auth'] = FALSE;


if(isset($_POST['adminlogin'])){

    if(isset($_POST['pass'])  && !empty($_POST['pass'])){
        $pass = $_POST['pass'];

        if(is_dir(DATA_ROOT . 'gbook')){
            if(($f = fopen(DATA_ROOT . 'gbook' . DIRECTORY_SEPARATOR . 'admin_pass', "r")) !== FALSE){

                $currentPass = fgets($f);

                fclose($f);

                if(FALSE !== $currentPass){
                    if(trim($currentPass) == trim($pass)){
                        $out['auth'] = TRUE;

                        if(!isset($_SESSION)){
                            session_set_cookie_params(0, app_path());
                            session_start();
                        }

                        $_SESSION['admin'] = TRUE;

                        if(isset($_GET['action']) && is_string($_GET['action'])){
                            $out['module'] = $_GET['action'];
                            $out['reload'] = TRUE;
                        }
                    }
                    else{
                        return LA_ERR_PASS;
                    }
                }
                else{
                    return LA_ERR_READING;
                }
            }
            else{ //error opening admin_pass
                return LA_ERR_FOPEN_ADMIN;
            }
        }
        else{
            return LA_ERR_DIR;
        }
    }
    else{ //empty password field
        return LA_ERR_NO_PASS;
    }

    if(isset($_POST['r_me']) && $auth){ //create cookie for remembering the session

        $cookie = setcookie(session_name(), session_id(), time()+60*60*24*30, app_path());
        if(!$cookie){
            return LA_ERR_COOKIE;
        }
    }
}

return $out;

/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
