<?php
/**
 * Login BL
 * This script the verifies the user's credentials and logs him in or rejects
 * him
 *
 * $userList - contents of the user.csv file parsed into an array
 * $auth - stores a boolean shpwing if the user is authentified or not
 *
 * TODO: logout, remember, login_header
 */

$userList = array();
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

                    while(FALSE !== ($userList = fgetcsv($f, 1000))){
                        if(FALSE !== $userList && $user == $userList[0]){
                            $userOK = TRUE;
                            break;
                        }
                    }
                    fclose($f);

                    if(FALSE !== $userOK){
                        $auth = TRUE;

                        //$destroyed = session_destroy();
                        //if($destroyed){

                            //$started = session_start();
                            //if($started){
                            session_unset();
                            $_SESSION['uID'] = $userList[1];
                            //}
                            //else{
                                //return ERR_SESS;
                            //}
                        //}
                        //else{
                            //return ERR_D_SESS;
                        //}
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
    else{
        return ERR_NO_PASS;
    }

    if(isset($_POST['r_me'])){
    }
}

return $auth;
