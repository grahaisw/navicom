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

$airport_base = "UPG";

$flight_pool = array("GA659","GA609","GA660", "GA651","GA605","GA608", "GA630","GA643","GA678","GA655","GA621",
"QG306","QG251","QG778","QG307","QG332","QG349",
"ID6182","ID7708","ID6284","ID6230","ID6285","ID6231","ID6183",
"IW1300","IW1314","IW1869","IW1326","IW1204","IW1220","IW1308",
"JT992","JT786","JT778","JT104","JT852","JT793","JT662","JT841","JT641","JT883","JT797","JT994","JT707","JT676","JT745","JT892","JT787","JT777","JT740","JT780","JT523","JT721",
"SJ175","SJ571","SJ594","SJ583","SJ727","SJ589","SJ567","SJ713","SJ715",
"8B623","8B625","8B691",
"AK333");

$flight_strange = array("QG349", "ID6183", "JT740", "JT780", "ID7708");




$i = 0;
while(true) {
		
	$hari_ini = date("Y-m-d 00:00:00"); // ADD BY TONJAW

    $url_request = "http://ais.angkasapura1.co.id/navicom/get_ais.php";
	$response = file_get_contents($url_request);
	$string = json_decode($response, true);
        //print_r($string);exit;		      
// if($i==0){	print_r($string);exit;}
//	echo 'name: ' . $string['Flight']['Contents']['Content'][0]['name']. '<br>';exit;
	//echo $string['_Count'];//exit;
	//echo "name 193: ".$string[190]['name']; exit;
	$aa=0;
	foreach($string as $rows)
	{
            echo "\n $aa \n"; $aa++;
            //print_r($rows); exit;
            $z =1;
            if(is_array($rows))
            {
		foreach($rows as $row2){
                    echo "$z "; $z++;
                    $nopen =  trim($row2['nopen']);
                    $airline_name =  trim($row2['airline']);
                    $schedule =  $row2['schedule'];
                    $new_schedule =  $row2['new_schedule'];
                    $estimate =  $row2['estimate'];
                    $actual =  $row2['actual'];
                    $terminal =  trim($row2['terminal']);
                    $gate =  trim($row2['gate']);
                    $remark =  trim($row2['remark']);
                    $destination =  trim($row2['destination']);
                    $airport_dest =  trim($row2['airport_dest']);
                    $origin =  trim($row2['origin']);
                    $airport_ori =  trim($row2['airport_ori']);
                    $update_remark =  $row2['update_remark'];
                    $lastupdate =  $row2['lastupdate'];
				
			$fids_type = ($airport_dest == $airport_base)? 0 : 1;
			/*if($fids_type == "WAAA") {
				$fids_type = 0;
			} else {
				$fids_type = 1;
			} */
			$fids_flight = str_replace("-", "", trim($nopen));
			$airline_code_3 = $nopen;
			$sign = explode("-", $nopen);
			$airline_code = $sign[0];
					
			$airport = 1;
			//$status_code = $update;
			$fids_city = $destination;
			
			$new_time = empty($actual)? $new_schedule : $actual;
//			echo $new_time;exit();
			$dates = new DateTime($new_time, new DateTimeZone('Asia/Makassar'));
			$dates->setTimezone(new DateTimeZone('Asia/Makassar'));
			$fids_time = $dates->format('H:i');
			$fids_timestamp = mktime($dates->format('H'), $dates->format('i'), $dates->format('s'), $dates->format('m'), $dates->format('d'), $dates->format('Y'));

			$jy = date('y',$fids_timestamp);
			$jd = date('z',$fids_timestamp)+1;
			$jd = str_pad($jd, 3, "0", STR_PAD_LEFT);
			$status = $remark;
			

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
					if(in_array($fids_flight,$flight_pool))
					{
						//echo "FOUND \n"; exit;
						$sql_temp = "SELECT fids_remark AS temp_remark FROM airport_fids_temp WHERE fids_remark='$status' AND fids_flight='$fids_flight' AND fids_new_schedule>='$hari_ini'";
						//echo "$sql_temp"; exit;
						$result_temp = $db->sql_query($sql_temp);
 			                	$temp_remark = $db->sql_fetchfield('temp_remark');
						$db->sql_freeresult($result_temp);

						//if (empty($temp_flight))
						if($temp_remark !== $status && $hari_ini < $new_schedule)
						{
							if(in_array($fids_flight,$flight_strange))
							{
								$sql_temp_arr = array(
                                                                        'fids_flight'           => (string) $fids_flight,
                                                                        'fids_city'             => (string) $fids_city,
                                                                        'fids_time'             => (string) $fids_time,
                                                                        'fids_gate'             => (string) $gate,
                                                                        'fids_remark'           => $status,
                                                                        'fids_schedule'         => (string) $row2['schedule'],
                                                                        'fids_estimate'         => (string) $row2['estimate'],
                                                                        'fids_actual'           => (string) $row2['actual'],
                                                                        //'fids_update'         => (string) $row2['update'],
                                                                        //'fids_blocktime'      => (string) $row2['block_time'],
                                                                        'fids_new_schedule'     => $row2['new_schedule'],
                                                                        'remark_temp'       	=> '#' . $status . '#',
                                                                        'flight_no_temp'       => '#' . $fids_flight . '#',
                                                                        'fids_stamp'            => $hari_ini,
									'timestamp'			=> date('Y-m-d H:i:s'),
                                                                );

							}else{

								$sql_temp_arr = array(
									'fids_flight'           => (string) $fids_flight,
                                                			'fids_city'          	=> (string) $fids_city,
                                                			'fids_time'             => (string) $fids_time,
                                                			'fids_gate'             => (string) $gate,
                                                			'fids_remark'           => $status,
                                                			'fids_schedule'       	=> (string) $row2['schedule'],
                                                			'fids_estimate'        	=> (string) $row2['estimate'],
                                        	        		'fids_actual'    	=> (string) $row2['actual'],
                                	                		//'fids_update'    	=> (string) $row2['update'],
									//'fids_blocktime'	=> (string) $row2['block_time'],
									'fids_new_schedule'	=> $row2['new_schedule'],
									//'fids_update_pax'       => (string) $row2['update_pax'],
									//'fids_update_bay'       => (string) $row2['update_bay'],
									'fids_stamp'       	=> $hari_ini,
									'timestamp'             => date('Y-m-d H:i:s'),
								);


							}

							$sql_temp_insert = "INSERT INTO airport_fids_temp " . $db->sql_build_array('INSERT', $sql_temp_arr);
							$db->sql_query($sql_temp_insert);

						}

					}
					/* END TONJAW */	

				$micro_time = microtime(true);
				$micro_time = str_replace(".", "", $micro_time);
				
				if($total_data == 0) {
				//if($row['airport_fids_update_opr'] == 'insert') {
					$sql_ary = array(
						'fids_flight' 		=> (string) $fids_flight,
						//'airport_id'		=> (int) $airport_id,
						'fids_airline_code'	=> (string) $airline_code,
						'fids_airline' 		=> (string) $airline_name,
						'fids_city' 		=> (string) $fids_city,
						'fids_time' 		=> (string) $fids_time,
						'fids_terminal' 	=> (string) $terminal,
						'fids_gate' 		=> (string) $gate,
						'fids_remark'		=> $remark,
						'fids_type' 		=> (int) $fids_type,
						'fids_lastupdate'	=> (int) time(),
						//'airport_fids_update_id'	=> (int) $id,
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
				/* DISABLE APPS
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
DISABLE APPS */ 
			
			 }
            }				
    }	
		// }		
		

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	//$db->sql_freeresult($result);
	/*
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
	*/
	echo "\nSLEEP 5...";
	sleep(5);
	
}
?>
