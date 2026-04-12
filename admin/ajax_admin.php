<?php



/**
*
* ajax_admin.php	
*
* Agnes Emanuella, Dec 2015
*/

define('IN_TONJAW', true);
define('IN_ADMIN', true);
define('NEED_SID', true);

$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './../';
$phpEx = substr(strrchr( $_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr( $_SERVER['PHP_SELF'], '/'), 1));

// Include files
require($tonjaw_root_path . 'common.' . $phpEx);
$tonjaw_admin_path = $tonjaw_root_path . $config['admin_path'];
require($tonjaw_admin_path . 'common_adm.' . $phpEx);

//require($tonjaw_root_path . $config['include_path'] . 'functions.' . $phpEx);

$mod = $_GET['mod'];

if($mod == "upload") {
	$resv_id = $_GET['resv_id'];
	$filename = explode(".", $_GET['filename']);
	$format = $filename[count($filename)-1];
	
	echo $_GET['filename'];

} else if($mod == "epg") {
	global $db, $config;
	
	$tv_channel_id = $_GET['tv_channel_id'];
	$filename = explode(".", $_GET['filename']);
	$format = $filename[count($filename)-1];
	
	echo $_GET['filename'];
	
} else if($mod == "log_date") {
	global $db, $config;
	
	$start = $_GET['start'];
	$start = explode("-", $start);
	$start_date = mktime(0, 0, 0, $start[1], $start[2], $start[0]);
	$end = $_GET['end'];
	$end = explode("-", $end);
	$end_date = mktime(23, 59, 59, $end[1], $end[2], $end[0]);
	
	$sql = "SELECT * FROM " . PROVISIONING_LOGS_TABLE . "
			WHERE provisioning_log_time BETWEEN ".$start_date." AND ".$end_date."";
	$result = $db->sql_query($sql);
	$i = 0;
	$jsonResult = '[ ';
	while($row = $db->sql_fetchrow($result)) {
		if($i > 0){
			$jsonResult .= ',';
		}
		$data[$i] = array(
			"time" 			=> date($config['log_dateformat'], $row['provisioning_log_time']), 
			"command" 		=> $row['provisioning_log_command'], 
			"stb_id" 		=> $row['stb_id'], 
			"subscriber_id" => $row['subscriber_id'], 
			"message" 		=> $row['provisioning_log_message']
		);
		$jsonResult .= json_encode($data[$i]);
				
		$i++;
	}
	
	$jsonResult .= ' ]';
	
    $db->sql_freeresult($result);
		
	echo $jsonResult;
	
} else if($mod == "channel_log_date") {
	global $db, $config;
	
	$mode = $_GET['mode'];
	$start = $_GET['start'];
	$start = explode("-", $start);
	$start_date = mktime(0, 0, 0, $start[1], $start[2], $start[0]);
	$end = $_GET['end'];
	$end = explode("-", $end);
	$end_date = mktime(23, 59, 59, $end[1], $end[2], $end[0]);
	
	if($mode == "subs") {
		$sql = "SELECT l.tv_channel_id, c.tv_channel_name,room_name,l.tv_channel_log_timestamp, SUM(tv_channel_log_duration) AS total_duration
			FROM " . TV_CHANNEL_LOG_TABLE . " l 
			LEFT JOIN " . TV_CHANNELS_TABLE . " c ON l.tv_channel_id = c.tv_channel_id
			LEFT JOIN " . NODES_TABLE . " n ON l.node_id = n.node_id
			LEFT JOIN " . ROOMS_TABLE . " r ON n.room_id = r.room_id
			WHERE l.tv_channel_log_timestamp BETWEEN  ".$start_date."  AND ".$end_date."
			GROUP BY l.tv_channel_id, tv_channel_name,room_name,l.tv_channel_log_timestamp
			ORDER BY tv_channel_name ASC";
		$result = $db->sql_query($sql);
		$i = 0;
		$jsonResult = '[ ';
		while($row = $db->sql_fetchrow($result)) {
			$sql_log = "SELECT COUNT(*) AS total_log FROM " . TV_CHANNEL_LOG_TABLE . " WHERE tv_channel_id = ".$row['tv_channel_id']." AND tv_channel_log_timestamp BETWEEN  ".$start_date."  AND ".$end_date."";
			$result_log = $db->sql_query($sql_log);
			$total_log = $db->sql_fetchfield('total_log');
			
			$db->sql_freeresult($result_log);
			
			if($i > 0){
				$jsonResult .= ',';
			}
			
			$duration = $row['total_duration'];
		
			$duration_hour = floor($duration / 3600);
			$duration_hour_mod = $duration % 3600;
			if($duration_hour_mod > 0) {
				$duration_min = floor($duration_hour_mod / 60);
				$duration_sec = $duration_hour_mod % 60;
			} else {
				$duration_min = 0;
				$duration_sec = 0;
			}
			
			$data[$i] = array(
				'subs_name'		=> $row['room_name'],
				'name'			=> $row['tv_channel_name'],
				'total_log'		=> $total_log,
				'duration'		=> $duration_hour." hour(s) ".$duration_min." minute(s) ".$duration_sec." second(s) ",
			);
			$jsonResult .= json_encode($data[$i]);
					
			$i++;
		}
	} else {
		$sql = "SELECT l.tv_channel_id, c.tv_channel_name, SUM(tv_channel_log_duration) AS total_duration
			FROM " . TV_CHANNEL_LOG_TABLE . " l 
			LEFT JOIN " . TV_CHANNELS_TABLE . " c ON l.tv_channel_id = c.tv_channel_id
			WHERE tv_channel_log_timestamp BETWEEN ".$start_date." AND ".$end_date."
			GROUP BY l.tv_channel_id, tv_channel_name	
			ORDER BY tv_channel_name ASC";
		$result = $db->sql_query($sql);
		$i = 0;
		$jsonResult = '[ ';
		while($row = $db->sql_fetchrow($result)) {
			$sql_log = "SELECT COUNT(*) AS total_log FROM " . TV_CHANNEL_LOG_TABLE . " WHERE tv_channel_id = ".$row['tv_channel_id']." AND tv_channel_log_timestamp BETWEEN  ".$start_date."  AND ".$end_date."";
			$result_log = $db->sql_query($sql_log);
			$total_log = $db->sql_fetchfield('total_log');
			
			$db->sql_freeresult($result_log);
			
			if($i > 0){
				$jsonResult .= ',';
			}
			
			$duration = $row['total_duration'];
		
			$duration_hour = floor($duration / 3600);
			$duration_hour_mod = $duration % 3600;
			if($duration_hour_mod > 0) {
				$duration_min = floor($duration_hour_mod / 60);
				$duration_sec = $duration_hour_mod % 60;
			} else {
				$duration_min = 0;
				$duration_sec = 0;
			}
			
			$data[$i] = array(
				'name'			=> $row['tv_channel_name'],
				'total_log'		=> $total_log,
				'duration'		=> $duration_hour.":".$duration_min.":".$duration_sec,
			);
			$jsonResult .= json_encode($data[$i]);
					
			$i++;
		}
	}
	$jsonResult .= ' ]';
	
    $db->sql_freeresult($result);
		
	echo $jsonResult;
	
} else if($mod == "ads_log_date") {
	global $db, $config;
	
	$mode = $_GET['mode'];
	$type = $_GET['type'];
	$start = $_GET['start'];
	$start = explode("-", $start);
	$start_date = mktime(0, 0, 0, $start[1], $start[2], $start[0]);
	$end = $_GET['end'];
	$end = explode("-", $end);
	$end_date = mktime(23, 59, 59, $end[1], $end[2], $end[0]);
	
	switch($type) {
		case 'banner'	: $table = ADS_BANNERS_TABLE; break;
		case 'popup'	: $table = ADS_POPUPS_TABLE; break;
		case 'home'		: $table = ADS_HOME_TABLE; break;
	}
	
	if($mode == "subs") {
		$sql_ads = "SELECT * FROM ".$table." WHERE ads_".$type."_enabled = 1 ORDER BY ads_".$type."_id";
		$result_ads = $db->sql_query($sql_ads);
		$i = 0;
		$jsonResult = '[ ';
		while($row_ads = $db->sql_fetchrow($result_ads)) {	
			$ads_name = $row_ads['ads_'.$type.'_name'];
			
			if($i > 0){
				$jsonResult .= ',';
			}
			
			$sql = "SELECT n.room_id, room_name, ads_".$type."_id, COUNT(ads_log_id) AS count_log, ads_log_timestamp
				FROM " . ADS_LOGS_TABLE . " l 
				LEFT JOIN ". TV_CHANNELS_TABLE ." p ON l.tv_channel_id = p.tv_channel_id
				LEFT JOIN " . NODES_TABLE . " n ON l.node_id = n.node_id
				LEFT JOIN " . ROOMS_TABLE . " r ON n.room_id = r.room_id
				WHERE room_enabled = 1 AND ads_".$type."_id IS NOT NULL AND l.ads_".$type."_id = ".$row_ads['ads_'.$type.'_id']." AND ads_log_timestamp BETWEEN ".$start_date." AND ".$end_date."
				GROUP BY n.room_id, room_name, ads_".$type."_id, p.tv_channel_name, ads_log_timestamp
				ORDER BY room_name";
				//echo '<p>' . $sql; exit;
			$result = $db->sql_query($sql);
			
			$timestamp_temp = 0;
			$subscriber_name_temp = '';
			$count = 0; $j = 0;
			while ($row = $db->sql_fetchrow($result))
			{
				$timestamp = (int) $row['ads_log_timestamp'];
				$subscriber_name = $row['room_name'];
				
				if($timestamp != $timestamp_temp) { 
					$count++;
				}
				
				if($subscriber_name != $subscriber_name_temp) { 
					$subs[$j] = $subscriber_name;
				}
				
				$timestamp_temp = $timestamp;
				$subscriber_name_temp = $subscriber_name;
				
				$j++;
			}
			
			$data[$i] = array(
				'subscriber_name'	=> $subs[$i],
				'name'			=> $ads_name,
				'count_log'		=> $count,
			);
			$jsonResult .= json_encode($data[$i]);
			$i++;
			
		}
	} else {	
		$sql_ads = "SELECT * FROM ".$table." WHERE ads_".$type."_enabled = 1 ORDER BY ads_".$type."_id";
		$result_ads = $db->sql_query($sql_ads);
		$i = 0;
		$jsonResult = '[ ';
		while($row_ads = $db->sql_fetchrow($result_ads)) {
			$ads_name = $row_ads['ads_'.$type.'_name'];
			
			if($i > 0){
				$jsonResult .= ',';
			}
			
			$sql = "SELECT b.ads_".$type."_name, ads_log_timestamp
				FROM ads_logs l
				LEFT JOIN ".$table." b ON l.ads_".$type."_id = b.ads_".$type."_id
				WHERE ads_log_type = '".$type."' AND l.ads_".$type."_id = ".$row_ads['ads_'.$type.'_id']." AND ads_log_timestamp BETWEEN ".$start_date." AND ".$end_date."
				ORDER BY b.ads_".$type."_name, ads_log_timestamp ASC";
			$result = $db->sql_query($sql);
			
			$timestamp_temp = 0;
			$count = 0;
			while($row = $db->sql_fetchrow($result)) {
				$timestamp = (int) $row['ads_log_timestamp'];
				
				if($timestamp != $timestamp_temp) { 
					$count++;
				}
				
				$timestamp_temp = $row['ads_log_timestamp'];
			}
			
			$data[$i] = array(
				'name'			=> $ads_name,
				'count_log'		=> $count,
			);
			$jsonResult .= json_encode($data[$i]);
			
			$i++;
		}
	}
	$jsonResult .= ' ]';
	
    $db->sql_freeresult($result);
		
	echo $jsonResult;
	
} else if($mod == "uploadexcel") {
	$filename = explode(".", $_GET['filename']);
	$format = $filename[count($filename)-1];

	if($format == "xls") {
		global $db, $config;
		
		/**
		* XLS parsing uses php-excel-reader from http://code.google.com/p/php-excel-reader/
		*/
		header('Content-Type: text/plain');

		if (isset($argv[1]))
		{
			$Filepath = $argv[1];
		}
		elseif (isset($_GET['filename']))
		{
			$Filepath = 'uploads/stb/'.$_GET['filename'];
		}
		else
		{
			if (php_sapi_name() == 'cli')
			{
				echo 'Please specify filename as the first argument'.PHP_EOL;
			}
			else
			{
				echo 'Please specify filename as a HTTP GET parameter "File", e.g., "/test.php?File=test.xlsx"';
			}
			exit;
		}
		
		// Excel reader from http://code.google.com/p/php-excel-reader/
		require('../includes/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
		require('../includes/spreadsheet-reader-master/SpreadsheetReader.php');

		date_default_timezone_set('UTC');

		try
		{
			$Spreadsheet = new SpreadsheetReader($Filepath);
			$BaseMem = memory_get_usage();

			$Sheets = $Spreadsheet -> Sheets();
			 

			foreach ($Sheets as $Index => $Name)
			{
				
				
				$Time = microtime(true);

				$Spreadsheet -> ChangeSheet($Index);
				
				
				
				foreach ($Spreadsheet as $Key => $Row)
				{ 
					//if($Key >= 0) {
						if ($Row)
						{

							 //print_r($Row);//die();
						
							if((string) $Row[0] != ""){
								$mac = (string) $Row[0];
								 $split = substr($mac, 2, 1);
								 
								if($split == ":")
								{
								 $check = 'node_mac';	
								} else {
								 $check = 'node_ip';	
								}
						
									$sql_ary = array(
										$check 			=> (string) $Row[0],
										'stb_id'		=> (string) $Row[0],
										'node_name' 	=> "STB-".(string) $Row[0],
										'node_enabled' 	=> 1,
										'room_id' 		=> 1,
										
									);
							
							
								// print_r($sql_ary );die();
								$sql = 'INSERT INTO ' . NODES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
								//echo $sql; exit;
								// print_r($sql);die();
								$db->sql_query($sql);
							}
							
							// $mid = $db->sql_nextid();
							//echo "Are you Sure ?";die();
						}
						else
						{
							// var_dump($Row);
						}
					//}
				}
			
			}
			
		}
		catch (Exception $E)
		{
			// echo 'ss';
		}
	}
	
}

?>