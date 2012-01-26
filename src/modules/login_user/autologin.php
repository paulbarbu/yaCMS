<?php

$out = array();
$out['prev'] = NULL;

if(isset($_COOKIE[session_name()])){
    session_set_cookie_params(0, app_path());
    session_start();
}

if(!isset($_SESSION['uID']) && isset($_COOKIE[session_name()]) && is_numeric($_COOKIE[session_name()])){
        $_SESSION = $_COOKIE[session_name()];
}
elseif(isset($modules[$module]['VL']['login_need']) && $modules[$module]['VL']['login_need'] && !isset($_SESSION['uID'])){
    if($module != 'login_admin'){
        $out['prev'] = $module;
    }

    $out['module'] = 'login_user';
    $out['reload'] = true;
}

return $out;
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
