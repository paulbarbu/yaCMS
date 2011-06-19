<?php
session_start();

if(!isset($_SESSION['id']) && isset($_COOKIE[session_name()]) && is_numeric($_COOKIE[session_name()])){
        $_SESSION['id'] = $_COOKIE[session_name()];
}
elseif(isset($modules[$module]['login']) && !isset($_SESSION['id'])){
    /**
     * if no session is registered and 'remember me' was not checked
     * and still the page needs authentication
     */
    $page = 'login_admin';
}

