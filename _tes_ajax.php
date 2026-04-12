<?php

/**
*
* ajax.php	
*
* Agnes Emanuella, Dec 2014
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
//require($tonjaw_root_path . 'fe_common.' . $phpEx);

global $db, $config, $session;
	
	$data_flight = array();
	$data = array();
	$flights_id = array();
	
	
	
	$sql = "SELECT COUNT(*) AS total_data FROM " . AIRPORT_FIDS_TABLE . " a 
			JOIN " . AIRPORT_FLIGHT_STATUS_TABLE . " f ON upper(a.fids_remark) = upper(f.airport_flight_status_remark) 
			WHERE fids_changed = 1 AND airport_flight_status_display_on_tv = 1";
	$result = $db->sql_query($sql);
	$total_data = $db->sql_fetchfield('total_data');
	echo "data = $total_data\n";
	if($total_data > 0) { // jika ada perubahan status flight
		$sql2 = "SELECT airport_flight_status_display_mode, airport_flight_status_priority, airport_flight_status_remark, fids_flight, fids_type, fids_city, fids_terminal, fids_gate, fids_time, fids_id, fids_airline_code, airport_flight_status_duration, airport_flight_status_display_period, airport_flight_status_ended_in, airport_fids_update_id	
			FROM " . AIRPORT_FIDS_TABLE . " a 
			JOIN " . AIRPORT_FLIGHT_STATUS_TABLE . " f ON upper(a.fids_remark) = upper(f.airport_flight_status_remark) 
			WHERE fids_changed = 1 AND  airport_flight_status_display_on_tv = 1
			ORDER BY fids_lastupdate ASC LIMIT 1";
		//echo $sql2; 
		$result2 = $db->sql_query($sql2);
		$row = $db->sql_fetchrow($result2);
		echo "\n"; print_r($result2); exit;
		
		$mode = $row['airport_flight_status_display_mode'];
		$priority = $row['airport_flight_status_priority'];
		$remark = $row['airport_flight_status_remark'];
		$flight_no = $row['fids_flight'];
		$gate = $row['fids_gate'];
		$time = $row['fids_time'];
		$city = $row['fids_city'];
		$code = $row['fids_airline_code'];
		$airport_fids_update_id = $row['airport_fids_update_id'];
		$duration = $row['airport_flight_status_duration'];
		$display_period = $row['airport_flight_status_display_period'];
		$ended_in = $row['airport_flight_status_ended_in'];
		$logo_path = $tonjaw_root_path . $config['media_path'] . $config['flight_icon_path'] . strtoupper($code) . '.png';
		
		$sql_node = "SELECT node_id FROM " . NODES_TABLE . " WHERE node_ip = '".$session->ip."'";
		$result_node = $db->sql_query($sql_node);
		//$node_id = $db->sql_fetchfield('node_id');
		$node_id = 604;
		$sql_check = "SELECT COUNT(*) AS total_grouping FROM " . AIRPORT_FIDS_GROUPINGS_TABLE . " g 
				JOIN " . AIRPORT_FIDS_TABLE . " a ON a.airport_fids_update_id = g.airport_fids_update_id
				WHERE g.node_id = ".$node_id." AND upper(g.fids_remark) = '".strtoupper($remark)."'";
		$result_check = $db->sql_query($sql_check);
		$total_grouping = $db->sql_fetchfield('total_grouping');
		
		if($total_grouping == 0) {
			
			if($display_period == "time") {
				$lastupdate = date("Y-m-d H:i:s", $fids_lastupdate);
				$hour = date("H", $fids_lastupdate);
				$minute = date("i", $fids_lastupdate);
				$year = date("Y", $fids_lastupdate);
				$month = date("m", $fids_lastupdate);
				$day = date("d", $fids_lastupdate);
				$end = mktime($hour, $minute+$ended_in, 0, $month, $day, $year);
				$current_time = time();
				
				if($current_time <= $end) {
				
					$data_flight = array(
						"mode" 		=> $mode, 
						"flight_no" => $flight_no,
						"remark"	=> $remark,
						"priority"	=> $priority,
						"gate"		=> 'Gate '.$gate,
						"time"		=> $time,
						"city"		=> $city,
						"logo"		=> $logo_path,
						"duration"	=> $duration
					);
				}
				
			} else {	
				$data_flight = array(
					"mode" 		=> $mode, 
					"flight_no" => $flight_no,
					"remark"	=> $remark,
					"priority"	=> $priority,
					"gate"		=> 'Gate '.$gate,
					"time"		=> $time,
					"city"		=> $city,
					"logo"		=> $logo_path,
					"duration"	=> $duration
				);
			}

			$data = implode(";", $data_flight);
			$output = $data;
			
			$sql_ary = array(
				'airport_fids_update_id' 		=> $airport_fids_update_id,
				'node_id'						=> $node_id,
				'fids_remark'					=> $remark,
			);
			
			$sql_insert = 'INSERT INTO ' . AIRPORT_FIDS_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
			echo "Insert Grouping SQL $sql_insert"; exit;
			$db->sql_query($sql_insert);
			
		} else {
			$output = "";
		}
		
		/*if($node_counter < $total_nodes) {
			$node_counter++;
			
			$sql_update_counter = "UPDATE " . AIRPORT_FIDS_TABLE . " SET node_counter = ".$node_counter." WHERE fids_id = ".$row['fids_id'];
			$db->sql_query($sql_update_counter);
		}
		
		if($node_counter >= $total_nodes) {
			$sql_update = "UPDATE " . AIRPORT_FIDS_TABLE . " SET fids_changed = 2 WHERE fids_id = ".$row['fids_id'];
			$db->sql_query($sql_update);
		}*/
			
	
		//$output = implode("|", $content);
		
		
		$db->sql_freeresult($result2);
	} else {
		$output = ".";
	}
	
	$db->sql_freeresult($result);
	
	echo $output;










?>
