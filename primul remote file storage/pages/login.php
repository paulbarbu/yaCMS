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

        if(is_dir(PATH . $pass)){
            if(($f = fopen(PATH . $pass . DIRECTORY_SEPARATOR . 'users.csv',
                "r")) !== FALSE){

                if(isset($_POST['user']) && !empty($_POST['user'])){
                    $user = $_POST['user'];
                    $userOK = FALSE;

                    while(FALSE !== ($currentUser = fgetcsv($f, 1000))){
                        if(FALSE !== $currentUser && $user == $currentUser[0]){
                            $userOK = TRUE;
                            break;
                        }
                    }
                    fclose($f);

                    if(FALSE !== $userOK){
                        $auth = TRUE;

                        $_SESSION = array();
                        $_SESSION['uID'] = $currentUser[1];
                    }
                    else{ //inexistent username
                        return ERR_USER;
                    }
                }
                else{ //empty user field
                    return ERR_NO_USER;
                }
            }
            else{ //error opening users.csv
                return ERR_FOPEN_USER;
            }
        }
        else{ //incorrect password
            return ERR_PASS;
        }
    }
    else{ //empty password field
        return ERR_NO_PASS;
    }

    if(isset($_POST['r_me']) && $auth){ //create cookie for remembering the session
        $cookie = setcookie(COOKIE_NAME, $currentUser[1], time()+60*60*24*30);

        if(!$cookie){
            return ERR_COOKIE;
        }
    }
}

return $auth;
