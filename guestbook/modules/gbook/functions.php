<?php
/**
 * Functions for the guest Book
 */

const GB_ERR_OPEN =  1;
const GB_ERR_DECODE = 2;
const GB_ERR_EMPTY = 3;

const GB_ERR_IP_STRING = 4;
const GB_ERR_FOPEN_BAN_FILE = 5;

/**
 * post_to_div() - Helper function, echoes div's as posts from a file passed as parameter
 *
 * @param string $path path to file containing posts formatted as JSON,
 * default: PATH_MSG_FILE constant
 * @return int|array an int is returned in case that the file canot be opened(1),
 * 2 if the messages cannot be decoded(from JSON format) or 3 if the file does
 * not exists or it's empty, on success it returns an array of strings
 */
function post_to_div($path = PATH_MSG_FILE, $admin = FALSE){
    if(is_file($path) && 0 != filesize($path)){

        $posts = array();
        $nr_posts = 0;
        $fh = fopen(PATH_MSG_FILE, "r");

        if(FALSE != $fh){
            while(!feof($fh)){

                $post = fgets($fh);

                if(FALSE == $post){
                    return $posts;
                }

                $result = json_decode($post, TRUE);

                if(NULL == $result){
                    fclose($fh);
                    return GB_ERR_DECODE;
                }

                $result['msg'] = wordwrap($result['msg'], 100, "\n", true);
                $result['msg'] = nl2br($result['msg']);

                $posts[$nr_posts] = NULL;

                $posts[$nr_posts] .= '<div id="post"><div id="headpost">' . PHP_EOL;

                if(FALSE != $admin){
                    $unique_id = $result['time'] . '!' . $result['ip'];
                    $posts[$nr_posts] .= '<input type="checkbox" name="manage_posts[]" value="' . $unique_id . '" />';
                }

                $posts[$nr_posts] .= $result['nick'];

                if(NULL != $result['mail']){
                    $posts[$nr_posts] .= '&nbsp;<a href="mailto:' . $result['mail'] . '">'
                        . $result['mail'] . '<a/>';
                }

                if(NULL != $result['url']){
                    $posts[$nr_posts] .= '&nbsp;<a href="' . $result['url'] . '">'
                        . $result['url'] . '</a>';
                }

                if(FALSE != $admin){
                    $posts[$nr_posts] .= '&nbsp;' . $result['ip'];
                }

                $posts[$nr_posts] .= '<span id="date">' . $result['time']
                    . '</span></div><br />' . $result['msg'] . '</div>' . PHP_EOL;

                $nr_posts++;

            }

            fclose($fh);
        }
        else{
            return  GB_ERR_OPEN;
        }

        return $posts;
    }
    else{
        return  GB_ERR_EMPTY;
    }
}

/**
 * check_ip() - Helper function that checks if an IP is banned or not
 *
 * @param string $ip user's IP
 * @param string $path_to_bans path to the ban list(database), default:
 * PATH_BAN_FILE
 *
 * @return int|BOOL returns TRUE if the verified IP is banned, else FALSE, on
 * error returns the error's code
 */
function check_ip($ip, $path = PATH_BAN_FILE){
    if(!is_string($ip)){
        return GB_ERR_IP_STRING;
    }

    if(is_file($path) && 0 != filesize($path)){
        $fh = fopen($path, "r");

        if(FALSE == $fh){
            return GB_ERR_FOPEN_BAN_FILE;
        }

        while(!feof($fh)){
            $currentIP = fgets($fh);
            if(trim($currentIP) == trim($ip)){
                fclose($fh);
                return TRUE;
            }
        }

        fclose($fh);
    }

    return FALSE;
}
