<?php
/**
*
* pms/pmsal.php
*
* Roberto Tonjaw. May 2014
*/

/**
* 
*/
if (!defined('IN_TONJAW'))
{
	die('Hacking Attempt');
}

/**
* PMS Abstraction Layer
* @package pmsal
*/
class pmsal
{


    function generate_room_key($resv_id, $room_name)
    {
	global $db;
	
	$key = md5($resv_id . '*' . $room_name);
	
	$sql = 'UPDATE ' . ROOMS_TABLE . " SET room_key='" . $key . "' WHERE room_name='" . $room_name . "'";
	$db->sql_query($sql);
	
	return true;
    }





}





/**
* This variable holds the class name to use later
*/
$pms_api = ($pmsname) ? 'pmsal_' . basename($pmsname) : 'pmsal';
//echo '<p>bwahahhahah</p>';

?>