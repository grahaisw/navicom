<?php
/**
*
* welcome.php	: Main Menu
*
* Roberto Tonjaw. Feb 2014
*/

/**
*/

define('IN_TONJAW', true);
define('NEED_SID', true);
define('IN_FRONTEND', true);

$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './';
$phpEx = substr(strrchr( $_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr( $_SERVER['PHP_SELF'], '/'), 1));

// Include files
require($tonjaw_root_path . 'common.' . $phpEx);
//require($tonjaw_root_path . 'fe_common.' . $phpEx);

$mode		= request_var('mode', '');
$sid 		= request_var('sid', '');



echo 'WELCOME SCREEN ...';


?>