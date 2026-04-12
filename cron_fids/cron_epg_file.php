<?php

/*
* cron_epg_file.php
*/

include('config.php');

require('includes/db/postgres.php');
require('includes/functions.php');

$db	= new dbal_postgres();
// Connect to DB
$db->sql_connect($dbhost, $dbuser, $dbpasswd, $dbname, $dbport, false, false);

// We do not need this any longer, unset for safety purposes
unset($dbpasswd);

$start_date = date("Y-m-d");
$end_date = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")+$config['epg_cron_period'], date("Y")));

$start_mktime = time();
$end_mktime = mktime(23, 59, 59, date("m"), date("d")+$config['epg_cron_period'], date("Y"));

//Remove data before today
//$sql_delete = "DELETE FROM epg_temp WHERE start_time < '".$start_date."'";
//$db->sql_query($sql_delete);

$sql_package = "SELECT tv_package_id FROM tv_packages WHERE tv_package_enabled = 1 ORDER BY tv_package_id";
$result_package = $db->sql_query($sql_package);
while($row_package = $db->sql_fetchrow($result_package)) {

	$sql_channel = "SELECT c.tv_channel_id, tv_channel_order, tv_channel_name 
		FROM tv_channels c 
		INNER JOIN tv_package_detail pd ON c.tv_channel_id = pd.tv_channel_id 
		WHERE tv_channel_enabled = 1 AND pd.tv_package_id = ".$row_package['tv_package_id']." 
		ORDER BY tv_channel_order";
	//echo $sql_channel; exit;
	$result_channel = $db->sql_query($sql_channel);

	$data = array();

	while($row_channel = $db->sql_fetchrow($result_channel)) {
		$sql_count = "SELECT COUNT(*) AS total_count
			FROM tv_channels c
			LEFT JOIN epg e ON c.tv_channel_id = e.tv_channel_id
			LEFT JOIN tv_bumper b ON c.tv_bumper_id = b.tv_bumper_id 
			WHERE c.tv_channel_id = ".$row_channel['tv_channel_id']." AND to_char(to_timestamp(epg_start_time), 'YYYY-MM-DD') >= '".$start_date."' AND to_char(to_timestamp(epg_start_time), 'YYYY-MM-DD') < '".$end_date."'";
		//echo $sql_count; exit;
		$result_count = $db->sql_query($sql_count);
		$total_count = $db->sql_fetchfield('total_count');
		
		if($total_count > 0) {
			$sql = "SELECT c.tv_channel_id, c.tv_channel_name, c.tv_channel_thumbnail, c.tv_channel_url_udp, c.tv_channel_url_http,	c.tv_channel_allow_ads, c.tv_channel_order, c.tv_channel_locked, b.tv_bumper_type, b.tv_bumper_content, e.epg_start_time, e.epg_end_time, e.epg_computed_duration, e.epg_program_title, e.epg_program_description, to_char(to_timestamp(e.epg_start_time), 'YYYY-MM-DD') AS start_time, to_char(to_timestamp(epg_start_time), 'YYYY-MM-DD HH24:MI')	
				FROM tv_channels c
				LEFT JOIN epg e ON c.tv_channel_id = e.tv_channel_id
				LEFT JOIN tv_bumper b ON c.tv_bumper_id = b.tv_bumper_id 
				WHERE c.tv_channel_id = ".$row_channel['tv_channel_id']." AND to_char(to_timestamp(epg_start_time), 'YYYY-MM-DD') >= '".$start_date."' AND to_char(to_timestamp(epg_start_time), 'YYYY-MM-DD') < '".$end_date."' 
				ORDER BY c.tv_channel_order, c.tv_channel_id, epg_start_time";
			//echo $sql; exit;
			$result = $db->sql_query($sql);

			
			$epg = array();
			$order_temp = '';
			$content = '';
			$datetime = array((string) $start_mktime, (string) $end_mktime);
			$dtime = implode(",", $datetime);
			$i = 0;
			while($row = $db->sql_fetchrow($result)) {
				$order = $row['tv_channel_order'];
				$name = $row['tv_channel_name'];
				$start = $row['epg_start_time'];	
				$title = $row['epg_program_title'];	
				$description = $row['epg_program_description'];	
				
				if(empty($description)) {
					$desc = "";
				}
				
				$epg[$start] = array(
						$row['epg_program_title'], 
						$desc
					
				);
				
				$object = new ArrayObject($epg);
				$data[$order] = array($name, $object);
				
				if($order != $order_temp) { 
					$order_temp = $order;
						
					unset($epg);
					
				}
				
				$i++;
				
			}
		} else { //jika ga ada data EPG
			$obj = new ArrayObject();
			$order = $row_channel['tv_channel_order'];
			$name = $row_channel['tv_channel_name'];
			$start = 0;
			$title = "No Data";
			$description = "";
			
			$data[$order] = array($name, $obj);
		}
	}
	//print_r($data); exit;
	$output = json_encode($data);

	$my_file = '../navicom_oxygen/proc/epg_unix_'.$row_package['tv_package_id'].'.json';
	$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
	$data = 'This is the data';
	fwrite($handle, $output);

}

echo $output;
?>