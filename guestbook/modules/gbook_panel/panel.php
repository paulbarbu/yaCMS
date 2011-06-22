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
            return GP_ERR_FOPEN_BAN_FILE;
        }

        $ban = ban_ip($fh, $ips);

        fclose($fh);

        if(TRUE != $ban){
            return $ban;
        }
        else{
            return GP_BANNED;
        }
    }
    else{
        return GP_ERR_NO_IP;
    }
}

//UNBAN
if(isset($_POST['unban_ip'])){
    if(isset($_POST['unban_ips'])){
        $ips = $_POST['unban_ips'];

        $bans = file(PATH_BAN_FILE);

        if(FALSE == $bans){
            return GP_ERR_FOPEN_BAN_FILE;
        }

        for($i=0;$i<count($bans);$i++){
            $bans[$i] = trim($bans[$i]);
        }

        $ips = array_unique(array_diff($bans, $ips)); //remove the IPs that match

        $fh = fopen(PATH_BAN_FILE, "w");

        if(FALSE == $fh){
            return GP_ERR_FOPEN_BAN_FILE;
        }

        $unban = ban_ip($fh, $ips); //write the remaining IPs

        fclose($fh);

        if(TRUE != $unban){
            return $unban;
        }
        else{
            return GP_UNBANNED;
        }
    }
    else{
        return GP_ERR_NO_IP;
    }
}

return TRUE;
