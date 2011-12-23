<?php
/**
 * BL for the gallery script
 */

$result = NULL;

if(isset($_POST['submit'])){
    if(isset($_POST['dir']) && !empty($_POST['dir'])){
        $dir_name = $_POST['dir'];
        $dir = UPLOADS_ROOT . $dir_name;

        if(is_dir($dir)){
            $result = find_files_by_mime($dir, 'image', FALSE);

            if(!empty($result)){
                return $result;
            }
            else{
                return G_ERR_NO_IMAGES;
            }
        }
        else{
            return G_ERR_IS_DIR;
        }
    }
    else{
        return G_ERR_NO_DIR;
    }
}
return G_OK;
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
