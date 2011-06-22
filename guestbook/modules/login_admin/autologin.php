<?php

$prev = NULL;

if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['id']) && isset($_COOKIE[session_name()]) && is_numeric($_COOKIE[session_name()])){
        $_SESSION['id'] = $_COOKIE[session_name()];
}
elseif(isset($modules[$module]['VL']['login_need']) && $modules[$module]['VL']['login_need'] && !isset($_SESSION['id'])){
    if($module != 'login_admin'){
        $prev = $module;
    }

    $module = 'login_admin';
}

return $prev;
