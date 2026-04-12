<?php
/**
*
* API/fis.php
*
* Agnes Emanuella. Oct 2017
*/

/**
* 
*/

define('IN_TONJAW', true);
define('NEED_SID', true);
//echo 'check_in jalan...'; exit;
$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './../';
$phpEx = substr(strrchr($_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr($_SERVER['PHP_SELF'], '/'), 1));
//echo $file[0].'.'.$phpEx;

require($tonjaw_root_path . 'common.' . $phpEx);

$mode = $_GET['mode'];

switch($mode) {
	case $pms_event['flight_remark']:
	
	$success = $pms->update_flight_remark();
	echo $success;
	break;
	
	case $pms_event['alert']:
	
	$success = $pms->alert();
	echo $success;
	break;
			
}


//$pms->get_info();
//$code = 'Event=' . $event . ' - ' . 'Room=' . $old . ' - ' . 'MoveTo=' . $new . ' - ' . 'ResvID=' . $resv_id;

//$pms->send_reply_message($code);
//$pms->pms_echo($event);
unset($db);
unset($pms);


?>