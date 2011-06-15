<?php
/**
 * BL for the gallery script
 */

$result = NULL;

if(isset($_POST['submit'])){
    if(isset($_POST['dir']) && !empty($_POST['dir'])){
        $dir = PATH . $_POST['dir'];

        if(is_dir($dir)){
            $dir_h = opendir($dir);
            if(FALSE != $dir_h){
                rewinddir($dir_h);

                $result = dir_type_check($dir_h, $dir);

                closedir($dir_h);

                if(NULL !== $result){
                    return $result;
                }
                else{
                    return ERR_ONLY_IMAGES;
                }
            }
            else{
                return ERR_OPEN_DIR;
            }
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
