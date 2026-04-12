<?php
/**
*
* fids.php	
*
* Agnes Emanuella, Oct 2014
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

$airline = $_GET['a'];
$flightnum = $_GET['f'];
$destination = $_GET['d'];
$gate = $_GET['g'];
$time = $_GET['t'];
$message = $_GET['m'];
$order = $_GET['o'];
$duration = $_GET['dur'];
$zone_id = $_GET['z'];
$room_id = $_GET['r'];

$sql_ary = array(
    'signage_urgency_airline'	        => $airline,
    'signage_urgency_flight_number'	    => $flightnum,
    'signage_urgency_destination'	    => $destination,
    'signage_urgency_departure_gate'	=> $gate,
    'signage_urgency_departure_time'	=> $time,
    'signage_urgency_message'	        => $message,
    'signage_urgency_priority_order'    => $order,
    'signage_urgency_duration'	        => $duration,
    'signage_urgency_enabled'	        => '1',
    //'emergency_code'	                => $emergency_code,
    'signage_urgency_flag'              => 'fids',
);

$sql = 'INSERT INTO ' . SIGNAGE_URGENCIES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);    
$db->sql_query($sql);
$nextid = $db->sql_nextid();

$zones = explode(",", $zone_id);
for($i=0; $i<count($zones); $i++) {
    $sql_ary = array(
        'signage_urgency_id'	=> $nextid,
        'zone_id'	            => $zones[$i],
    );
    $sql = 'INSERT INTO ' . SIGNAGE_URGENCY_ZONE_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);    
    $db->sql_query($sql);
}

if($room_id == "") {
    $sql = "SELECT room_id FROM ".ROOMS_TABLE." WHERE zone_id IN(".$zone_id.")";
    $result = $db->sql_query($sql);
    $room = array();
    while($row = $db->sql_fetchrow($result)) {
        $room[] = $row['room_id'];
    }
    $room_id = implode(",", $room);
}

$rooms = explode(",", $room_id);
for($i=0; $i<count($rooms); $i++) {
    $sql_ary = array(
        'signage_urgency_id'	=> $nextid,
        'room_id'	            => $rooms[$i],
    );
    $sql = 'INSERT INTO ' . SIGNAGE_URGENCY_ROOM_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);    
    $db->sql_query($sql);
}


?>