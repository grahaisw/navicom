<?php
/*
*  test.php
*/
define('IN_TONJAW', true);
$root_path = (defined('ROOT_PATH')) ? ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
$file = explode('.', substr(strrchr(__FILE__, '/'), 1));

// Include files
require($root_path . 'startup.' . $phpEx);
require($root_path . 'config.' . $phpEx);
require($root_path . $dbms . '.' . $phpEx);
$db	= new $sql_db();

// Connect to DB
if($db->sql_connect($dbhost, $dbuser, $dbpasswd, $dbname, $dbport, false, defined('TONJAW_DB_NEW_LINK') ? TONJAW_DB_NEW_LINK : false))
{
  echo 'ya konek';
}
else
{
  echo 'gagal';
}

// We do not need this any longer, unset for safety purposes
unset($dbpasswd);


?>