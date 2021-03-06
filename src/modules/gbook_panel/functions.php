<?php
/**
 * Functions for Admin panel
 */

const GP_ERR_OPEN =  1;
const GP_ERR_DECODE = 2;
const GP_ERR_EMPTY = 3;

const GP_ERR_INVALID_ARRAY = 4;

/**
 * get_ips_ban() - Helper function that displays checkboxes with IP's
 * susceptible to ban
 *
 * @param string $path path to file containing posts formatted as JSON,
 * default: PATH_MSG_FILE constant
 *
 * @return int|array an int is returned in case that the file canot be opened(1),
 * 2 if the messages cannot be decoded(from JSON format) or 3 if the file does
 * not exists or it's empty, on success it returns an array of strings containing
 * the IPs
 */
function get_ips_ban($path = PATH_MSG_FILE){
    if(is_file($path) && 0 != filesize($path)){

        $ips = array();
        $nr_ips = 0;
        $fh = fopen($path, "r");

        if(FALSE != $fh){
            while(!feof($fh)){

                $post = fgets($fh);

                if(FALSE == $post){
                    fclose($fh);
                    return $ips;
                }

                $result = json_decode($post, true);

                if(NULL == $result){
                    fclose($fh);
                    return GP_ERR_DECODE;
                }

                $ips[$nr_ips] = NULL;
                $ips[$nr_ips] .= '<input type="checkbox" name="ips[]" value="'
                    . $result['ip'] . '" id="id-' . $result['ip'] . '" /><label
                    for="id-' . $result['ip'] . '">' . $result['ip'] . '</label>
                    <br />';

                $ips = array_unique($ips);

                $nr_ips++;

            }

            fclose($fh);
        }
        else{
            return  GP_ERR_OPEN;
        }

        return $ips;
    }
    else{
        return  GP_ERR_EMPTY;
    }
}

/**
 * ban_ip() - writes array entries on a new line
 *
 * @param resource $fh resource to opened file with flag "a"
 * @param array $ips array containing the IP's to be banned
 *
 * @return int|TRUE on success returns TRUE, else return the error
 * code
 */
function ban_ip($fh, $ips){
    if(is_array($ips)){
        foreach($ips as $ip){
            fwrite($fh, $ip . "\n");
        }
    }
    else{
        return GP_ERR_INVALID_ARRAY;
    }

    return TRUE;
}

/**
 * get_ips_unban() Helper function that displays IPs for unban
 *
 * @param string $path path to ban file containing IPs
 *
 * @return int|array return and array containing the IPs or an error code
 */
function get_ips_unban($path = PATH_BAN_FILE){
    if(is_file($path) && 0 != filesize($path)){

        $ips = array();
        $nr_ips = 0;
        $currentIP = NULL;

        $fh = fopen($path, "r");

        if(FALSE != $fh){
            while(!feof($fh)){

                $currentIP = trim(fgets($fh));

                if(FALSE == $currentIP){
                    fclose($fh);
                    return $ips;
                }

                $ips[$nr_ips] = NULL;

                $ips[$nr_ips] .= '<input type="checkbox" name="unban_ips[]" value="'
                    . $currentIP . '" id="idu-' . $currentIP . '" /><label
                    for="idu-' . $currentIP . '">' . $currentIP . '</label>
                    <br />';

                $ips = array_unique($ips);

                $nr_ips++;

            }

            fclose($fh);
        }
        else{
            return  GP_ERR_OPEN;
        }

        return $ips;
    }
    else{
        return  GP_ERR_EMPTY;
    }
}
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
