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
                    return POST_SUCCESS;
                }
                else{
                    return ERR_WRITE_POST;
                }
            }
            else{
                return ERR_OPEN_MSG_FILE;
            }
        }
        else{
            return ERR_NO_MSG;
        }
    }
    else{
        return ERR_NO_NICK;
    }
}

return OK;
