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

if($mod == "runningtext") {
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
		$filter = "";
		
		//if( $row['room_id'] == $room_id || $row['zone_id'] == $zone_id )
		//{
			//if($row['message_daily']) { // kalo daily=1, lihat timenya saja
				$current_time = date("His");
				$start_time = date("His", $row['message_schedule_start']);
				$end_time = date("His", $row['message_schedule_end']);
				$end_hour = substr($end_time,0,2);
				if($end_hour == '00') {
					$end_time = str_replace($end_hour, '24', $end_time);
				}
				//echo $current_time.' '.$start_time.' '.$end_time;
				if($current_time >= $start_time && $current_time <= $end_time) {
					//$filter = " AND (r.message_id = ".$row['message_id']." OR n.node_id=$node_id)";
					$filter .= " AND (message_schedule_start <= ".time()." OR message_schedule_end >= ".time().") AND r.message_id = ".$row['message_id']."";
					
					if( $row['message_global'] == 1) {
						$filter .= " AND (n.node_id=$node_id OR r.message_global=1)";
					} else {
						$filter .= " AND n.node_id=$node_id";
					}
				}
			/*} else {
				$mktime = mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));
				//$filter = " AND (message_schedule_start <= ".$mktime." AND message_schedule_end >= ".$mktime.")";
				$filter = " AND ((message_schedule_start <= ".time()." AND message_schedule_end >= ".time().") AND n.node_id=$node_id)";
				
				if( $row['message_global'] == 1) {
					$filter .= " AND r.message_global=1";
				}
			}*/
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

} 

?>
