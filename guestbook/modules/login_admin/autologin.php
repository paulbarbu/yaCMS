<?php

$prev = NULL;

if(isset($_COOKIE[session_name()])){
    session_start();
}

if(!isset($_SESSION['admin']) && isset($_COOKIE[session_name()]) && is_numeric($_COOKIE[session_name()])){
        $_SESSION = $_COOKIE[session_name()];
}
elseif(isset($modules[$module]['VL']['login_need']) && $modules[$module]['VL']['login_need'] && !isset($_SESSION['admin'])){
    if($module != 'login_admin'){
        $prev = $module;
    }

    $module = 'login_admin';
}

return $prev;
