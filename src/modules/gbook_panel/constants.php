<?php
/**
 * Constants for Admin panel
 */

define('PATH_MSG_FILE', DATA_ROOT . DIRECTORY_SEPARATOR . 'gbook'
    . DIRECTORY_SEPARATOR . 'msg.json');
define('PATH_BAN_FILE', DATA_ROOT . DIRECTORY_SEPARATOR . 'gbook'
    . DIRECTORY_SEPARATOR . 'bans');

const GP_ERR_NO_IP = 7;
const GP_ERR_FOPEN_BAN_FILE = 8;
const GP_BANNED = 9;
const GP_UNBANNED = 10;
