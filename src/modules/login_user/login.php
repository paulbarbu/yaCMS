<?php
/**
 * Login BL
 * This script the verifies the user's credentials and logs him in(starts a
 * session registering his uID) or rejects him
 *
 * The password must be a directory in uploads/ and the user must be found in
 * 'users.csv' file into uploads/password_dir
 *
 * $currentUser - array of two strings containing the credentials(username and
 * the ID) of the logged in user
 * $auth - stores a boolean, if the user is authentified or not
 */


$currentUser = array();
$auth = FALSE;

if(isset($_POST['go'])){

    if(isset($_POST['pass'])  && !empty($_POST['pass'])){
        $pass = $_POST['pass'];

        if(is_dir(UPLOADS_ROOT . $pass)){
            if(($f = fopen(UPLOADS_ROOT . $pass . DIRECTORY_SEPARATOR . 'users.csv',
                "r")) !== FALSE){

                if(isset($_POST['user']) && !empty($_POST['user'])){
                    $user = $_POST['user'];

                    $currentUser = csv_search($f, 0, $user);

                    fclose($f);

                    if(FALSE !== $currentUser){
                        $auth = TRUE;


                        if(!isset($_SESSION)){
                            session_set_cookie_params(0, app_path());
                            session_start();
                        }

                        $_SESSION['uID'] = $currentUser[1];

                        if(isset($_GET['action']) && is_string($_GET['action'])){
                            $module = $_GET['action'];
                            $reload = TRUE;
                        }
                    }
                    else{ //inexistent username
                        return LU_ERR_USER;
                    }
                }
                else{ //empty user field
                    return LU_ERR_NO_USER;
                }
            }
            else{ //error opening users.csv
                return LU_ERR_FOPEN_USER;
            }
        }
        else{ //incorrect password
            return LU_ERR_PASS;
        }
    }
    else{ //empty password field
        return LU_ERR_NO_PASS;
    }

    if(isset($_POST['r_me']) && $auth){ //create cookie for remembering the session
        $pos = strrpos($_SERVER['REQUEST_URI'], DIRECTORY_SEPARATOR);
        $cookie_path = substr($_SERVER['REQUEST_URI'], 0, $pos);

        $cookie = setcookie(session_name(), session_id(), time()+60*60*24*30, app_path());
        if(!$cookie){
            return LU_ERR_COOKIE;
        }
    }
}

return $auth;
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
