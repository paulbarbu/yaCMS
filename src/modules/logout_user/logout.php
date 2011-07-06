<?php
/**
 * Log out script
 *
 * At first we need to unset the $_SESSION, then to delete the session cookie
 * if it's set and finally to destroy the session itself
 */

$del_cookie = FALSE;
$destroy_session = FALSE;

$_SESSION = array();

if(ini_get("session.use_cookies")){
    $params = session_get_cookie_params();
    $del_sCookie = setcookie(session_name(), '', time() - 42000, $params['path'],
        $params['domain'], $params['secure'], $params['httponly']
    );
}

$destroy_session = session_destroy();

return $destroy_session & $del_sCookie;
