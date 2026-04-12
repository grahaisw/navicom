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
require($tonjaw_root_path . 'fe_common.' . $phpEx);

//require($tonjaw_root_path . $config['include_path'] . 'functions.' . $phpEx);

$mod = $_GET['mod'];

if($mod == "scheduled_promo") {
	global $db, $config;
	
	$sql = "SELECT COUNT(tv_promo_id) AS total_row FROM ".TV_PROMO_TABLE." WHERE tv_promo_enabled = 1 AND (tv_promo_start <= '".mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"))."' AND tv_promo_end >= '".mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"))."')";
	$result = $db->sql_query($sql);
    $row_count = (int) $db->sql_fetchfield('total_row');
    $db->sql_freeresult($result);
	
	if($row_count > 0) {
		$sql = "SELECT * FROM ".TV_PROMO_TABLE." WHERE tv_promo_enabled = 1 AND (tv_promo_start <= '".mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"))."' AND tv_promo_end >= '".mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"))."')";
		$result = $db->sql_query($sql);
		$content = "";
		$i = 0;
		while($row = $db->sql_fetchrow($result)) {
			$title = $row['tv_promo_title'];
			$description = $row['tv_promo_description'];
			$thumbnail = $row['tv_promo_thumbnail'];
			$promo_image = $tonjaw_root_path . $config['media_path'] . $config['tv_icon_path'] . $thumbnail;
			$end = $row['tv_promo_end'];
			
			$i++;
		}
		
		//$source = array(0 => $title, 1 => $description, 2 => $promo_image, 3 => $end);
		//$src = implode(";", $source);
		$content = $promo_image;
       
	} else {
		if(!$config['tv_promo_random']) {
			$sql = "SELECT COUNT(tv_promo_id) AS total_entries FROM " . TV_PROMO_TABLE . " WHERE tv_promo_enabled = 1 AND tv_promo_default = 1";
			$result = $db->sql_query($sql);
			$count = (int) $db->sql_fetchfield('total_entries');	
			$db->sql_freeresult($result);
			if($count > 0) {
				$sql = "SELECT * FROM " . TV_PROMO_TABLE . " WHERE tv_promo_enabled = 1 AND tv_promo_default = 1";
				$result = $db->sql_query($sql);
				while ($row = $db->sql_fetchrow($result)) {
					$title = $row['tv_promo_title'];
					$description = $row['tv_promo_description'];
					$promo = $row['tv_promo_thumbnail'];
					$end = $row['tv_promo_end'];
				}
			} else {
				$config['tv_promo_random'] = true;
			}	
		} 

		if($config['tv_promo_random']) {
			$sql = "SELECT COUNT(tv_promo_id) AS total_entries FROM " . TV_PROMO_TABLE . " WHERE tv_promo_enabled = 1";
			$result = $db->sql_query($sql);
			$count = (int) $db->sql_fetchfield('total_entries');
			$db->sql_freeresult($result);
			if($count > 0) {
				$sql = "SELECT * FROM " . TV_PROMO_TABLE . " WHERE tv_promo_enabled = 1";
				$result = $db->sql_query($sql);
				$promo_enabled = array();
				while ($row = $db->sql_fetchrow($result)) {
					$title = $row['tv_promo_title'];
					$description = $row['tv_promo_description'];
					$promo_enabled[] = $row['tv_promo_thumbnail'];
					$end = $row['tv_promo_end'];
					
				}
				$promo_rand = array_rand($promo_enabled);
				$promo = $promo_enabled[$promo_rand];
			} else {
				$promo = '';
			}
				
		}

		if($promo != '') {
			$promo_image = $tonjaw_root_path . $config['media_path'] . $config['tv_promo_path'] . $promo;
		} else {
			$promo_image = '';
		}
		
		$content = $promo_image;
	}
	
	echo $content;
	
} else if($mod == "runningtext") {
	global $db, $config, $room_id, $node_id, $session, $lang;

	$lang_id = $_GET['lang'];

	$sql = "SELECT zone_id FROM ".ROOMS_TABLE." WHERE room_id = ".$room_id."";
	$result = $db->sql_query($sql);
	$zone_id = $db->sql_fetchfield('zone_id');
	$db->sql_freeresult($result);

	$sql = 'SELECT t.translation_message, r.message_id, r.message_global, r.message_daily, r.message_schedule_start, r.message_schedule_end 
			FROM ' . RUNNINGTEXT_TABLE . ' r 
			JOIN ' . RUNNINGTEXT_TRANSLATIONS_TABLE . " t ON t.message_id=r.message_id 
			LEFT JOIN " . RUNNINGTEXT_GROUPINGS_TABLE . " g ON r.message_id=g.message_id 
			LEFT JOIN " . ROOMS_TABLE . " ro ON ro.room_id=g.room_id 
			LEFT JOIN " . NODES_TABLE . " n ON n.room_id=ro.room_id
			LEFT JOIN " . ZONES_TABLE . " z ON z.zone_id=ro.zone_id 
			WHERE t.language_id='" . $lang_id . "' AND r.message_enabled=1 
			";
	$orderby = ' ORDER BY message_order ASC';
	$groupby = ' GROUP BY r.message_id, t.translation_message, r.message_global, r.message_daily, r.message_schedule_start, r.message_schedule_end, message_order';
    //echo $sql.$groupby.$orderby; exit;
    $result = $db->sql_query($sql.$groupby.$orderby);
    $text = ''; $temp_text = array();
    
    $result_array = array();
	$j = 0;
	while ($row = $db->sql_fetchrow($result))
	{	
		$result_array[$j] = array (
							"translation_message" 	=> $row['translation_message'],
							"message_id" 			=> $row['message_id'],
							"message_global" 		=> $row['message_global'],
							//"node_id" 				=> $row['node_id'],
							//"room_id" 				=> $row['room_id'],
							//"zone_id" 				=> $row['zone_id'],
							"message_daily" 		=> $row['message_daily'],
							"message_schedule_start" => $row['message_schedule_start'],
							"message_schedule_end" 	=> $row['message_schedule_end']
							);
							
		$j++;					
	}
	$db->sql_freeresult($result);						
	//unset($sql);	
	unset($row);
	
	$mktime = mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));
	$i = 0;
	for($k=0; $k<$j; $k++) {
		$filter = "";
		if($result_array[$k]['message_daily']) { // kalo daily=1, lihat timenya saja
			$current_time = date("His");
			$start_time = date("His", $result_array[$k]['message_schedule_start']);
			$end_time = date("His", $result_array[$k]['message_schedule_end']);
			$end_hour = substr($end_time,0,2);
			if($end_hour == '00') {
				$end_time = str_replace($end_hour, '24', $end_time);
			}
			
			if($current_time >= $start_time && $current_time <= $end_time) {
				$filter .= " AND (message_schedule_start <= ".$mktime." OR message_schedule_end >= ".$mktime.") AND r.message_id = ".$result_array[$k]['message_id']."";
				
				if( $result_array[$k]['message_global'] == 1) {
					$filter .= " AND (n.node_id=$node_id OR r.message_global=1)";
				} else {
					$filter .= " AND n.node_id=$node_id";
				}
			}
		} else {
			
			$filter = " AND (message_schedule_start <= ".$mktime." AND message_schedule_end >= ".$mktime.")";
			
			if( $result_array[$k]['message_global'] == 1) {
				$filter .= " AND (n.node_id=$node_id OR r.message_global=1)";
			} else {
				$filter .= " AND n.node_id=$node_id";
			}
			
		}
	
		if(!empty($filter)) {
			$sql2 = $sql.$filter;
			//echo $sql2; exit;
			$result2 = $db->sql_query($sql2);
			//$i = 0;
			while ($row2 = $db->sql_fetchrow($result2))
			{	//echo $i.' -- '.$temp_text[$i].' -- '.$text.'<br>'; 
				if(!in_array($row2['translation_message'], $temp_text)) {
					$sql_fids_count = "SELECT COUNT(*) AS total_row FROM " . RUNNINGTEXT_FIDS_GROUPINGS_TABLE . " WHERE message_id = '".$row2['message_id']."'";
					$result_fids_count = $db->sql_query($sql_fids_count);
					$total_row = $db->sql_fetchfield('total_row');
					
					if($total_row > 0) {
						$sql_fids = "SELECT fids_airline_code FROM " . AIRPORT_FIDS_TABLE . " f JOIN " . RUNNINGTEXT_FIDS_GROUPINGS_TABLE . " r ON f.fids_flight = r.fids_flight WHERE r.message_id = '".$row2['message_id']."'";
						$result_fids = $db->sql_query($sql_fids);
						$fids_airline_code = $db->sql_fetchfield('fids_airline_code');
						
						$message_text = str_replace('[LOGO]', '<img src="./media/images/flight/'.strtoupper($fids_airline_code).'.png" height="60" style="vertical-align:middle;margin:0 30px 0 0;" />', $row2['translation_message']);
					} else {
						$message_text = $row2['translation_message'];
					}
					
					$text .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$message_text;
					$temp_text[$i] = $row2['translation_message'];
					$i++;
				}	
			}
		}
		$db->sql_freeresult($result2);
		unset($sql2);
		unset($row2);
		
	}
	
	$guest = get_guests_data();

	$guest_name = $guest[0]['salutation'].' '.$guest[0]['fullname'];
	if(in_array($session->ip, $config['list_ip_static'])) {
		$text = str_replace('[GUEST]', $lang['guest_greetings'], $text);
	} else {
		$text = str_replace('[GUEST]', $guest_name, $text);
	}

	echo htmlspecialchars_decode($text);

} else if($mod == "runningtext_2") {
	global $db, $config, $room_id, $node_id, $session, $lang;

	$lang_id = $_GET['lang'];

	$sql = "SELECT zone_id FROM ".ROOMS_TABLE." WHERE room_id = ".$room_id."";
	$result = $db->sql_query($sql);
	$zone_id = $db->sql_fetchfield('zone_id');
	$db->sql_freeresult($result);

	/*$sql = 'SELECT t.translation_message, r.message_id, r.message_global, g.room_id, z.zone_id, r.message_daily, r.message_schedule_start, r.message_schedule_end
	FROM ' . RUNNINGTEXT_TABLE . ' r 
	JOIN ' . RUNNINGTEXT_TRANSLATIONS_TABLE . ' t ON t.message_id=r.message_id 
	LEFT JOIN ' . RUNNINGTEXT_GROUPINGS_TABLE . ' g ON g.message_id=r.message_id 
	LEFT JOIN ' . RUNNINGTEXT_ZONE_GROUPINGS_TABLE . " z ON z.message_id=r.message_id 
	WHERE t.language_id='" . $lang_id . "' AND r.message_enabled=1 ";    
	*/
	$sql = 'SELECT t.translation_message, r.message_id, r.message_global, g.room_id, z.zone_id, r.message_daily, r.message_schedule_start, r.message_schedule_end 
			FROM ' . RUNNINGTEXT_TABLE . ' r 
			JOIN ' . RUNNINGTEXT_TRANSLATIONS_TABLE . " t ON t.message_id=r.message_id 
			LEFT JOIN " . RUNNINGTEXT_GROUPINGS_TABLE . " g ON r.message_id=g.message_id 
			LEFT JOIN " . ROOMS_TABLE . " ro ON ro.room_id=g.room_id 
			LEFT JOIN " . NODES_TABLE . " n ON n.room_id=ro.room_id
			LEFT JOIN " . ZONES_TABLE . " z ON z.zone_id=ro.zone_id 
			WHERE t.language_id='" . $lang_id . "' AND r.message_enabled=1 
			";
	$orderby = ' ORDER BY message_order ASC';
    //echo $sql; exit;
    $result = $db->sql_query($sql.$orderby);
    $text = ''; $temp_text = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
		$mktime = mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));
		$filter = "";
		
		//if( $row['room_id'] == $room_id || $row['zone_id'] == $zone_id )
		//{
			if($row['message_daily']) { // kalo daily=1, lihat timenya saja
				$current_time = date("His");
				$start_time = date("His", $row['message_schedule_start']);
				$end_time = date("His", $row['message_schedule_end']);
				$end_hour = substr($end_time,0,2);
				if($end_hour == '00') {
					$end_time = str_replace($end_hour, '24', $end_time);
				}
				//echo $current_time.' '.$start_time.' '.$end_time;
				if($current_time >= $start_time && $current_time <= $end_time) {
					
					//$filter .= " AND (message_schedule_start <= ".time()." OR message_schedule_end >= ".time().") AND r.message_id = ".$row['message_id']."";
					$filter .= " AND (message_schedule_start <= ".$mktime." OR message_schedule_end >= ".$mktime.") AND r.message_id = ".$row['message_id']."";
					
					if( $row['message_global'] == 1) {
						$filter .= " AND (n.node_id=$node_id OR r.message_global=1)";
					} else {
						$filter .= " AND n.node_id=$node_id";
					}
				}
			} else {
				
				//$filter = " AND (message_schedule_start <= ".$mktime." AND message_schedule_end >= ".$mktime.")";
				//$filter = " AND ((message_schedule_start <= ".time()." AND message_schedule_end >= ".time().") AND n.node_id=$node_id)";
				$filter = " AND (message_schedule_start <= ".$mktime." AND message_schedule_end >= ".$mktime.")";
				
				if( $row['message_global'] == 1) {
					$filter .= " AND (n.node_id=$node_id OR r.message_global=1)";
				} else {
					$filter .= " AND n.node_id=$node_id";
				}
				
				/*if( $row['message_global'] == 1) {
					$filter .= " AND r.message_global=1";
				}*/
			}
		//}
		
		if(!empty($filter)) {
			$sql2 = $sql.$filter;
			//echo $sql2; //exit;
			$result2 = $db->sql_query($sql2);
			$i = 0;
			while ($row2 = $db->sql_fetchrow($result2))
			{	//echo $i.' -- '.$temp_text[$i].' -- '.$text.'<br>'; 
				if(!in_array($row2['translation_message'], $temp_text)) {
					$text .= $row2['translation_message'] . '. ';
					$temp_text[$i] = $row2['translation_message'];
					$i++;
				}	
			}
		}
		
    }
	
    //exit;
    $db->sql_freeresult($result);
	
	$guest = get_guests_data();

	$guest_name = $guest[0]['salutation'].' '.$guest[0]['fullname'];
	if(in_array($session->ip, $config['list_ip_static'])) {
		$text = str_replace('[GUEST]', $lang['guest_greetings'], $text);
	} else {
		$text = str_replace('[GUEST]', $guest_name, $text);
	}

	echo $text;

} else if($mod == "popup") {
	global $db, $config;
	
	$tv_channel_id = $_GET['tv_channel_id'];
	$current_time = date("H:i", time());
	
	
	$sql_count = "SELECT COUNT(*) AS total_data FROM " . ADS_POPUP_VIEW . " WHERE node_ip = '".$session->ip."' AND ads_popup_schedule_start <= ".time()." AND ads_popup_schedule_end > ".time()."";
	$result_count = $db->sql_query($sql_count);
	$total_data = $db->sql_fetchfield('total_data');
	
	$db->sql_freeresult($result_count);
	
	if($total_data > 0) {
		$sql = "SELECT * FROM " . ADS_POPUP_VIEW . " WHERE node_ip = '".$session->ip."' AND ads_popup_schedule_start <= ".time()." AND ads_popup_schedule_end > ".time()." ORDER BY ads_popup_schedule_start";
		$result = $db->sql_query($sql);
		while($row = $db->sql_fetchrow($result)) {
			$schedule_id = $row['ads_popup_schedule_id'];
			$schedule_start = $row['ads_popup_schedule_start'];
			$schedule_start_time = date("H:i", $schedule_start);
			
			if($schedule_start_time == $current_time) {
			
				$sql2 = "SELECT COUNT(*) AS total_entries FROM " . ADS_CHANNEL_GROUPINGS_TABLE . " WHERE tv_channel_id = ".$tv_channel_id." AND ads_popup_schedule_id = ".$schedule_id."";
				$result2 = $db->sql_query($sql2);
				$total_entries = $db->sql_fetchfield('total_entries');
				
				$db->sql_freeresult($result2);
				
				if($total_entries > 0) {
					$content['duration'] = $row['ads_popup_schedule_duration'];
					$content['image'] = $row['ads_popup_image'];
					$content['image'] = $tonjaw_root_path.$config['media_path'].$config['ads_popup_path'].$content['image'];
					
					// write log
					$sql_ary = array(
						'ads_log_timestamp'		=> time(),
						'ads_log_type'			=> 'popup',
						'ads_popup_id'			=> $row['ads_popup_id'],
						'node_id'				=> $row['node_id'],
						'tv_channel_id'			=> $tv_channel_id,
					);
					
					$sql_log = "INSERT INTO " . ADS_LOGS_TABLE . " " . $db->sql_build_array('INSERT', $sql_ary);
					$db->sql_query($sql_log);
					
					$output = implode("|", $content);
				}
			} 
		}
	}
	$db->sql_freeresult($result);
	
	echo $output;
	
} else if($mod == "clearbasket") {
	global $db, $config;
	
	$resv_id = $_GET['resv_id'];
	$room = $_GET['room'];
	
	$sql = "DELETE FROM ".GUEST_BASKETS_TABLE." WHERE guest_reservation_id = ".$resv_id." AND room_name = '".$room."'";
	$result = $db->sql_query($sql);
	echo $sql;
	//if($result) echo 1;
	//else echo 0;
	
} else if($mod == "flight_status") {
	global $db, $config, $session;
	
	$data_flight = array();
	$data = array();
	$flights_id = array();
	
	$sql_node = "SELECT COUNT(*) AS total_nodes FROM " . NODES_TABLE . " 
			WHERE node_enabled = 1";
	$result_node = $db->sql_query($sql_node);
	$total_nodes = $db->sql_fetchfield('total_nodes');
	
	$sql = "SELECT COUNT(*) AS total_data FROM " . AIRPORT_FIDS_TABLE . " a 
			JOIN " . AIRPORT_FLIGHT_STATUS_TABLE . " f ON upper(a.fids_remark) = upper(f.airport_flight_status_remark) 
			WHERE fids_changed = 1 AND airport_flight_status_display_on_tv = 1 AND node_counter < " . $total_nodes;
	$result = $db->sql_query($sql);
	$total_data = $db->sql_fetchfield('total_data');
	
	if($total_data > 0) { // jika ada perubahan status flight
		$sql2 = "SELECT airport_flight_status_display_mode, airport_flight_status_priority, airport_flight_status_remark, fids_flight, fids_type, fids_city, fids_terminal, fids_gate, fids_time, fids_id, fids_airline_code, airport_flight_status_duration, airport_flight_status_display_period, airport_flight_status_ended_in, node_counter	
			FROM " . AIRPORT_FIDS_TABLE . " a 
			JOIN " . AIRPORT_FLIGHT_STATUS_TABLE . " f ON upper(a.fids_remark) = upper(f.airport_flight_status_remark) 
			WHERE fids_changed = 1 AND  airport_flight_status_display_on_tv = 1
			ORDER BY fids_lastupdate ASC LIMIT 1";
		//echo $sql2; 
		$result2 = $db->sql_query($sql2);
		$row = $db->sql_fetchrow($result2);
		
		$mode = $row['airport_flight_status_display_mode'];
		$priority = $row['airport_flight_status_priority'];
		$remark = $row['airport_flight_status_remark'];
		$flight_no = $row['fids_flight'];
		$gate = $row['fids_gate'];
		$time = $row['fids_time'];
		$city = $row['fids_city'];
		$code = $row['fids_airline_code'];
		$node_counter = $row['node_counter'];
		$duration = $row['airport_flight_status_duration'];
		$display_period = $row['airport_flight_status_display_period'];
		$ended_in = $row['airport_flight_status_ended_in'];
		$logo_path = $tonjaw_root_path . $config['media_path'] . $config['flight_icon_path'] . strtoupper($code) . '.png';
		
			
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
		//$content[0] = $data;
		
		if($node_counter < $total_nodes) {
			$node_counter++;
			
			$sql_update_counter = "UPDATE " . AIRPORT_FIDS_TABLE . " SET node_counter = ".$node_counter." WHERE fids_id = ".$row['fids_id'];
			$db->sql_query($sql_update_counter);
		}
		
		if($node_counter >= $total_nodes) {
			$sql_update = "UPDATE " . AIRPORT_FIDS_TABLE . " SET fids_changed = 2 WHERE fids_id = ".$row['fids_id'];
			$db->sql_query($sql_update);
		}
			
	
		//$output = implode("|", $content);
		$output = $data;
		
		$db->sql_freeresult($result2);
	} else {
		$output = ".";
	}
	
	$db->sql_freeresult($result);
	
	echo $output;
	
} else if($mod == "flight_status_2") {
	global $db, $config;
	
	$data_flight = array();
	$data = array();
	$flights_id = array();
	
	$sql = "SELECT COUNT(*) AS total_data FROM " . AIRPORT_FIDS_TABLE . " a 
			JOIN " . AIRPORT_FLIGHT_STATUS_TABLE . " f ON upper(a.fids_remark) = upper(f.airport_flight_status_remark) 
			WHERE fids_changed = 1 AND airport_flight_status_display_on_tv = 1";
	$result = $db->sql_query($sql);
	$total_data = $db->sql_fetchfield('total_data');
	
	if($total_data > 0) { // jika ada perubahan status flight
		$sql2 = "SELECT airport_flight_status_display_mode, airport_flight_status_priority, airport_flight_status_remark, fids_flight, fids_type, fids_city, fids_terminal, fids_gate, fids_time, fids_id, fids_airline_code, airport_flight_status_duration, airport_flight_status_display_period, airport_flight_status_ended_in	
			FROM " . AIRPORT_FIDS_TABLE . " a 
			JOIN " . AIRPORT_FLIGHT_STATUS_TABLE . " f ON upper(a.fids_remark) = upper(f.airport_flight_status_remark) 
			WHERE fids_changed = 1 AND  airport_flight_status_display_on_tv = 1
			ORDER BY fids_lastupdate ASC LIMIT 1";
		//echo $sql2; 
		$result2 = $db->sql_query($sql2);
		$data_flight = array();
		$i = 0;
		while($row = $db->sql_fetchrow($result2)) {
			$mode = $row['airport_flight_status_display_mode'];
			$priority = $row['airport_flight_status_priority'];
			$remark = $row['airport_flight_status_remark'];
			$flight_no = $row['fids_flight'];
			$gate = $row['fids_gate'];
			$time = $row['fids_time'];
			$city = $row['fids_city'];
			$code = $row['fids_airline_code'];
			//$room_id = $row['room_id'];
			$duration = $row['airport_flight_status_duration'];
			$display_period = $row['airport_flight_status_display_period'];
			$ended_in = $row['airport_flight_status_ended_in'];
			$logo_path = $tonjaw_root_path . $config['media_path'] . $config['flight_icon_path'] . strtoupper($code) . '.png';
			
			if($mode == "runningtext") {
				$sql_count = "SELECT COUNT(*) AS total_row FROM " . RUNNINGTEXT_FIDS_GROUPINGS_TABLE . " WHERE fids_flight = '".$flight_no."'";
				$result_count = $db->sql_query($sql_count);
				$total_row = $db->sql_fetchfield('total_row');
				
				if($total_row == 0) {
				
					$start = time();
					if($display_period == "time") {
						$end = mktime(date("H"), date("i")+$ended_in, 0, date("m"), date("d"), date("Y"));
					} else if($display_period == "status") {
						$end = mktime(date("H"), date("i"), 0, date("m"), date("d")+$config['display_period_days'], date("Y"));
					}
					$text = '[LOGO]'.$flight_no.' - '.$city.' - '.'Gate '.$gate.' - '.$time.' - '.$remark.' ';
					
					$sql_ary = array(
						'message_global'			=> 1,
						'message_enabled'			=> 1,
						'message_schedule_start'	=> (int) $start,
						'message_schedule_end'		=> (int) $end,
						'message_daily'				=> 0,
						'message_order'				=> 1,
					);
					
					$sql = 'INSERT INTO ' . RUNNINGTEXT_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
					//echo $sql;// exit;
					$db->sql_query($sql);
					$mid = $db->sql_nextid();
					/*
					$sql_zone = "SELECT zone_id FROM " . ROOMS_TABLE . " WHERE room_id = ".$room_id;
					$result_zone = $db->sql_query($sql_zone);
					$zone_id = $db->sql_fetchfield('zone_id');
					*/
					/* room grouping */
					/*$sql_ary = array(
						'message_id'	=> $mid,
						'room_id'		=> $room_id,
					);
						
					$sql_grouping = 'INSERT INTO ' . RUNNINGTEXT_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
						//echo $sql . 'master<p>'; //exit;
					$db->sql_query($sql_grouping);
					*/
					/* zone grouping */
					/*$sql_ary = array(
						'message_id'	=> $mid,
						'zone_id'		=> $zone_id,
					);
						
					$sql_grouping1 = 'INSERT INTO ' . RUNNINGTEXT_ZONE_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
						//echo $sql . 'master<p>'; //exit;
					$db->sql_query($sql_grouping1);
					*/
					/* FIDS grouping */
					$sql_ary = array(
						'message_id'	=> $mid,
						'fids_flight'	=> $flight_no,
					);
						
					$sql_grouping2 = 'INSERT INTO ' . RUNNINGTEXT_FIDS_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
						//echo $sql . 'master<p>'; //exit;
					$db->sql_query($sql_grouping2);
					
					/* set translation */
					$sql_translation = array(
						'message_id'				=> (int) $mid,
						'translation_message'		=> (string) $text,
						'translation_description'	=> (string) $text,
						'language_id'				=> (string) 'en',
					);
					
					$sql_trans = 'INSERT INTO ' . RUNNINGTEXT_TRANSLATIONS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_translation);
					$db->sql_query($sql_trans);
					
					$data_flight[$i] = array (
						"mode"		=> $mode,
						"id"		=> $mid,
					);
					
					$data = implode(";", $data_flight[$i]);
					$content[$i] = $data;
					
				} else {
					if($display_period == "time") {
						$end = mktime(date("H"), date("i")+$ended_in, 0, date("m"), date("d"), date("Y"));
					} else if($display_period == "status") {
						$end = mktime(date("H"), date("i"), 0, date("m"), date("d")+$config['display_period_days'], date("Y"));
					}
					
					$sql_runningtext = "SELECT message_id FROM " . RUNNINGTEXT_FIDS_GROUPINGS_TABLE . " WHERE fids_flight = '".$flight_no."'";
					$result_runningtext = $db->sql_query($sql_runningtext);
					$mid = $db->sql_fetchfield('message_id');
					
					$text = '[LOGO]'.$flight_no.' - '.$city.' - '.'Gate '.$gate.' - '.$time.' - '.$remark.' ';
					
					$sql_update = "UPDATE " . RUNNINGTEXT_TRANSLATIONS_TABLE . " SET translation_message = '".$text."', translation_description = '".$text."' WHERE message_id = ".$mid;
					$db->sql_query($sql_update);
					
					$sql_update2 = "UPDATE " . RUNNINGTEXT_TABLE . " SET message_schedule_end = ".$end." WHERE message_id = ".$mid;
					$db->sql_query($sql_update2);
					
				}
				
				$data_flight[$i] = array (
					"mode"		=> $mode,
					"id"		=> $mid,
				);
				
				$data = implode(";", $data_flight[$i]);
				$content[$i] = $data;
				
			} else {	
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
					
						$data_flight[$i] = array(
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
					$data_flight[$i] = array(
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

				$data = implode(";", $data_flight[$i]);
				$content[$i] = $data;
				
			}
						 
			$sql_update = "UPDATE " . AIRPORT_FIDS_TABLE . " SET fids_changed = 2 WHERE fids_id = ".$row['fids_id'];
			$db->sql_query($sql_update);
			
			$i++;
		}
	
		$output = implode("|", $content);
		$db->sql_freeresult($result2);
	} else {
		$output = "";
	}
	
	$db->sql_freeresult($result);
	
	echo $output;
	
} 

?>
