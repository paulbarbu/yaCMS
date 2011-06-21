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
$auth = FALSE;


if(isset($_POST['adminlogin'])){

    if(isset($_POST['pass'])  && !empty($_POST['pass'])){
        $pass = $_POST['pass'];

        if(is_dir(DATA_ROOT . 'gbook')){
            if(($f = fopen(DATA_ROOT . 'gbook' . DIRECTORY_SEPARATOR . 'admin_pass', "r")) !== FALSE){

                $currentPass = fgets($f);

                fclose($f);

                if(FALSE !== $currentPass){
                    if(trim($currentPass) == trim($pass)){
                        $auth = TRUE;

                        $id = rand(1000, 9999);

                        $_SESSION = array();
                        $_SESSION['id'] = $id;

                        if(isset($_GET['action']) && is_string($_GET['action'])){
                            $module = $_GET['action'];
                        }
                    }
                    else{
                        return ERR_PASS;
                    }
                }
                else{
                    return ERR_READING;
                }
            }
            else{ //error opening admin_pass
                return ERR_FOPEN_ADMIN;
            }
        }
        else{
            return ERR_DIR;
        }
    }
    else{ //empty password field
        return ERR_NO_PASS;
    }

    if(isset($_POST['r_me']) && $auth){ //create cookie for remembering the session

        $cookie = setcookie(session_name(), $id, time()+60*60*24*30, '/');
        if(!$cookie){
            return ERR_COOKIE;
        }
    }
}

return $auth;

