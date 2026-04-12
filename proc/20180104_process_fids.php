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

//http://weather.navicom.co.id/query.php?key=170533ceb61bdbc877d71dd966333e8f&id=Banda_Aceh
require($tonjaw_root_path . 'config.' . $phpEx);
require($tonjaw_root_path . $config['include_path'] . 'db/' . $dbms . '.' . $phpEx);
require($tonjaw_root_path . $config['include_path'] . 'functions.' . $phpEx);
require($tonjaw_root_path . $config['include_path'] . 'constants.' . $phpEx);

$db	= new $sql_db();

// Connect to DB
$db->sql_connect($dbhost, $dbuser, $dbpasswd, $dbname, $dbport, false, defined('TONJAW_DB_NEW_LINK') ? TONJAW_DB_NEW_LINK : false);

// We do not need this any longer, unset for safety purposes
unset($dbpasswd);

while(true) {

$sql = 'SELECT * FROM ' . AIRPORT_FIDS_UPDATE_TABLE . ' ORDER BY airport_fids_update_timestamp';
$result = $db->sql_query($sql);
$flights = array();
while($row = $db->sql_fetchrow($result)) {
	$id = $row['airport_fids_update_id'];
	
	// Grab flight data from FIDS
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $config['fids_api'].'flight/'.$id.'?format=json');
	curl_setopt($ch, CURLOPT_USERPWD, "info:info");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 2);
	$response = curl_exec($ch); 
	
	if(curl_errno($ch)) {
		//print curl_error($ch);
		return false;
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
		
		$sql_status = "SELECT airport_flight_status_remark FROM " . AIRPORT_FLIGHT_STATUS_TABLE . " WHERE airport_flight_status_remark_code = '".strtoupper($status_code)."'";
		$result_status = $db->sql_query($sql_status);
		$status = $db->sql_fetchfield('airport_flight_status_remark');
		
		$ch1 = curl_init();
		curl_setopt($ch1, CURLOPT_URL, $config['fids_api'].'airline/'.$airline_code_3.'?format=json');
		curl_setopt($ch1, CURLOPT_USERPWD, "info:info");
		curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch1, CURLOPT_NOSIGNAL, 1);
		curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, 1);
		curl_setopt($ch1, CURLOPT_TIMEOUT, 2);
		$response1 = curl_exec($ch1); 

		if(curl_errno($ch1)) {
			//print curl_error($ch1);
			return false;
		} else { //echo $airline_code;
			//$url_request = $config['fids_api'] . 'airline.json';
			//$response1 = file_get_contents($url_request);
			$string1 = json_decode($response1, true);
			
			$airline_name = $string1['name'];
		}
		
		/*$ch2 = curl_init();
		curl_setopt($ch2, CURLOPT_URL, $config['fids_api'].'airport/'.$airport);
		curl_setopt($ch2, CURLOPT_USERPWD, "info:info");
		curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch2, CURLOPT_NOSIGNAL, 1);
		curl_setopt($ch2, CURLOPT_CONNECTTIMEOUT, 1);
		curl_setopt($ch2, CURLOPT_TIMEOUT, 2);
		$response2 = curl_exec($ch2); 

		if(curl_errno($ch2)) {
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
		
		$sql_check = "SELECT COUNT(*) AS total_data FROM " . AIRPORT_FIDS_TABLE . " WHERE airport_fids_update_id = '".$id."'";
		$result_check = $db->sql_query($sql_check);
		$total_data = $db->sql_fetchfield('total_data');
		
		if($row['airport_fids_update_opr'] == 'delete') {
			$sql_delete = "DELETE FROM " . AIRPORT_FIDS_TABLE . " WHERE airport_fids_update_id = " . $id;
			$db->sql_query($sql_delete);

			$sql_delete1 = "DELETE FROM " . AIRPORT_FIDS_UPDATE_TABLE . " WHERE airport_fids_update_id = " . $id;
                        $db->sql_query($sql_delete1);
		} else if($row['airport_fids_update_opr'] == 'update' || $row['airport_fids_update_opr'] == 'chg') {
			
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
					
				);
				
				$sql_insert = 'INSERT INTO ' . AIRPORT_FIDS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
		
				//echo $sql_insert; //exit;
				$db->sql_query($sql_insert);
				
				$sql_delete = "DELETE FROM " . AIRPORT_FIDS_UPDATE_TABLE . " WHERE airport_fids_update_id = " . $id;
				$db->sql_query($sql_delete);
				
			} else {
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
					
				);
				
				$sql_update = 'UPDATE ' . AIRPORT_FIDS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE airport_fids_update_id = '.$id;
		
				//echo $sql_update; 
				$db->sql_query($sql_update);
				
				$sql_delete = "DELETE FROM " . AIRPORT_FIDS_UPDATE_TABLE . " WHERE airport_fids_update_id = " . $id;
				$db->sql_query($sql_delete);
				
			} 
			
		}	
		
		
	}

	//usleep(10);
}





//print_r($flights); //exit;

// Send notification if flight status/remark has changed
foreach($flights as $flight_id) {
	$sql = "SELECT airport_flight_status_remark_code, fids_remark, fids_time FROM " . AIRPORT_FIDS_TABLE . " f LEFT JOIN " . AIRPORT_FLIGHT_STATUS_TABLE . " s ON upper(f.fids_remark) = upper(s.airport_flight_status_remark) WHERE fids_flight = '".$flight_id."'";
	
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	
	// Send notification to STB
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $config['API_server']."fis.php?mode=flight_remark&code=".$config['fids_airport_code_default']."&flight=".$flight_id."&remark=".$row['airport_flight_status_remark_code']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_TIMEOUT, 20);
	$response = curl_exec($ch); 

	if(curl_errno($ch)) {
		//print curl_error($ch);
		return false;
	} else { 
		//echo $response;
	}
	
	
	// Send notification to APPS
	$title = $flight_id.' - '.$row['fids_remark'];
	$body = $flight_id.' - '.$row['fids_remark'].' - '.$row['fids_time'];
	
	$apps = array("android", "ios");
	
	foreach($apps as $app) {
		$data_array = array(
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
				'to'	=> '/topics/'.$app.$flight_id
			);
		
		header('Content-type: application/json');
		$json_data = json_encode($data_array);

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://fcm.googleapis.com/fcm/send",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => $json_data,
		  CURLOPT_HTTPHEADER => array(
			"authorization: key=".$config['firebase_key'],
			"cache-control: no-cache",
			"content-type: application/json",
			"postman-token: bb431e65-1214-36fd-bc56-da4c05dc8a36"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  //echo $response;
		}
	
	}
	
}

unset($data);
unset($xml);

$db->sql_freeresult($result);

usleep(10000);
}
?>
