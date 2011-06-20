<?php
/**
 * Constants for GB script
 */

define('PATH_MSG_FILE', DATA_ROOT . DIRECTORY_SEPARATOR . 'gbook'
    . DIRECTORY_SEPARATOR . 'msg.json');
define('PATH_BAN_FILE', DATA_ROOT . DIRECTORY_SEPARATOR . 'gbook'
    . DIRECTORY_SEPARATOR . 'bans');

const OK = 0;
const ERR_NO_NICK = 1;
const ERR_NO_MSG = 2;
const ERR_OPEN_MSG_FILE = 3;
const ERR_WRITE_POST = 4;
const POST_SUCCESS = 5;
