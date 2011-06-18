<?php
/**
 * Controls for Admin panel
 */

//BAN
if(isset($_POST['ban_ip'])){
    if(isset($_POST['ips'])){
        $ips = $_POST['ips'];

        $fh = fopen(PATH_BAN_FILE, "a");

        if(FALSE == $fh){
            return ERR_FOPEN_BAN_FILE;
        }

        $ban = ban_ip($fh, $ips);

        fclose($fh);

        if(TRUE != $ban){
            return $ban;
        }
        else{
            return BANNED;
        }
    }
    else{
        return ERR_NO_IP;
    }
}

return TRUE;
