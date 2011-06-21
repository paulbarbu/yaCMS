<?php
if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['uID']) && isset($_COOKIE[session_name()]) && is_numeric($_COOKIE[session_name()])){
        $_SESSION['uID'] = $_COOKIE[session_name()];
}

