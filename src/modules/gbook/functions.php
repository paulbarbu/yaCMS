<?php
/**
 * @file /src/modules/gbook/functions.php
 * @brief Functions for the Guest Book
 * @author paullik
 */

/**
 * Error opening file
 */
const GB_ERR_OPEN =  1;

/**
 * Error decoding a format
 */
const GB_ERR_DECODE = 2;

/**
 * Empty file
 */
const GB_ERR_EMPTY = 3;

/**
 * IP is not a string
 */
const GB_ERR_IP_STRING = 4;

/**
 * Error opening bans file
 */
const GB_ERR_FOPEN_BAN_FILE = 5;

/**
 * Helper function, echoes div's as posts from a file passed as parameter
 *
 * @param string $path path to file containing posts formatted as JSON
 * @param bool $admin flag that says whether an admin is loggen in or not
 *
 * @return @c 1 in case that the file canot be opened,
 * @c 2 if the messages cannot be decoded(from JSON format) or @c 3 if the file
 * does not exists or it's empty, on success it returns an array of strings
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

                $result['msg'] = wordwrap($result['msg'], 100, "\n", TRUE);
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
 * Helper function that checks if an IP is banned or not
 *
 * @param string $ip user's IP
 * @param string $path path to the ban list(database)
 *
 * @return TRUE if the verified IP is banned, else FALSE, on
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
