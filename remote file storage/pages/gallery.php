<?php
/**
 * BL for the gallery script
 */

if(isset($_POST['submit'])){
    if(isset($_POST['dir']) && !empty($_POST['dir'])){
        $dir = $_POST['dir'];

        if(is_dir(PATH . $dir)){
            //continue
        }
        else{
            return ERR_IS_DIR;
        }
    }
    else{
        return ERR_NO_DIR;
    }
}
return OK;
