<?php
/**
 * Functions for the guest Book
 */

const ERR_OPEN =  1;
const ERR_DECODE = 2;
const ERR_EMPTY = 3;

/**
 * post_to_div() - Helper function, echoes div's as posts from a file passed as parameter
 *
 * @param string $path path to file containing posta formatted as JSON,
 * default: PATH_MSG_FILE constant
 * @return int|array an int is returned in case that the file canot be opened(1),
 * 2 if the messages cannot be decoded(from JSON format) or 3 if the file does
 * not exists or it's empty, on success it returns an array of strings
 */
function post_to_div($path = PATH_MSG_FILE){
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

                $result = json_decode($post, true);

                if(NULL == $result){
                    fclose($fh);
                    return ERR_DECODE;
                }

                $result['msg'] = wordwrap($result['msg'], 100, "\n", true);
                $result['msg'] = nl2br($result['msg']);

                $posts[$nr_posts] = NULL;

                $posts[$nr_posts] .= '<div id="post"><div id="headpost">' . PHP_EOL . $result['nick'];
                if(NULL != $result['mail']){
                    $posts[$nr_posts] .= '&nbsp;<<a href="mailto:' . $result['mail'] . '">'
                        . $result['mail'] . '<a/>>';
                }

                if(NULL != $result['url']){
                    $posts[$nr_posts] .= '&nbsp;<a href="' . $result['url'] . '">'
                        . $result['url'] . '</a>';
                }

                $posts[$nr_posts] .= '<span id="date">' . $result['time']
                    . '</span></div><br />' . $result['msg'] . '</div>' . PHP_EOL;

                $nr_posts++;

            }

            fclose($fh);
        }
        else{
            return  ERR_OPEN;
        }

        return $posts;
    }
    else{
        return  ERR_EMPTY;
    }
}
