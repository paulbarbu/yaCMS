<?php

$prev = NULL;

if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['uID']) && isset($_COOKIE[session_name()]) && is_numeric($_COOKIE[session_name()])){
        $_SESSION['uID'] = $_COOKIE[session_name()];
}
elseif(isset($modules[$module]['VL']['login_need']) && $modules[$module]['VL']['login_need'] && !isset($_SESSION['uID'])){
    if($module != 'login_admin'){
        $prev = $module;
    }

    $module = 'login_user';
}

return $prev;
