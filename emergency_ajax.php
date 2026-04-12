<?php

/**
*
* emergency_ajax.php	
*
* Agnes Emanuella, Aug 2014
*/

define('IN_TONJAW', true);
define('NEED_SID', true);
define('IN_FRONTEND', true);



$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './';
$phpEx = substr(strrchr( $_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr( $_SERVER['PHP_SELF'], '/'), 1));
$page = $file[0] . '.' . $phpEx;



// Include files
require($tonjaw_root_path . 'common.' . $phpEx);
require($tonjaw_root_path . 'fe_common.' . $phpEx);

$mod = $_GET['mod'];

if($mod == "urgency") {

    global $db, $config;
    
	$sql = "SELECT COUNT(u.signage_urgency_id) AS total_row FROM ".SIGNAGE_URGENCIES_TABLE." u LEFT JOIN ".SIGNAGE_URGENCY_ROOM_GROUPINGS_TABLE." g ON u.signage_urgency_id = g.signage_urgency_id LEFT JOIN ".NODES_TABLE." n ON g.room_id = n.room_id WHERE signage_urgency_enabled = 1 AND signage_urgency_flag = 'emergency' AND n.node_ip = '".$session->ip."'";

	$result = $db->sql_query($sql);
	$total_row = (int) $db->sql_fetchfield('total_row');
	$db->sql_freeresult($result);       

	if($total_row > 0) {

		$sql = "SELECT * FROM ".SIGNAGE_URGENCIES_TABLE." u LEFT JOIN ".SIGNAGE_URGENCY_ROOM_GROUPINGS_TABLE." g ON u.signage_urgency_id = g.signage_urgency_id LEFT JOIN ".NODES_TABLE." n ON g.room_id = n.room_id WHERE signage_urgency_enabled = 1 AND signage_urgency_flag = 'emergency' AND n.node_ip = '".$session->ip."' ORDER BY signage_urgency_priority_order ASC";

		$result = $db->sql_query($sql);
		
		while($row = $db->sql_fetchrow($result)) {
			$flag = $row['signage_urgency_flag'];
			$enabled = $row['signage_urgency_enabled'];
			$duration = $row['signage_urgency_duration'];
			$stop = date("Y-m-d H:i:s", mktime(date("H"),date("i"),date("s")+$duration,date("m"),date("d"),date("Y")));
			$airline_image = "";

			if($row['signage_urgency_airline'] != NULL) {
				$airline = str_replace(" ", "_", strtolower($row['signage_urgency_airline'])).".png";
				$airline_image = $config['image_signage_path'].$airline;
			}

			if($output != "") $output .= ',';

			$output .=  '{"flag":"'.$row['signage_urgency_flag'].'","enabled":"'.$row['signage_urgency_enabled'].'","stoptime":"'.$stop.'","airline":"'.$airline_image.'","flight_number":"'.$row['signage_urgency_flight_no'].'","destination":"'.ucfirst($row['signage_urgency_destination']).'","gate":"Gate '.$row['signage_urgency_departure_gate'].'","time":"'.$row['signage_urgency_departure_time'].'","message":"'.ucfirst($row['signage_urgency_message']).'","order":"'.$row['signage_urgency_priority_order'].'","display":"'.$row['signage_urgency_display'].'","id":"'.$row['signage_urgency_id'].'","duration":"'.$row['signage_urgency_duration'].'"}';

		}
		
		$db->sql_freeresult($result);

	} 

    echo $output;    

} else if($mod == "urgencystop") {
    $id = $_GET['id'];

    $sql = "UPDATE ".SIGNAGE_URGENCIES_TABLE." SET signage_urgency_enabled = 0 WHERE signage_urgency_id = ".$id."";
    $db->sql_query($sql);
	
	$sql = "SELECT signage_urgency_display FROM ".SIGNAGE_URGENCIES_TABLE." WHERE signage_urgency_id = ".$id."";
    $result = $db->sql_query($sql);
	$display = $db->sql_fetchfield('signage_urgency_display');

    echo $display;

} 

?>
