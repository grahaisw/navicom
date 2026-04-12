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
	
	// $sql = 'SELECT * FROM ' . AIRPORT_FIDS_UPDATE_TABLE . ' ORDER BY airport_fids_update_timestamp';
	// $result = $db->sql_query($sql);
	// $flights = array();
	// while($row = $db->sql_fetchrow($result)) {
	// 	$id = $row['airport_fids_update_id'];

		// if(empty($id)) {
		// 	$id = 0;
		// }
		
		// Grab flight data from FIDS
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $config['fids_api'].'flight.json');
		curl_setopt($ch, CURLOPT_USERPWD, "navicom:N@v1C0m");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		$response = curl_exec($ch); 
		
		 if($i < 2) {
		 	$stringData = 'Access cURL : '.$config['fids_api'].'flight.json';
		 	fwrite($fh, $stringData);
		 }
		
		if(curl_errno($ch)) {
			echo curl_error($ch);
			if($i < 2) {
				$stringData = 'cURL Error : '.curl_error($ch)." \r\n";
				fwrite($fh, $stringData);
			}
			//return false;
		} else { 
			$url_request = $config['fids_api'] . 'flight.json';
			$response = file_get_contents($url_request);
			$string = json_decode($response, true);
//			$member2 = array(); 
//			print_r($string['Content']);exit;		      
// if($i==0){	print_r($string);exit;}
//			echo 'name: ' . $string['Flight']['Contents']['Content'][0]['name']. '<br>';exit;
			//echo $string['_Count'];//exit;
			//echo "name 193: ".$string[190]['name']; exit;
			$aa=0;
			foreach($string as $rows)
			{
				echo "\n $aa \n"; $aa++;
				//print_r($rows); exit;
				if(is_array($rows)){
				foreach($rows as $row2){
				$nopen =  $row2['nopen'];
				$name =  $row2['name'];
				$schedule =  $row2['schedule'];
				$estimate =  $row2['estimate'];
				$actual =  $row2['actual'];
				$terminal =  $row2['terminal'];
				$gate =  $row2['gate'];
				$eng =  $row2['eng'];
				$opr =  $row2['opr'];
				$city =  $row2['city'];
				$update =  $row2['update'];
				$type =  $row2['type'];
				$block_time =  $row2['block_time'];
				$desk_open =  $row2['desk_open'];
				$desk_close =  $row2['desk_close'];
				$new_schedule =  $row2['new_schedule'];
				$update_pax =  $row2['update_pax'];
				$update_gate =  $row2['update_gate'];
				$update_bay =  $row2['update_bay'];
				$update_est =  $row2['update_est'];
				
				
								
			//	}


			//	}
		//	}					
			   
			
//			exit;

						
			$fids_type = $type;
			if($fids_type == "WAAA") {
				$fids_type = 0;
			} else {
				$fids_type = 1;
			} 
			
			$callsign2 = $nopen;
			$fids_flight = str_replace("-", "", $callsign2);
			$airline_code_3 = $nopen;
			$sign = explode("-", $callsign2);
			$airline_code = $sign[0];
			$airline_name = $name;
					
			$airport = 1;
			$status_code = $update;
			$gate = $gate;
			$terminal = $terminal;
			$fids_city = $city;
			
			$new_time = $actual;
//			echo $new_time;exit();
			$dates = new DateTime($new_time, new DateTimeZone('Asia/Makassar'));
			$dates->setTimezone(new DateTimeZone('Asia/Makassar'));
			$fids_time = $dates->format('H:i');
			$fids_timestamp = mktime($dates->format('H'), $dates->format('i'), $dates->format('s'), $dates->format('m'), $dates->format('d'), $dates->format('Y'));

			$jy = date('y',$fids_timestamp);
			$jd = date('z',$fids_timestamp)+1;
			$jd = str_pad($jd, 3, "0", STR_PAD_LEFT);
			$status = $eng;
			
			// $sql_status = "SELECT airport_flight_status_remark FROM " . AIRPORT_FLIGHT_STATUS_TABLE . " WHERE airport_flight_status_remark_code = '".strtoupper($status_code)."'";
			// $result_status = $db->sql_query($sql_status);
			// $status = $db->sql_fetchfield('airport_flight_status_remark');
			
			// $ch1 = curl_init();
			// curl_setopt($ch1, CURLOPT_URL, $config['fids_api'].'airline/'.$airline_code_3.'?format=json');
			// curl_setopt($ch1, CURLOPT_USERPWD, "info:info");
			// curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
			// curl_setopt($ch1, CURLOPT_NOSIGNAL, 1);
			// curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, 10);
			// curl_setopt($ch1, CURLOPT_TIMEOUT, 10);
			// $response1 = curl_exec($ch1); 
			
	//echo 'croott\n'; exit;
			// if($i < 2) {
			// 	$stringData = 'Access curl : '.$config['fids_api'].'airline/'.$airline_code_3."?format=json \r\n";
			// 	fwrite($fh, $stringData);
			// }

			// if(curl_errno($ch1)) {
			// 	if($i < 2) {
			// 		$stringData = 'cURL Error : '.curl_error($ch1)." \r\n";
			// 		fwrite($fh, $stringData);
			// 	}
				//return false;
			// } else { 
			//echo $airline_code;
				//$url_request = $config['fids_api'] . 'airline.json';
				//$response1 = file_get_contents($url_request);
				// $string1 = json_decode($response1, true);
				
				// $airline_name = $string1['name'];
			// }
			
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
			
			// $sql_chek = "SELECT fids_airline_code_3 FROM " . AIRPORT_FIDS_TABLE . " WHERE fids_airline_code_3 = '".$nopen."'";
			// $result_airport = $db->sql_query($sql_chek);
			// $airport_id2 = $db->sql_fetchfield('fids_airline_code_3');
			// // $airport_id = 1;
			/*
			$flights[] = $fids_flight;
			*/

			$sql_check = "SELECT COUNT(*) AS total_data FROM " . AIRPORT_FIDS_TABLE . " WHERE fids_airline_code_3 = '".$nopen."'";
			//echo $sql_check;exit;	
			$result_check = $db->sql_query($sql_check);
			$total_data = $db->sql_fetchfield('total_data');
			$db->sql_freeresult($result_check);
			// echo $total_data;exit;
						// if($row['airport_fids_update_opr'] == 'delete') {
			// 	$sql_delete = "DELETE FROM " . AIRPORT_FIDS_TABLE . " WHERE airport_fids_update_id = " . $id;
			// 	$db->sql_query($sql_delete);

			// 	$sql_delete1 = "DELETE FROM " . AIRPORT_FIDS_UPDATE_TABLE . " WHERE airport_fids_update_id = " . $id;
			// 	$db->sql_query($sql_delete1);
			// } else if($row['airport_fids_update_opr'] == 'update' || $row['airport_fids_update_opr'] == 'chg') {
				
					/* TESTING TONJAW */
					if($fids_flight == 'GA605')
					{
						echo "FOUND \n";
						$sql_temp = "SELECT fids_flight AS temp_flight FROM airport_fids_temp WHERE fids_flight='GA605' AND fids_remark='$status'";
						$result_temp = $db->sql_query($sql_temp);
 			                	$temp_flight = $db->sql_fetchfield('temp_flight');
						$db->sql_freeresult($result_temp);

						if (empty($temp_flight))
						{

							$sql_temp_arr = array(
								'fids_flight'           => (string) $fids_flight,
                                                		'fids_city'          	=> (string) $fids_city,
                                                		'fids_time'             => (string) $fids_time,
                                                		'fids_gate'             => (string) $gate,
                                                		'fids_remark'           => $status,
                                                		'fids_schedule'       	=> (string) $row2['schedule'],
                                                		'fids_estimate'        	=> (string) $row2['estimate'],
                                                		'fids_actual'    	=> (string) $row2['actual'],
                                                		'fids_update'    	=> (string) $row2['update'],
								'fids_blocktime'	=> (string) $row2['block_time'],
								'fids_new_schedule'	=> (string) $row2['new_schedule'],
								'fids_update_pax'       => (string) $row2['update_pax'],
								'fids_update_bay'       => (string) $row2['update_bay'],
								'fids_update_est'       => (string) $row2['update_est'],
							);
							$sql_temp_insert = "INSERT INTO airport_fids_temp " . $db->sql_build_array('INSERT', $sql_temp_arr);
							$db->sql_query($sql_temp_insert);

						}

					}else{
					}
					/* END TONJAW */	

				$micro_time = microtime(true);
				$micro_time = str_replace(".", "", $micro_time);
				
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
						'fids_jdate'	=> $jd,
					);

					// if($fids_flight != ''){
						$sql_insert = 'INSERT INTO ' . AIRPORT_FIDS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
						$db->sql_query($sql_insert);
					// -
					/**/
					// 	if($i < 2) {
					// 		$stringData = 'Insert Query : '.$sql_insert .' \r\n';
					// 		fwrite($fh, $stringData);
					// 	}
						
					// 	$sql_delete = "DELETE FROM " . AIRPORT_FIDS_UPDATE_TABLE . " WHERE airport_fids_update_id = " . $id;
					// 	$db->sql_query($sql_delete);

					// }
					
				} else {
				// 	if($row['airport_fids_update_opr'] == 'chg') {
				// 		$sql_gate = "SELECT fids_gate FROM " . AIRPORT_FIDS_TABLE . " WHERE airport_fids_update_id = '".$id."'";
				// 		$result_gate = $db->sql_query($sql_gate);
				// 		$current_gate = $db->sql_fetchfield('fids_gate');
						
				// 		$sql_update_gate = "UPDATE " . AIRPORT_FIDS_TABLE . " SET fids_gate_old = '".$current_gate."' WHERE airport_fids_update_id = '".$id."'";
				// 		$db->sql_query($sql_update_gate);
						
				// 		if($i < 2) {
				// 			$stringData = 'Update Query : '.$sql_update_gate." \r\n";
				// 			fwrite($fh, $stringData);
				// 		}
				// 	}
					
				 	$sql_ary = array(
				 		'fids_flight' 		=> (string) $fids_flight,
				 		// 'airport_id'		=> (int) $airport_id,
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
				 		// 'fids_jdate'	=> $jd,
					);
					
			$sql_update = " UPDATE "  . AIRPORT_FIDS_TABLE . " SET " . $db->sql_build_array('UPDATE', $sql_ary) . " WHERE fids_airline_code_3 = '".$nopen."'";
					$db->sql_query($sql_update);
					
				// 	if($i < 2) {
				// 		$stringData = 'Update Query : '.$sql_update." \r\n";
				// 		fwrite($fh, $stringData);
				// 	}
					
				// 	$sql_delete = "DELETE FROM " . AIRPORT_FIDS_UPDATE_TABLE . " WHERE airport_fids_update_id = " . $id;
				// 	$db->sql_query($sql_delete);
					
				 }
				
				// Send notification if flight status/remark has changed
				// Send notification to STB
			/*	$ch2 = curl_init();
				curl_setopt($ch2, CURLOPT_URL, $config['API_server']."fis.php?mode=flight_remark&code=".$config['fids_airport_code_default']."&flight=".$fids_flight."&remark=".strtoupper($status_code)."&jd=".$jd);
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch2, CURLOPT_NOSIGNAL, 1);
				curl_setopt($ch2, CURLOPT_CONNECTTIMEOUT, 10);
				curl_setopt($ch2, CURLOPT_TIMEOUT, 20);
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
			*/	
				// Send notification to APPS
				$title = $fids_flight.' - '.$status;
				$body = $fids_flight.' - '.$status.' - '.$fids_time;
				
				$apps = array("android", "ios");
				
				foreach($apps as $app) {
					if($app == 'android'){
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
							'to'	=> '/topics/'.$app.$fids_flight.$jd
						);
				}else if($app == 'ios'){
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
							'to'	=> '/topics/'.$app.$fids_flight.$jd
						);
				}
					
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
				
			//	}				
				
			}

			
			 }
			}				
		}	
		// }		
		
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
	
	usleep(60000);
	
}
?>
