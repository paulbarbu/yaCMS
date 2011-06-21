<?php
if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['id']) && isset($_COOKIE[session_name()]) && is_numeric($_COOKIE[session_name()])){
        $_SESSION['id'] = $_COOKIE[session_name()];
}
