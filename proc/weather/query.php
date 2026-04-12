<?php
/**
*
* query.php
*
* By Roberto Tonjaw. Feb 2014
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
$db->sql_connect($dbhost, $dbuser, $dbpasswd, $dbname, $dbport, false, defined('TONJAW_DB_NEW_LINK') ? TONJAW_DB_NEW_LINK : false);

// We do not need this any longer, unset for safety purposes
unset($dbpasswd);

$qkey 	= request_var('key', '');
$id	= request_var('id', '');

if(empty($qkey) || empty($id) || $qkey !== $key)
{
    die('Ilegal Key and/or City. Please contact Navicom Administrator.');
}

$id = str_replace('_', ' ', $id);

$sql = 'SELECT * FROM ' . $table . " WHERE weather_city = '" . $id . "'";
    
$result	= $db->sql_query($sql);
$data	= $db->sql_fetchrow($result);
//$exist = (string) $db->sql_fetchfield('weather_city');

if( empty($data['weather_city']) )
{
   die($id . ' is unavailable in the DB. Please contact Navicom Administrator.'); 
}
    
$db->sql_freeresult($result);    
    
echo json_encode($data);

?>