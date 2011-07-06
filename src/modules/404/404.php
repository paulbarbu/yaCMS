<?php
/**
 * Decide if the custom page should be showed or not
 */
if(!(isset($modules[$module]['VL']['custom']) && $modules[$module]['VL']['custom'])){
    header("HTTP/1.1 404 Not Found");
    exit();
}
