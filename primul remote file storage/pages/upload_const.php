<?php
/**
 * in this file are stored constants
 * for file error constants go to: 
 * 		http://www.php.net/manual/en/features.file-upload.errors.php
 */
 
const ERR_SIZE = 'The input file exceeded the size limit!';
const ERR_PARTIAL = 'The uploaded file was only partially uploaded!';
const ERR_NO_FILE = 'You must select a file for uploading!';
const ERR_NO_TMP = 'Please contact our staff: the temporary directory is missing!';
const ERR_NO_WRITE = 'Please contact our staff: directory permissions problems!';
const ERR_EXT = 'Please contact our staff: upload stopped by extension!';
const ERR_SECRET = 'Please specify a directory name to upload to!';
const ERR_NOT_UPLOADED = 'The file you are trying to submit is not a valid uploaded file!';
const ERR_CREATE_DIR = 'Error creating: ';
const ERR_MOVE = 'An unexpected error occured while moving the file to destination!';
const SUCCESS = 'File uploaded successfully!';