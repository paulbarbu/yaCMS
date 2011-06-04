<?php
/**
 * Log out script
 *
 * At first we need to unset the $_SESSION, then to delete the session cookie
 * if it's set and finally to destroy the session itself
 *
 * http://stackoverflow.com/questions/1239079/what-to-do-when-there-are-two-cookies-with-the-same-name-in-ie7/1242446#1242446
 */

$del_cookie = FALSE;
$destroy_session = FALSE;
$destroy_cookie = TRUE;

$uID = $_SESSION['uID'];
$_SESSION = array();
echo '<pre>';
var_dump($uID);
echo '</pre>';
if(ini_get("session.use_cookies")){
    $params = session_get_cookie_params();
    $del_sCookie = setcookie(session_name(), '', time() - 42000, $params['path'],
        $params['domain'], $params['secure'], $params['httponly']
    );
}

$destroy_session = session_destroy();

if(isset($_COOKIE['autoLogin'])){
    $destroy_cookie = setcookie('autoLogin', '', time() - 42000);
}

return $destroy_session & $del_sCookie & $destroy_cookie;
