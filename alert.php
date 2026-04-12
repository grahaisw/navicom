<?php
/**
*
* alert.php	
*
* Agnes Emanuella, Nov 2014
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

$emergency_code = $_GET['code'];
$duration = $_GET['duration'];
$zone_id = $_GET['zone'];
$node_id = $_GET['node'];
$remark = $_GET['remark'];

$sql_ary = array(
    'signage_urgency_message'	        => $remark,
    'signage_urgency_duration'	        => $duration,
    'signage_urgency_enabled'	        => '1',
    'emergency_code'	                => $emergency_code,
    'signage_urgency_flag'              => 'emergency',
);

$sql = 'INSERT INTO ' . SIGNAGE_URGENCIES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);    
$result = $db->sql_query($sql);
$nextid = $db->sql_nextid();

if($result) {
	$zones = explode(",", $zone_id);
	for($i=0; $i<count($zones); $i++) {
		$sql_ary = array(
			'signage_urgency_id'	=> $nextid,
			'zone_id'	            => $zones[$i],
		);
		$sql = 'INSERT INTO ' . SIGNAGE_URGENCY_ZONE_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);   
			
		$result_zone = $db->sql_query($sql);
	}

	if($node_id == "") {
		$sql = "SELECT node_id FROM ".ROOMS_TABLE." WHERE zone_id IN(".$zone_id.")";
		$result = $db->sql_query($sql);
		$room = array();
		while($row = $db->sql_fetchrow($result)) {
			$room[] = $row['node_id'];
		}
		$node_id = implode(",", $room);
	}

	$nodes = explode(",", $node_id);
	for($i=0; $i<count($nodes); $i++) {
		$sql_ary = array(
			'signage_urgency_id'	=> $nextid,
			'room_id'	            => $nodes[$i], // room = node di airport
		);
		$sql = 'INSERT INTO ' . SIGNAGE_URGENCY_ROOM_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);    
		$result_node = $db->sql_query($sql);
	}
	
	
	$output = Array(  
		'body' => Array (
			'status' => 'OK',  
			'message' => 'The request has succeeded'
		)  
	); 
}

// Navicom Response in XML
header ("content-type: text/xml charset=utf-8");                   
$xml = new XmlWriter();
$xml->openMemory();
$xml->startDocument('1.0', 'UTF-8');
$xml->startElement('callback');
$xml->writeAttribute('xmlns:xsi','http://www.w3.org/2001/XMLSchema-instance');
$xml->writeAttribute('xsi:noNamespaceSchemaLocation','schema.xsd');
foreach($output as $key => $value){
	$xml->startElement($key);
	foreach ($value as $key1 => $value1) {
		$xml->writeElement($key1, $value1);		
	}
	$xml->endElement();
}

$xml->endElement();
echo $xml->outputMemory(true);

?>