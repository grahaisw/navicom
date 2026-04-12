<?php
/**
*
* proc/process_fids.php
*
* Roberto Tonjaw. Oct 2014
*/

/**
*/
define('IN_TONJAW', true);

$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './../';
$phpEx = substr(strrchr($_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr($_SERVER['PHP_SELF'], '/'), 1));

require($tonjaw_root_path . 'config.' . $phpEx);
require($tonjaw_root_path . $config['include_path'] . 'db/' . $dbms . '.' . $phpEx);
require($tonjaw_root_path . $config['include_path'] . 'functions.' . $phpEx);
require($tonjaw_root_path . $config['include_path'] . 'constants.' . $phpEx);

$db	= new $sql_db();

//echo 'crottt\n'; exit;
// Connect to DB
$db->sql_connect($dbhost, $dbuser, $dbpasswd, $dbname, $dbport, false, defined('TONJAW_DB_NEW_LINK') ? TONJAW_DB_NEW_LINK : false);

// We do not need this any longer, unset for safety purposes
unset($dbpasswd);

error_reporting(E_ALL); ini_set('display_errors', 1);

$i = 0;
while(true) {
	if($i == 0) {
		$logfile = "proc_tes.log";
		$fh = fopen($logfile, 'a+') or die("can't open file");
	}
	
	if($i < 2) {
		$stringData = "########## ".date("Y-m-d H:i:s")." ########## \r\n";
		fwrite($fh, $stringData);
		
	}
	
	$sql = 'SELECT * FROM ' . AIRPORT_FIDS_UPDATE_TABLE . ' ORDER BY airport_fids_update_timestamp';
	$result = $db->sql_query($sql);
	$flights = array();
	while($row = $db->sql_fetchrow($result)) {
		$id = $row['airport_fids_update_id'];

		if(empty($id)) {
			$id = 0;
		}
		
		// Grab flight data from FIDS
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $config['fids_api'].'flight/'.$id.'?format=json');
		curl_setopt($ch, CURLOPT_USERPWD, "info:info");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
		curl_setopt($ch, CURLOPT_TIMEOUT, 90);
		$response = curl_exec($ch); 
		
		if($i < 2) {
			$stringData = 'Access cURL : '.$config['fids_api'].'flight/'.$id."?format=json  \r\n";
			fwrite($fh, $stringData);
		}
		
		if(curl_errno($ch)) {
			//echo curl_error($ch);
			if($i < 2) {
				$stringData = 'cURL Error : '.curl_error($ch)." \r\n";
				fwrite($fh, $stringData);
			}
			//return false;
		} else { 
			//$url_request = $config['fids_api'] . 'flight.json';
			//$response = file_get_contents($url_request);
			$string = json_decode($response, true); 
			//print_r($string);exit;
			$fids_type = $string['direction'];
			if($fids_type == "A") {
				$fids_type = 0;
			} else if($fids_type == "D") {
				$fids_type = 1;
			} 
			
			$callsign2 = $string['callsign2'];
			$fids_flight = str_replace("-", "", $callsign2);
			$airline_code_3 = $string['airline'];
			$sign = explode("-", $callsign2);
			$airline_code = $sign[0];
					
			$airport = $string['airport'];
			$status_code = $string['status'];
			$gate = $string['gate'];
			$terminal = $string['terminal'];
			$fids_city = $string['airport_name'];
			
			$new_time = $string['new_time'];
			$dates = new DateTime($new_time, new DateTimeZone('Asia/Makassar'));
			$dates->setTimezone(new DateTimeZone('Asia/Makassar'));
			$fids_time = $dates->format('H:i');
			$fids_timestamp = mktime($dates->format('H'), $dates->format('i'), $dates->format('s'), $dates->format('m'), $dates->format('d'), $dates->format('Y'));
			$jy = date('y',$fids_timestamp);
			$jt = date('z',$fids_timestamp)+1;
			$jd = str_pad($jt, 3, "0", STR_PAD_LEFT);

			$sql_status = "SELECT airport_flight_status_remark FROM " . AIRPORT_FLIGHT_STATUS_TABLE . " WHERE airport_flight_status_remark_code = '".strtoupper($status_code)."'";
			$result_status = $db->sql_query($sql_status);
			$status = $db->sql_fetchfield('airport_flight_status_remark');
			
			$sql_check_airline = "SELECT COUNT(*) AS total_airline FROM " . AIRPORT_FIDS_TABLE . " WHERE fids_airline_code_3 = '".$airline_code_3."'";
			$result_check_airline = $db->sql_query($sql_check_airline);
			$total_airline = $db->sql_fetchfield('total_airline');
			
			if($total_airline == 0) { 
				$ch1 = curl_init();
				curl_setopt($ch1, CURLOPT_URL, $config['fids_api'].'airline/'.$airline_code_3.'?format=json');
				curl_setopt($ch1, CURLOPT_USERPWD, "info:info");
				curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch1, CURLOPT_NOSIGNAL, 1);
				curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, 60);
				curl_setopt($ch1, CURLOPT_TIMEOUT, 90);
				$response1 = curl_exec($ch1); 
				
		//echo 'croott\n'; exit;
				if($i < 2) {
					$stringData = 'Access curl : '.$config['fids_api'].'airline/'.$airline_code_3."?format=json \r\n";
					fwrite($fh, $stringData);
				}

				if(curl_errno($ch1)) {
					if($i < 2) {
						$stringData = 'cURL Error : '.curl_error($ch1)." \r\n";
						fwrite($fh, $stringData);
					}
					//return false;
				} else { //echo $airline_code;
					//$url_request = $config['fids_api'] . 'airline.json';
					//$response1 = file_get_contents($url_request);
					$string1 = json_decode($response1, true);
					
					$airline_name = $string1['name'];
				}
			} else {
				$sql_airline = "SELECT fids_airline FROM " . AIRPORT_FIDS_TABLE . " WHERE fids_airline_code_3 = '".$airline_code_3."'";
				$result_airline = $db->sql_query($sql_airline);
				$airline_name = $db->sql_fetchfield('fids_airline');
			}
			
			/*$ch2 = curl_init();
			curl_setopt($ch2, CURLOPT_URL, $config['fids_api'].'airport/'.$airport);
			curl_setopt($ch2, CURLOPT_USERPWD, "info:info");
			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch2, CURLOPT_NOSIGNAL, 1);
			curl_setopt($ch2, CURLOPT_CONNECTTIMEOUT, 1);
			curl_setopt($ch2, CURLOPT_TIMEOUT, 2);
			$response2 = curl_exec($ch2); 

			if(curl_errno($ch7)) {
				//print curl_error($ch2);
				return false;
			} else {
				//$url_request = $config['fids_api'] . 'airport.json';
				//$response2 = file_get_contents($url_request);
				$string2 = json_decode($response2, true);
				
				$fids_city = $string2['location'];
			}*/
			
			$sql_airport = "SELECT airport_id FROM " . AIRPORTS_TABLE . " WHERE airport_code = '".$config['fids_airport_code_default']."'";
			$result_airport = $db->sql_query($sql_airport);
			$airport_id = $db->sql_fetchfield('airport_id');
			
			$flights[] = $fids_flight;

			/** Add All Flight Data to Log Table **/
			$sql_log = "SELECT airport_fids_update_timestamp FROM " . AIRPORT_FIDS_LOG_TABLE . " WHERE airport_fids_update_id = ".$id." ORDER BY airport_fids_update_timestamp DESC LIMIT 1";
			$result_log = $db->sql_query($sql_log);
			$last_timestamp_log = $db->sql_fetchfield('airport_fids_update_timestamp');
			
			$flight_data_log = $fids_flight."|".$fids_city."|".$fids_time."|".strtoupper($status_code)."|".$fids_timestamp;
			
			$sql_ary_log = array(
				'airport_fids_data'		=> $flight_data_log,
			);
			
			$sql_update_log = 'UPDATE ' . AIRPORT_FIDS_LOG_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary_log) . ' WHERE airport_fids_update_id = '.$id.' AND airport_fids_update_timestamp = '.$last_timestamp_log.' AND airport_fids_data IS NULL';
			$db->sql_query($sql_update_log);
			
			/** End **/
		
			$sql_check = "SELECT COUNT(*) AS total_data FROM " . AIRPORT_FIDS_TABLE . " WHERE airport_fids_update_id = ". $id;
			$result_check = $db->sql_query($sql_check);
			$total_data = $db->sql_fetchfield('total_data');
			
			if($row['airport_fids_update_opr'] == 'delete') {
				$sql_delete = "DELETE FROM " . AIRPORT_FIDS_TABLE . " WHERE airport_fids_update_id = " . $id;
				$db->sql_query($sql_delete);

				$sql_delete1 = "DELETE FROM " . AIRPORT_FIDS_UPDATE_TABLE . " WHERE airport_fids_update_id = " . $id;
				$db->sql_query($sql_delete1);
			} else if($row['airport_fids_update_opr'] == 'update' || $row['airport_fids_update_opr'] == 'chg') {
				
				$micro_time = microtime(true);
				//$micro_time = str_replace(".", "", $micro_time);
				
				if($total_data == 0) {
				//if($row['airport_fids_update_opr'] == 'insert') {
					$sql_ary = array(
						'fids_flight' 		=> (string) $fids_flight,
						'airport_id'		=> (int) $airport_id,
						'fids_airline_code'	=> (string) $airline_code,
						'fids_airline' 		=> (string) $airline_name,
						'fids_city' 		=> (string) $fids_city,
						'fids_time' 		=> (string) $fids_time,
						'fids_terminal' 	=> (string) $terminal,
						'fids_gate' 		=> (string) $gate,
						'fids_remark'		=> $status,
						'fids_type' 		=> (int) $fids_type,
						'fids_lastupdate'	=> (int) time(),
						'airport_fids_update_id'	=> (int) $id,
						'fids_timestamp' 		=> (int) $fids_timestamp,
						'fids_airline_code_3'	=> (string) $airline_code_3,
						'fids_lastupdate_microtime'	=> $micro_time,
						'fids_jdate'	=> (string) $jd,
					);
					if($fids_flight != ''){
					$sql_insert = 'INSERT INTO ' . AIRPORT_FIDS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
					$db->sql_query($sql_insert);
					
					if($i < 2) {
						$stringData = 'Insert Query : '.$sql_insert .' \r\n';
						fwrite($fh, $stringData);
					}
					
					$sql_delete = "DELETE FROM " . AIRPORT_FIDS_UPDATE_TABLE . " WHERE airport_fids_update_id = " . $id;
					$db->sql_query($sql_delete);
					}
				} else {
					if($row['airport_fids_update_opr'] == 'chg') {
						$sql_gate = "SELECT fids_gate FROM " . AIRPORT_FIDS_TABLE . " WHERE airport_fids_update_id = '".$id."'";
						$result_gate = $db->sql_query($sql_gate);
						$current_gate = $db->sql_fetchfield('fids_gate');
						
						$sql_update_gate = "UPDATE " . AIRPORT_FIDS_TABLE . " SET fids_gate_old = '".$current_gate."' WHERE airport_fids_update_id = '".$id."'";
						$db->sql_query($sql_update_gate);
						
						if($i < 2) {
							$stringData = 'Update Query : '.$sql_update_gate." \r\n";
							fwrite($fh, $stringData);
						}
					}
					
					$sql_ary = array(
						'fids_flight' 		=> (string) $fids_flight,
						'airport_id'		=> (int) $airport_id,
						'fids_airline_code'	=> (string) $airline_code,
						'fids_airline' 		=> (string) $airline_name,
						'fids_city' 		=> (string) $fids_city,
						'fids_time' 		=> (string) $fids_time,
						'fids_terminal' 	=> (string) $terminal,
						'fids_gate' 		=> (string) $gate,
						'fids_remark'		=> $status,
						'fids_type' 		=> (int) $fids_type,
						'fids_lastupdate'	=> (int) time(),
						'fids_timestamp' 	=> (int) $fids_timestamp,
						'fids_airline_code_3'	=> (string) $airline_code_3,
						'fids_lastupdate_microtime'	=> $micro_time,
						'fids_jdate'	=> (string) $jd,
					);
					
					$sql_update = 'UPDATE ' . AIRPORT_FIDS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE airport_fids_update_id = '.$id;
					$db->sql_query($sql_update);
					
					if($i < 2) {
						$stringData = 'Update Query : '.$sql_update." \r\n";
						fwrite($fh, $stringData);
					}
					
					$sql_delete = "DELETE FROM " . AIRPORT_FIDS_UPDATE_TABLE . " WHERE airport_fids_update_id = " . $id;
					$db->sql_query($sql_delete);
					
				}
				
				// Send notification if flight status/remark has changed
				// Send notification to STB
				$ch2 = curl_init();
				curl_setopt($ch2, CURLOPT_URL, $config['API_server']."fis.php?mode=flight_remark&code=".$config['fids_airport_code_default']."&flight=".$fids_flight."&remark=".strtoupper($status_code)."&jd=".$jd);
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch2, CURLOPT_NOSIGNAL, 1);
				curl_setopt($ch2, CURLOPT_CONNECTTIMEOUT, 60);
				curl_setopt($ch2, CURLOPT_TIMEOUT, 90);
				$response = curl_exec($ch2); 
				
				if($i < 2) {
					$stringData = 'Access curl : '.$config['API_server']."fis.php?mode=flight_remark&code=".$config['fids_airport_code_default']."&flight=".$fids_flight."&remark=".strtoupper($status_code)." \r\n";
					fwrite($fh, $stringData);
				}
				
				if(curl_errno($ch2)) {
					if($i < 2) {
						$stringData = 'cURL Error : '.curl_error($ch2)." \r\n";
						fwrite($fh, $stringData);
					}
					//return false;
				} else { 
					//echo $response;
				}
				
				// Send notification to APPS
				$title = $fids_flight.' - '.$status;
				$body = $fids_flight.' - '.$status.' - '.$fids_time;
				
				$apps = array("android", "ios");
				
				foreach($apps as $app) {
				if($app == 'android'){
					$data_array = array(
							'data'	=> array(
								'c_message' => $body,
								'c_info' => 'delete_data00',
								'c_click_action'	=> 'STATUS_UPDATE',
								'c_title' => $title,	
							),
							'to'	=> '/topics/'.$app.$fids_flight.$jd,
							'priority' => 'high'
						);
				}else if($app == 'ios'){
					$data_array = array(
							'notification'	=> array(
								'title'	=> $title,
								'body'	=> $body,
								'badge'	=> "0",
								'sound'	=> 'default'
								
							),
							'data'	=> array(
								'c_message' => $body,
								'c_info' => 'delete_data00',
								'c_click_action'	=> 'STATUS_UPDATE',
								'c_title' => $title,	
							),
							'to'	=> '/topics/'.$app.$fids_flight.$jd
						);
				}
			
				/*	$data_array = array(
							'notification'	=> array(
								'title'	=> $title,
								'body'	=> $body,
								'badge'	=> "0",
								'sound'	=> 'default',
								'icon'	=> 'navicom_airport_icon_notification'	
							),
							'data'	=> array(
								'c_message' => $body,
								'c_info' => 'delete_data00',
								'click_action'	=> 'STATUS_UPDATE',
								'c_title' => $title,	
							),
							'to'	=> '/topics/'.$app.$fids_flight
						);*/
				
					
					header('Content-type: application/json');
					$json_data = json_encode($data_array);

					$curl = curl_init();

					curl_setopt_array($curl, array(
					  CURLOPT_URL => "http://fcm.googleapis.com/fcm/send",
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => "",
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 60,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => "POST",
					  CURLOPT_POSTFIELDS => $json_data,
					  CURLOPT_HTTPHEADER => array(
						"authorization: key=".$config['firebase_key'],
						"cache-control: no-cache",
						"content-type: application/json"
					//	"postman-token: bb431e65-1214-36fd-bc56-da4c05dc8a36"
					  ),
					));

					$response = curl_exec($curl);
					
					if($i < 2) {
						$stringData = "Access curl : http://fcm.googleapis.com/fcm/send \r\n";
						fwrite($fh, $stringData);
					}
					
					$err = curl_error($curl);

					curl_close($curl);

					if ($err) {
						if($i < 2) {
							$stringData = 'cURL Error : '.$err." \r\n";
							fwrite($fh, $stringData);
						}
					} else {
					  //echo $response;
					}
				
				}				
				
			}				
			
		}		
		
	}

	$db->sql_freeresult($result);
	
	if($i == 1) {
		if(file_exists($logfile)) {
			//unlink($logfile);
			//exit;
			ftruncate($fh, 0);
			fclose($fh);
			$i = 0;
		}
	} else {
		//fclose($fh);
		$i++;
	}
	
	usleep(10000);
	
}
?>
