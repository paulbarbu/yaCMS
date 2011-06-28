<?php
/**
 * BL for Guest Book script
 */
$result = array(
    'nick' => NULL,
    'msg' => NULL,
    'mail' => NULL,
    'url' => NULL,
    'time' => NULL,
    'ip' => NULL,
);

if(isset($_POST['post'])){
    if(isset($_POST['nick']) && NULL != $_POST['nick']){
        $result['nick'] = strip_tags($_POST['nick']);

        if(isset($_POST['message']) && NULL != $_POST['message']){
            $result['msg'] = $_POST['message'];
            $result['msg'] = strip_tags($result['msg'], '<p><i><b>');

            if(isset($_POST['mail']) && NULL != $_POST['mail']){
                $result['mail'] = strip_tags($_POST['mail']);
            }

            if(isset($_POST['url']) && NULL != $_POST['url']){
                $result['url'] = strip_tags($_POST['url']);
            }

            $result['time'] = date("F j, Y, g:i a");
            $result['ip'] = $_SERVER['REMOTE_ADDR'];

            $fh = fopen(PATH_MSG_FILE, "a");

            if(FALSE != $fh){
                $post = json_encode($result);
                $post .= PHP_EOL;

                $write_success = fwrite($fh, $post);
                fclose($fh);

                if(FALSE != $write_success){
                    return GB_POST_SUCCESS;
                }
                else{
                    return GB_ERR_WRITE_POST;
                }
            }
            else{
                return GB_ERR_OPEN_MSG_FILE;
            }
        }
        else{
            return GB_ERR_NO_MSG;
        }
    }
    else{
        return GB_ERR_NO_NICK;
    }
}

if(isset($_POST['del'])){
    if(isset($_POST['manage_posts']) && !empty($_POST['manage_posts'])){
        $manage_posts = $_POST['manage_posts'];
        $posts_info = array();
        $remaining_posts = array();

        foreach($manage_posts as $post){
            $post = explode('!', $post);
            $posts_info[] = $post;
        }

        $fh = fopen(PATH_MSG_FILE, "r");

        if(FALSE != $fh){
            while(!feof($fh)){
                $post = fgets($fh);

                if(FALSE != $post){

                    $result = json_decode($post, TRUE);

                    foreach($posts_info as $info){
                        if($info[0] != $result['time'] || $info[1] != $result['ip']){
                            $remaining_posts[] = $post;
                        }
                    }
                }
                else{
                    fclose($fh);
                    $fh = fopen(PATH_MSG_FILE, "w");

                    if(FALSE != $fh){
                        foreach($remaining_posts as $post){
                            fwrite($fh, $post);
                        }
                        fclose($fh);
                    }
                    else{
                        return GB_ERR_OPEN_MAG_FILE;
                    }

                    return GB_DEL_SUCCESS;
                }
            }
            fclose($fh);
        }
        else{
            return GB_ERR_OPEN_MSG_FILE;
        }

    }
    else{
        return GB_ERR_NO_SELECTED;
    }
}

return GB_OK;
