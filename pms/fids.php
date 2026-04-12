<?php
/**
*
* pms/fids.php
*
* Agnes Emanuella. Oct 2017
*/

/**
* 
*/
if (!defined('IN_TONJAW'))
{
	die('Hacking Attempt');
}

include_once($tonjaw_root_path . $config['pms_path'] . 'pmsal.' . $phpEx);

$pms_event['event'] 		= 'event';
$pms_event['flight_remark'] = 'flight_remark';
$pms_event['alert']			= 'alert';
$pms_event['subscribe'] 	= 'subscribe';
$pms_event['fids']			= 'fids';
$pms_event['live']			= 'live';
$pms_event['delete']                      = 'delete';


$pms_event['daily_occupancy'] 	= 'DAYOCCUPANCY';
$pms_event['daily_occupancy_detail'] 	= 'DAYOCCUPANCYDETAIL';
$pms_event['month_occupancy'] 	= 'MONTHOCCUPANCY';

$pms_request['hotel_info']	= 'HELLO';
$pms_request['guest_bill']	= 'GUESTBILL';
$pms_request['room_list']	= 'ROOMLIST';
$pms_request['menu_item'] 	= 'MENUITEM';
$pms_request['send_message']	= 'SENDMESSAGE';
$pms_request['post_transaction']	= 'POSTTRASACTION';

$pms_error_code['0']	= 'OK';
$pms_error_code['100']	= 'Invalid Integer Value';
$pms_error_code['120']	= 'Invalid Decimal Value';
$pms_error_code['130']	= 'Invalid Date Time Format (YYYY-MM-DDThh:mm:ss)';
$pms_error_code['200']	= 'API does not exists';
$pms_error_code['210']	= 'Missing Parameter';
$pms_error_code['220']	= 'Please Contak Realta Rhapsody, No Primary Key Defined';
$pms_error_code['230']	= 'Access Denied, No Primary Key Field';
$pms_error_code['300']	= 'Database Error';
$pms_error_code['310']	= 'Access Denies, duplicate record';
$pms_error_code['320']	= 'Invalid Parameter(s)';
$pms_error_code['400']	= 'Login Failed, please check User Name, Password or API Key/License';
$pms_error_code['410']	= 'Invalid API Key/License';
$pms_error_code['700']	= 'Invalid XML Format';
$pms_error_code['900']	= 'Unknown Error';

$pms_config['pms_name'] = 'Hotel Information System';
$pms_config['pms_version'] = 'n/a';
$pms_config['pms_vendor'] = 'n/a';
$pms_config['pms_website'] = '';

$pms_config['room_status'][0] = 'OCCUPIED CLEAN';
$pms_config['room_status'][1] = 'OCCUPIED DIRTY';
$pms_config['room_status'][2] = 'VACANT CLEAN';
$pms_config['room_status'][3] = 'VACANT DIRTY';
$pms_config['room_status'][4] = 'VACANT READY';


/**
* FIDS Abstraction Layer
* Developed on Navicom IPTV
* @package pmsal
*/
class pmsal_fids extends pmsal
{
    var $guest_data = array();
    var $info_data = array();
    var $bill_data = array();
    var $message_data = array();
    var $room_data = array();
    var $menu_data = array();
	
	function subscribe()
    {
	global $db;
	
	$success = 0;
	$error = 0;
	
	$flight_no = request_var('FlightNo', '');
	$passenger_name = request_var('PassengerName', '');
	$seat_no = request_var('SeatNo', '');
	$airport_code = request_var('AirportCode', '');
	$lang_id = request_var('lang', '');
	$date = request_var('date','');
        $deviceid = request_var('deviceId','');

	
	 $dates = new DateTime($new_time, new DateTimeZone('Asia/Makassar'));
            $dates->setTimezone(new DateTimeZone('Asia/Makassar'));
            $fids_time = $dates->format('H:i');
            $fids_timestamp1 = mktime($dates->format('H'), $dates->format('i'), $dates->format('s'), $dates->format('m'), $dates->format('d'), $dates->format('Y'));
	    $fids_timestamp = date("Y-m-d H:i:s", mktime($dates->format('H'), $dates->format('i'), $dates->format('s'), $dates->format('m'), $dates->format('d'), $dates->format('Y')));
            $testdate = date('H:i',strtotime('+16 hour',strtotime($dates)));
            $mindate = date('H:i',strtotime('-3 hour',strtotime($fids_time)));
            $jy = date('y',$fids_timestamp1);
            $jd = date('z',$fids_timestamp1)+1;
            $jd = str_pad($jd, 3, "0", STR_PAD_LEFT);

	$flight_no = str_replace(" ", "", $flight_no);
	
	$sql = "SELECT COUNT(*) AS total_airport FROM " . AIRPORTS_TABLE . " WHERE airport_code = '".$airport_code."'";
	$result = $db->sql_query($sql);
	$total_airport = $db->sql_fetchfield('total_airport');
	
	$db->sql_freeresult($result);
	
	if($total_airport > 0) {
		//$sql = "SELECT COUNT(*) AS total_flight FROM " . AIRPORT_FIDS_TABLE . " WHERE fids_flight = '".$flight_no."' and fids_timestamp >= ".time()." and fids_remark != 'Scheduled' ";
		$sql = "SELECT COUNT(*) AS total_flight FROM " . AIRPORT_FIDS_TABLE . " WHERE fids_flight = '".$flight_no."'  and fids_jdate = '".$jd."' AND fids_type = 1";
		//echo $sql; exit;
		$result = $db->sql_query($sql);
		$total_flight = $db->sql_fetchfield('total_flight');
	
		if($total_flight == 0) {
			$num = substr($flight_no, 2);
			if(substr($num, 0, 1) == "0") {
				$num1 = substr_replace($num, "", 0, 1);
				$flight_no1 = substr($flight_no, 0, 2) . $num1;
			
			
			//echo $flight_no1; exit;
			//$sql = "SELECT COUNT(*) AS total_flight FROM " . AIRPORT_FIDS_TABLE . " WHERE fids_flight = '".$flight_no."' and fids_timestamp >= ".time()." and fids_remark != 'Scheduled'";
        	        $sql1 = "SELECT COUNT(*) AS total_flight FROM " . AIRPORT_FIDS_TABLE . " WHERE fids_flight = '".$flight_no1."'";
			$result = $db->sql_query($sql1);
	                $total_flight = $db->sql_fetchfield('total_flight');
			}
		}
		 
		$db->sql_freeresult($result);
		
		if($total_flight > 0) {
			$sql = "SELECT COUNT(*) AS total_data FROM " . AIRPORT_PASSENGERS_TABLE . " WHERE upper(airport_passenger_name) = '".strtoupper($passenger_name)."' AND fids_flight = '".$flight_no."' AND airport_passenger_seat_no = '".$seat_no."' AND airport_passenger_date = '".$date."' AND airport_passenger_phone_id ='".$deviceid."' ";
			$result = $db->sql_query($sql);
			$total_data = $db->sql_fetchfield('total_data');
			
			if($total_data == 0) {			
				$sql_ary = array(
					'airport_passenger_name'	=> (string) $passenger_name,
					'airport_passenger_seat_no'	=> (string) $seat_no,
					'airport_passenger_lang_id'	=> (string) (!empty($lang_id)) ? $lang_id : 'en',
					'fids_flight'				=> (string) $flight_no,
					'airport_code'				=> (string) $airport_code,
					'airport_passenger_date'        =>(string) $date,
                                        'airport_passenger_phone_id'   => (string) $deviceid,
				);
				
				$sql = 'INSERT INTO ' . AIRPORT_PASSENGERS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
				
				//echo $sql; exit;
				$db->sql_query($sql);
				
				$success = $success + 1;
				
				// Send signal to TP-Link device
				if($config['device_switch_on'] == 'subscribe') {
					$this->device($flight_no, 1);
				}
				
			} else {
				$error = $error + 1;
				$message = 'This passenger is already subscribed!';
			}
		} else {
			$error = $error + 1;
			$message = 'Flight number '.$flight_no.' is not valid!';
		}
	} else {
		$error = $error + 1;
		$message = 'Airport code is not valid!';
	}
	
	if($success > 0) {
		$data = array(
			'Navicom_Response' => array(
				'Status'        => array(
						'ErrorCode'    => (string) 0,
						'Timestamp'     => (string) time(),
						'Message'       => (string) 'OK',
				)
			)
		);
		
	} else if($error > 0) {
		$data = array(
			'Navicom_Response' => array(
				'Status'        => array(
						'ErrorCode'    => (string) 2,
						'Timestamp'     => (string) time(),
						'Message'       => (string) $message,
				)
			)
		);
	}
	
	header('Content-type: application/json');
	$json_data = json_encode($data);
	
	return $json_data;
    }



	 function delete()
    {
        global $db;

        $success = 0;
        $error = 0;

        $flight_no = request_var('FlightNo', '');
        $passenger_name = request_var('PassengerName', '');
        $seat_no = request_var('SeatNo', '');
        $airport_code = request_var('AirportCode', '');
        $lang_id = request_var('lang', '');
        $date = request_var('date','');
        $deviceid = request_var('deviceId','');

         $sql = "SELECT COUNT(*) AS total_data FROM " . AIRPORT_PASSENGERS_TABLE . " WHERE upper(airport_passenger_name) = '".strtoupper($passenger_name)."' AND fids_flight = '".$flight_no."' AND airport_passenger_seat_no = '".$seat_no."' AND airport_passenger_date = '".$date."' AND airport_passenger_phone_id = '".$deviceid."'";
                        $result =  $db->sql_query($sql);
                        $total_data = $db->sql_fetchfield('total_data');

                 if($total_data > 0){
        $sql_delete = "DELETE FROM " . AIRPORT_PASSENGERS_TABLE . " WHERE upper(airport_passenger_name) = '".strtoupper($passenger_name)."' AND fids_flight = '".$flight_no."' AND airport_passenger_seat_no = '".$seat_no."' AND airport_passenger_date = '".$date."' AND airport_passenger_phone_id = '".$deviceid."'";
                         $db->sql_query($sql_delete);
                        $success = $success + 1;

        }else{

        $error = $error + 1;
                        //      $message = 'Please Try Again';
        }
        if($success > 0) {
                $data = array(
                        'Navicom_Response' => array(
                                'Status'        => array(
                                                'ErrorCode'    => (string) 0,
                                                'Timestamp'     => (string) time(),
                                                'Message'       => (string) 'OK',
                                )
                        )
                );

        } else if($error > 0) {
		 $data = array(
                        'Navicom_Response' => array(
                                'Status'        => array(
                                                'ErrorCode'    => (string) 2,
                                                'Timestamp'     => (string) time(),
                                                'Message'       => (string) $message,
                                )
                        )
                );
        }
                        //$db->sql_freeresult($result);

        header('Content-type: application/json');
        $json_data = json_encode($data);

        return $json_data;
        }
	
	function fids()
    {
	global $db;
	
	$success = 0;
	$error = 0;
	
	$airport_code = request_var('code', '');
	$dates = new DateTime($new_time, new DateTimeZone('Asia/Makassar'));
            $dates->setTimezone(new DateTimeZone('Asia/Makassar'));
            $fids_time = $dates->format('H:i');
            $fids_timestamp = date("Y-m-d H:i:s", mktime($dates->format('H'), $dates->format('i'), $dates->format('s'), $dates->format('m'), $dates->format('d'), $dates->format('Y')));
	    //$testdate = date('H:i',strtotime('+16 hour',strtotime($dates)));
            //$mindate = date('H:i',strtotime('-1 hour',strtotime($fids_time)));	    

	    /** added by Agnes, 27 Nov 2018 **/
	    $fids_time2 = mktime($dates->format('H'), $dates->format('i'), 0, $dates->format('m'), $dates->format('d'), $dates->format('Y'));
	    $testdate = date("Y-m-d H:i:s", strtotime('+16 hour',$fids_time2));
	    $mindate = date("Y-m-d H:i:s", strtotime('-1 hour',$fids_time2));
	    /** end **/	
            $jy = date('y',$fids_timestamp);
            $jd = date('z',$fids_timestamp)+1;
            $jd = str_pad($jd, 3, "0", STR_PAD_LEFT);
	$null = '';
	$sql = "SELECT COUNT(*) AS total_airport FROM " . AIRPORTS_TABLE . " WHERE airport_code = '".$airport_code."'";
	$result = $db->sql_query($sql);
	$total_airport = $db->sql_fetchfield('total_airport');
	
	$db->sql_freeresult($result);
	
	if($total_airport > 0) {
		$sql = "SELECT * FROM " . AIRPORTS_TABLE . " WHERE airport_code = '".$airport_code."'";
		$result = $db->sql_query($sql);
		$airport_data = $db->sql_fetchrow($result);
		$airport_name = $airport_data['airport_name'];
		$airport_state = $airport_data['airport_state'];
		$airport_country = $airport_data['airport_country'];
		$airport_phone = $airport_data['airport_phone'];
		$airport_city = $airport_data['airport_city'];
		
		
		$sql = "SELECT COUNT(*) AS total_flight FROM " . AIRPORT_FIDS_TABLE . " f RIGHT JOIN " . AIRPORTS_TABLE . " a ON f.airport_id = a.airport_id WHERE a.airport_code = '".$airport_code."'";
		$result = $db->sql_query($sql);
		$total_flight = $db->sql_fetchfield('total_flight');
		
		$db->sql_freeresult($result);
		
		if($total_flight > 0) {
			//$sql = "SELECT * FROM " . AIRPORT_FIDS_TABLE . " where fids_jdate='".$jd."'";
			//$sql = "SELECT * FROM " . AIRPORT_FIDS_TABLE . " where fids_time >='".$mindate."' and fids_time <='".$testdate."'";

			/** edited by Agnes, 27 Nov 2018 **/
			$sql = "SELECT * FROM " . AIRPORT_FIDS_TABLE . " where fids_timestamp >='".$mindate."' and fids_timestamp <='".$testdate."' ORDER BY fids_timestamp";
			/** end **/

			 //$sql = "SELECT * FROM " . AIRPORT_FIDS_TABLE . " ORDER BY fids_timestamp asc";
			$result = $db->sql_query($sql);
			$flight = array();
			while($row = $db->sql_fetchrow($result)) {
				if($row['fids_type'] == 0) {
					$origin = $row['fids_city'];
					$destination = '';
					$type = 'Arrival';
				} else if($row['fids_type'] == 1) {
					$origin = '';
					$destination = $row['fids_city'];
					$type = 'Departure';
				}
				
				$flight[] = array (
					'FlightID' 			=> (string) $row['fids_flight'],
					'AirlineCode'		=> (string) $row['fids_airline_code'],
					'Airline'			=> (string) $row['fids_airline'],
					'Origin'			=> (string) $origin,
					'Destination'		=> (string) $destination,
					'Time'				=> (string) $row['fids_time'],
					'Terminal'			=> (string) $row['fids_terminal'],
					//'Terminal'                    => '',
					'Gate'				=> (string) $row['fids_gate'],
					'Remark'			=> (string) $row['fids_remark'],
					'Type'				=> (string) $type,
					'Timestamp'				=> $row['fids_timestamp'],
				);
			}
			
			//print_r($flight); exit;
			$success = $success + 1;
			
		} else {
			$error = $error + 1;
			$message = 'Flight data is not available!';
		}
	} else {
		$error = $error + 1;
		$message = 'Airport code is not valid!';
	}
	
	if($success > 0) {
		$data = array(
			'Status' => array(
					'attributes'	=> array(
						'ErrorCode'	=> (string) 0,
						'TimeStamp'	=> (string) time(),
					),
					'Message'		=> (string) 'OK',			
					),
			'Airport' => array(
					'Name'	=> (string) $airport_name,
					'Code'	=> (string) $airport_code,
					'City'	=> (string) $airport_city,
					'State'	=> (string) $airport_state,
					'Country'	=> (string) $airport_country,
					'Phone'		=> (string) $airport_phone,			
					),
			'Record' => $flight,
			
		);
		
	} else if($error > 0) {
		$data = array(
			'Status' => array(
					'attributes'	=> array(
						'ErrorCode'	=> (string) 2,
						'TimeStamp'	=> (string) time(),
					),
					'Message'		=> (string) $message,			
					),
		);
	}
	
	header('Content-type: application/json');
	$json_data = json_encode($data);
	
	return $json_data;
    }
	
	
	function live()
    {
	global $db;
	
	$success = 0;
	$error = 0;
	
	$airport_code = request_var('code', '');
	
	$sql = "SELECT COUNT(*) AS total_airport FROM " . AIRPORTS_TABLE . " WHERE  airport_code = '".$airport_code."'";
	$result = $db->sql_query($sql);
	$total_airport = $db->sql_fetchfield('total_airport');
	
	$db->sql_freeresult($result);
	
	if($total_airport > 0) {
		$sql = "SELECT * FROM " . AIRPORTS_TABLE . " WHERE airport_code = '".$airport_code."'";
		$result = $db->sql_query($sql);
		$airport_data = $db->sql_fetchrow($result);
		$airport_name = $airport_data['airport_name'];
		$airport_state = $airport_data['airport_state'];
		$airport_country = $airport_data['airport_country'];
		$airport_phone = $airport_data['airport_phone'];
		$airport_city = $airport_data['airport_city'];
		
		$db->sql_freeresult($result);
		
		$sql = "SELECT * FROM " . TV_CHANNELS_TABLE . " WHERE tv_channel_url_http != '' and tv_channel_enabled = 1 ORDER BY tv_channel_order";
		$result = $db->sql_query($sql);
		$channel = array();
		$i = 1;
		while($row = $db->sql_fetchrow($result)) {
			$channel[] = array (
				//'ChannelNo' 			=> (string) $row['tv_channel_order'],
				'ChannelNo'                     => (string) $i,
				//'ChannelCode'		=> $row['fids_airline_code'],
				'ChannelName'			=> (string) $row['tv_channel_name'],
				'ChannelUrl'			=> (string) $row['tv_channel_url_http'],
			);
			$i++;
		}
		
		$success = $success + 1;
		
	} else {
		$error = $error + 1;
		$message = 'Airport code is not valid!';
	}
	
	if($success > 0) {
		$channel_count = count($channel);
		
		$data = array(
			'Navicom_Response' => array(
					'Status' => array(
						'ErrorCode'    => (string) 0,
						'Timestamp'     => (string) time(),
						'Message'       => (string) 'OK',
					),
					'Airport' => array(
						'Name'	=> (string) $airport_name,
						'Code'	=> (string) $airport_code,
						'City'	=> (string) $airport_city,
						'State'	=> (string) $airport_state,
						'Country'	=> (string) $airport_country,
						'Phone'		=> (string) $airport_phone,			
					),
					"Channel" => array (
						"DataCount" => (string) $channel_count,
						"Record" => $channel,
					)
				)	
		);
		
	} else if($error > 0) {
		$data = array(
			'Status' => array(
					'attributes'	=> array(
						'ErrorCode'	=> (string) 2,
						'TimeStamp'	=> (string) time(),
					),
					'Message'		=> (string) $message,			
					),
		);
	}
	
	header('Content-type: application/json');
	$json_data = json_encode($data);
	
	return $json_data;
    }
	
	
	function update_flight_remark()
    {
	global $db;
	
	$airport_code = request_var('code', '');
	$flight = request_var('flight', '');
	$remark = request_var('remark', '');
	$jd = request_var('jd', '');
	$dates = new DateTime($new_time, new DateTimeZone('Asia/Makassar'));
	$testdate = date('H',strtotime('+1 hour',strtotime($dates)));
	$fidscount = date("Y-m-d H:i:s", mktime($dates->format('H')-1, $dates->format('i'), $dates->format('s'), $dates->format('m'), $dates->format('d'), $dates->format('Y')));	
	$micro_time = microtime(true);
	//$micro_time = str_replace(".", "", $micro_time);
	
	if(!empty($airport_code)) {
		//$sql = "SELECT fids_id FROM " . AIRPORT_FIDS_TABLE . " f RIGHT JOIN " . AIRPORTS_TABLE . " a ON f.airport_id = a.airport_id WHERE a.airport_code = '".$airport_code."' AND f.fids_flight = '".$flight."' ORDER BY fids_lastupdate DESC LIMIT 1";
		$sql = "SELECT fids_id FROM " . AIRPORT_FIDS_TABLE . " f WHERE f.fids_flight = '".$flight."' ORDER BY fids_lastupdate DESC LIMIT 1";
		$result = $db->sql_query($sql);
		$fids_id = $db->sql_fetchfield('fids_id');
		
		if(!empty($fids_id)) {
			$sql = "SELECT airport_flight_status_display_on_tv, airport_flight_status_remark FROM " . AIRPORT_FLIGHT_STATUS_TABLE . " WHERE airport_flight_status_remark_code = '".$remark."'"; 
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$display_on_tv = $row['airport_flight_status_display_on_tv'];
			if($display_on_tv) {
				$fids_changed = 1;
			} else {
				$fids_changed = 0;
			}
			
			$sql_update = "UPDATE " . AIRPORT_FIDS_TABLE . " SET fids_lastupdate = '".date('Y-m-d H:i:s')."', fids_changed = ".$fids_changed.", fids_lastupdate_microtime = ".$micro_time." WHERE fids_id = ".$fids_id;
			$db->sql_query($sql_update);
			
			$sql_update_nodes = "UPDATE " . NODES_TABLE . " SET fids_flag = 1";
			$db->sql_query($sql_update_nodes);
			
			//$sql_update_passengers = "UPDATE " . AIRPORT_PASSENGERS_TABLE . " SET flight_flag = 1";
			//$db->sql_query($sql_update_passengers);
			
			
			if($remark == 'DEP' || $remark == 'LAN') {
				
				$sql = "SELECT COUNT(*) AS total_flight FROM " . AIRPORT_FIDS_TABLE . " WHERE fids_lastupdate < '".$fidscount."' and fids_remark in ('Departed','Landed')";
				$result = $db->sql_query($sql);
				$total_flight = $db->sql_fetchfield('total_flight');
				$db->sql_freeresult($result);
				if($total_flight > 0 ){
				    $sql_flight = "SELECT fids_flight FROM " . AIRPORT_FIDS_TABLE . " WHERE fids_lastupdate < '".$fidscount."' and fids_remark in ('Departed','Landed')";
                                    $result_flight = $db->sql_query($sql_flight);
				    while($row_flight = $db->sql_fetchrow($result_flight)) {
				
					$sql_delete = "DELETE FROM " . AIRPORT_FIDS_TABLE . " WHERE fids_flight = '".$row_flight['fids_flight']."'";
					$db->sql_query($sql_delete); 
					
					$sql_delete_psg = "DELETE FROM " . AIRPORT_PASSENGERS_TABLE . " WHERE fids_flight = '".$row_flight['fids_flight']."'";
					$db->sql_query($sql_delete_psg);
				
					// Unsubscribe from Apps
					$status = $row['airport_flight_status_remark'];
					$apps = array("android", "ios");
				
					for($i=0; $i<2; $i++) {
					foreach($apps as $app) {
						if($app == "android") {
							$data_array = array(
									'data'	=> array(
										'c_message' 		=> $flight.' - '.$status,
										'c_info' 			=> 'delete_data',
										'c_click_action'	=> 'STATUS_UPDATE',
										'c_title' 			=> $flight,	
									),
									'to'	=> '/topics/'.$app.$flight.$jd,
									'priority'	=> 'high'
								);
						} else if($app == "ios") {
							$data_array = array(
									'notification' => array(
											'title'	=> $flight,
											'body'	=> $flight.' - '.$status,
											'badge'	=> "0",
											'sound'	=> 'default'
										),
									'data'	=> array(
											'c_message' 		=> $flight.' - '.$status,
											'c_info' 			=> 'delete_data',
											'c_click_action'	=> 'STATUS_UPDATE',
											'c_title' 			=> $flight,	
										),
										'to'	=> '/topics/'.$app.$flight.$jd
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
						$err = curl_error($curl);
						curl_close($curl);

						/*if ($err) {
							if($i < 2) {
								$stringData = 'cURL Error : '.$err." \r\n";
								fwrite($fh, $stringData);
							}
						} else {
						  //echo $response;
						}*/
					
					}			
					}
				
					// Send signal to TP-Link device
					$this->device($flight, 0);
				}
			}
			}//echo $sql; exit;
			return true;
			
		} else {
			return false;
		}
	} else {
		return false;
	}
	
	
    }
	
	function device($flight_id, $status) {
		global $db;
		
		$sql = "SELECT d.*, n.node_name from " . AIRPORT_FIDS_TABLE . " a 
			JOIN " . ROOMS_TABLE . " r on a.fids_gate = r.room_name
			JOIN " . NODES_TABLE . " n on r.room_id = n.room_id
			JOIN " . DEVICE_TABLE . " d on n.node_id = d.node_id
			WHERE a.fids_flight = '".$flight_id."' ";
		$result = $db->sql_query($sql);
		while($row = $db->sql_fetchrow($result)) {
			$data_string = '{"method":"passthrough", "params": {"deviceId": "'.$row['device_smartid'].'", "requestData": "{\"system\":{\"set_relay_state\":{\"state\":'.$status.'}}}" }}';

			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://aps1-wap.tplinkcloud.com/?token=d4fcfd62-29d3daf8858e49f1860a0c9",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  //CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => $data_string,
			  CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"content-type: application/json",
				"postman-token: b9fd21fa-a5a6-dc8c-839c-17eb5223f6c5"
			  ),
			  CURLOPT_SSL_VERIFYHOST => 0,
			  CURLOPT_SSL_VERIFYPEER => 0,
			));

			$response = curl_exec($curl);

			if(curl_errno($curl))
			{
					//echo $data_string.' x';
					echo curl_error($curl);
			}
			else
			{
					curl_close($curl);
					echo $response;
			}
		
		}
	}
	
	
	function alert()
    {
	global $db;
	
	$success = 0;
	$error = 0;
	
	$sql = "SELECT emergency_code, signage_urgency_departure_gate, signage_urgency_message, signage_urgency_enabled FROM " . SIGNAGE_URGENCIES_TABLE . " WHERE signage_urgency_flag = 'emergency'";
	$result = $db->sql_query($sql);
	$emergency = array();
	while($row = $db->sql_fetchrow($result)) {
		$emergency[] = array (
			'Gate' 			=> $row['signage_urgency_departure_gate'],
			'AlertCode'		=> $row['emergency_code'],
			'OnOff'			=> ($row['signage_urgency_enabled']) ? 'ON' : 'OFF',
			'Remark'		=> $row['signage_urgency_message'],
		);
		
		$success = $success + 1;
	}
	
	if($success > 0) {
		$data = array(
			'Navicom_Broadcast' => array(
					'Status' => array(
						'ErrorCode'    	=> (string) 0,
						'Timestamp'     => (string) time(),
						'Message'       => (string) 'OK',
					),
					'Data' => $emergency,			
					
				)	
		);
		
	} 
	
	header('Content-type: application/json');
	$json_data = json_encode($data);
	
	return $json_data;
    }
	
	
	
	
	
	
	function checkin($xml,&$code='')
    {
	global $db;
	
	//$guest_info = $this->get_guest_info(trim($xml->Entry->RoomNo));
	$xml_guest = $this->get_guest_info(trim($xml->Entry->RoomNo));
	
	$this->guest_data['room'] = trim($xml->Entry->RoomNo);
	//$this->guest_data['connect_room'] = request_var('ConnectRoom', '');
	//$this->guest_data['arrival_date'] = $this->maketime(request_var('ArrivalDate', ''));
	$this->guest_data['resv_id'] = trim($xml->Entry->FolioNo);
	//$this->guest_data['first_name'] = request_var('FirstName', '');
	//$this->guest_data['last_name'] = request_var('LastName', '');
	$this->guest_data['fullname'] = trim($xml->Entry->GuestName);
	$this->guest_data['salutation'] = $xml_guest->Guest[0]->Title;
	$this->guest_data['language'] = trim($xml->Entry->DefLanguage);
	$this->guest_data['group'] = trim($xml->Entry->GroupId);
	$this->guest_data['group_name'] = trim($xml->Entry->GroupName);
	//$this->guest_data['allow_post'] = strtoupper(request_var('AllowPost', 'N'));
	//$this->guest_data['allow_viewbill'] = strtoupper(request_var('AllowViewBill', 'N'));
	//$this->guest_data['vip'] = strtoupper(request_var('VIP', 'N'));
	//$this->guest_data['honeymoon'] = strtoupper(request_var('HoneyMoon', 'N'));
	$this->guest_data['room_share'] = (int) (count($xml_guest->Guest) > 1) ? 1 : 0;
	//$this->guest_data['remark'] = request_var('Remark', '');
	
	if(empty($this->guest_data['room']) || empty($this->guest_data['resv_id']))
	{
	    $code = 220;
	    
	    return false;
	}
	
	//$lang_id = (strtoupper($this->guest_data['language']) == "INA") ? 'id' : 'en';
	//if(strtoupper($this->guest_data['language']) == "INA") {
	if(strcasecmp($this->guest_data['language'], "INA") == 0) {
	    $lang_id = 'id';
	} else {
	    $lang_id = 'en';
	}
	
	$sql_ary = array(
	    'guest_reservation_id'	=> (int) $this->guest_data['resv_id'],
	    'guest_arrival_date'	=> time(),
	    'guest_firstname'		=> (string) $this->guest_data['first_name'],
	    'guest_lastname'		=> (string) $this->guest_data['last_name'],
	    'guest_fullname'		=> (string) $this->guest_data['fullname'],
	    'guest_salutation'		=> (string) $this->guest_data['salutation'],
	    'guest_group'		=> (int) $this->guest_data['group'],
	    'guest_groupname'		=> (string) $this->guest_data['group_name'],
	    'guest_language'		=> (string) $lang_id,
	    'guest_allow_post'		=> (int) $this->guest_data['allow_post'],
	    'guest_allow_viewbill'	=> (int) $this->guest_data['allow_viewbill'],
	    'guest_vip'			=> (int) $this->guest_data['vip'],
	    'guest_honeymoon'		=> (int) $this->guest_data['honeymoon'],
	    'guest_room_share'		=> (int) $this->guest_data['room_share'],
	    'room_name'			=> (string) $this->guest_data['room'],
	    'guest_connect_room'	=> (string) $this->guest_data['connect_room'],
	);
	
	$sql = 'INSERT INTO ' . GUESTS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	
	//echo $sql; exit;
	$db->sql_query($sql);
	
	//Set room key
	$this->generate_room_key($this->guest_data['resv_id'], $this->guest_data['room']);
	
	$sql = "SELECT n.node_id FROM ".GUESTS_TABLE." g LEFT JOIN ".ROOMS_TABLE." r ON g.room_name = r.room_name LEFT JOIN ".NODES_TABLE." n ON r.room_id = n.room_id WHERE g.guest_reservation_id = ".$this->guest_data['resv_id']."";
	$result = $db->sql_query($sql);
	while($row = $db->sql_fetchrow($result)) {
		$sql = "UPDATE " . NODES_TABLE . " SET node_lang_id='" . $lang_id ."'
			  WHERE node_id = ".$row['node_id']."";
		$db->sql_query($sql);
			//echo $sql; exit;
	}
	
	
	$code = 0;
	return true;
    }
    
    function checkout($xml,&$code='',$old_resv_id='')
    {
	global $db, $guests_name;
	
	if(empty(trim($xml->Entry->RoomNo))) {
		$this->guest_data['room'] = $guests_name[0]['room'];
	} else {
		$this->guest_data['room'] = trim($xml->Entry->RoomNo);
	}
	
	$sql = "SELECT guest_reservation_id FROM ".GUESTS_TABLE." WHERE room_name = '".$this->guest_data['room']."'";
	$result = $db->sql_query($sql);
	$reservation_id = $db->sql_fetchfield('guest_reservation_id');
	//echo $sql; exit;
	$this->guest_data['resv_id'] = $reservation_id;
	
	if(!empty($old_resv_id)) { //tamu lama blm ter-checkout, pake resv_id si tamu lama
		$this->guest_data['resv_id'] = $old_resv_id;
	}
	
	if(empty($this->guest_data['room']) || empty($this->guest_data['resv_id']))
	{
	    $code = 220;
	    
	    return false;
	}
	
	// remove the record from guest table
	$sql = 'DELETE FROM ' . GUESTS_TABLE . " 
	    WHERE guest_reservation_id=" . $this->guest_data['resv_id'];
	$db->sql_query($sql);
	
	// remove guest's message
	$sql = 'DELETE FROM ' . GUEST_MESSAGES_TABLE . " 
	    WHERE guest_reservation_id=" . $this->guest_data['resv_id'];
	$db->sql_query($sql);
	
	// remove guest's bill
	$sql = 'DELETE FROM ' . GUEST_BILLS_TABLE . " 
	    WHERE guest_reservation_id=" . $this->guest_data['resv_id'];
	$db->sql_query($sql);
	
	// remove guest's roomservice
	$sql = 'DELETE FROM ' . GUEST_SERVICES_TABLE . " 
	    WHERE guest_reservation_id=" . $this->guest_data['resv_id'];
	$db->sql_query($sql);
	
	//Reset room key
	$sql = 'SELECT guest_reservation_id FROM ' . GUESTS_TABLE . "
	    WHERE room_name='" . $this->guest_data['room'] . "'";
	    
	$result = $db->sql_query($sql);
	$resv_id = $db->sql_fetchfield('guest_reservation_id');
	$db->sql_freeresult($result);
	
	if( !empty($resv_id) )
	{
	    //set the guest share status
	    $sql = 'UPDATE ' . GUESTS_TABLE . " SET guest_room_share=0 
		WHERE room_name='" . $this->guest_data['room'] . "'";
	    $db->sql_query($sql);
	    
	    $this->generate_room_key($resv_id, $this->guest_data['room']);
	}
	else
	{
	    $sql = 'UPDATE ' . ROOMS_TABLE . " SET room_key='' 
		WHERE room_name='" . $this->guest_data['room'] . "'";
	    $db->sql_query($sql);
	}
	
	$code = 0;
	return true;
    }
	
	function get_guest_info($room_name) {
		global $pms_config;
		
		$guest_info = array();
		
		// GET GUEST INFO FROM FOS
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $pms_config['url_request']."GetRoomGuestInfo?RoomNo=".$room_name);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 2);
		$response = curl_exec($ch); 

		if(curl_errno($ch))
		{
			//print curl_error($ch);
			return false;
		}
		else
		{
			$xml = new SimpleXmlElement($response);	
		
			curl_close($ch);
		}
		
		return $xml;
	}

    function room_change(&$code='')
    {
	global $db;
    
	$this->guest_data['move_from'] = request_var('MoveFrom', '');
	$this->guest_data['resv_id'] = request_var('ReservationID', '');
	$this->guest_data['room'] = request_var('Room', '');
	
	if(empty($this->guest_data['room']) || empty($this->guest_data['resv_id']) )
	{
	    $code = 220;
	    
	    return false;
	}
	
	if( empty($this->guest_data['move_from']) )
	{
	    $sql = 'SELECT room_name FROM ' . GUESTS_TABLE . ' WHERE guest_reservation_id=' . $this->guest_data['resv_id'];
	    
	    $result = $db->sql_query($sql);
	    $this->guest_data['move_from'] = (string) $db->sql_fetchfield('room_name');
	    $db->sql_freeresult($result);
	}
	
	
	// check room sharing
	$sql = 'SELECT COUNT(guest_reservation_id) AS total_guests
		FROM ' . GUESTS_TABLE . " WHERE room_name='" . $this->guest_data['move_from'] . "'";

	$result = $db->sql_query($sql);
	$guest_count = (int) $db->sql_fetchfield('total_guests');
	$db->sql_freeresult($result);
	
	// change the room
	$sql = 'UPDATE ' . GUESTS_TABLE . " SET room_name='" . $this->guest_data['room'] . "', guest_room_share=0 
	    WHERE guest_reservation_id=" . $this->guest_data['resv_id'];
	    
	    //echo $sql ; exit;
	$db->sql_query($sql);	
	
	// set the old friend's room share status to false
	if( $guest_count > 1 )
	{
	    $sql = 'UPDATE ' . GUESTS_TABLE . " SET guest_room_share=0 
		WHERE room_name='" . $this->guest_data['move_from'] . "'";
	    $db->sql_query($sql);
	    
	    //Reset room key
	    $sql = 'SELECT guest_reservation_id FROM ' . GUESTS_TABLE . "
		WHERE room_name='" . $this->guest_data['move_from'] . "'";
	    
	    $result = $db->sql_query($sql);
	    $resv_id = $db->sql_fetchfield('guest_reservation_id');
	    $db->sql_freeresult($result);
	
	    $this->generate_room_key($resv_id, $this->guest_data['move_from']);
	
	}
	else
	{
	    $sql = 'UPDATE ' . ROOMS_TABLE . " SET room_key='' 
		WHERE room_name='" . $this->guest_data['room'] . "'";
	    $db->sql_query($sql);
	}

	$sql = 'SELECT COUNT(guest_reservation_id) AS total_guests
		FROM ' . GUESTS_TABLE . " WHERE room_name='" . $this->guest_data['room'] . "'";

	$result = $db->sql_query($sql);
	$guest_count = (int) $db->sql_fetchfield('total_guests');
	$db->sql_freeresult($result);

	// set the new friend's room share status to true
	if( $guest_count > 1 )
	{
	    $sql = 'UPDATE ' . GUESTS_TABLE . " SET guest_room_share=1 
		WHERE room_name='" . $this->guest_data['room'] . "'";
	    $db->sql_query($sql);
	    
	}
	
	//Set room key
	$this->generate_room_key($this->guest_data['resv_id'], $this->guest_data['room']);
		
	$code = 0;
	return true;
    }
    
    function guest_change(&$code='')
    {
	global $db;

	$this->guest_data['room'] = request_var('Room', '');
	$this->guest_data['connect_room'] = request_var('ConnectRoom', '');
	$this->guest_data['arrival_date'] = $this->maketime(request_var('ArrivalDate', ''));
	$this->guest_data['resv_id'] = request_var('ReservationID', '');
	$this->guest_data['first_name'] = request_var('FirstName', '');
	$this->guest_data['last_name'] = request_var('LastName', '');
	$this->guest_data['fullname'] = request_var('FullName', '');
	$this->guest_data['salutation'] = request_var('Salutation', '');
	$this->guest_data['language'] = strtolower(request_var('Language', ''));
	$this->guest_data['group'] = strtoupper(request_var('Group', 'N'));
	$this->guest_data['group_name'] = request_var('GroupName', '');
	$this->guest_data['allow_post'] = strtoupper(request_var('AllowPost', 'N'));
	$this->guest_data['allow_viewbill'] = strtoupper(request_var('AllowViewBill', 'N'));
	$this->guest_data['vip'] = strtoupper(request_var('VIP', 'N'));
	$this->guest_data['honeymoon'] = strtoupper(request_var('HoneyMoon', 'N'));
	$this->guest_data['room_share'] = strtoupper(request_var('RoomShare', 'N'));
	$this->guest_data['remark'] = request_var('Remark', '');

	if(empty($this->guest_data['room']) || empty($this->guest_data['resv_id']))
	{
	    $code = 220;
	    
	    return false;
	}
	
	//Get the old room
	$sql = 'SELECT room_name FROM ' . GUESTS_TABLE . " 
	    WHERE guest_reservation_id=" . $this->guest_data['resv_id'];
	$result = $db->sql_query($sql);
	$old_room = $db->sql_fetchfield('room_name');
	$db->sql_freeresult($result);
	
	// check room sharing
	$sql = 'SELECT COUNT(guest_reservation_id) AS total_guests
		FROM ' . GUESTS_TABLE . " WHERE room_name='" . $old_room . "'";

	$result = $db->sql_query($sql);
	$guest_count = (int) $db->sql_fetchfield('total_guests');
	$db->sql_freeresult($result);
	
	//echo '<p>*pms_checkin stamp*</p>';
	//print_r( $this->guest_data ); exit;
	//echo $this->guest_data['arrival_date']; exit;
	//echo 'data: ' . $this->guest_data['arrival_date']; exit;
 	//echo 'now: ' . time(); exit;
 	
	$sql_ary = array(
	    'guest_reservation_id'	=> (int) $this->guest_data['resv_id'],
	    'guest_arrival_date'	=> (int) $this->guest_data['arrival_date'],
	    'guest_firstname'		=> (string) $this->guest_data['first_name'],
	    'guest_lastname'		=> (string) $this->guest_data['last_name'],
	    'guest_fullname'		=> (string) $this->guest_data['fullname'],
	    'guest_salutation'		=> (string) $this->guest_data['salutation'],
	    'guest_group'		=> (int) $this->guest_data['group'],
	    'guest_groupname'		=> (string) $this->guest_data['group_name'],
	    'guest_language'		=> (string) $this->guest_data['language'],
	    'guest_allow_post'		=> (int) $this->guest_data['allow_post'],
	    'guest_allow_viewbill'	=> (int) $this->guest_data['allow_viewbill'],
	    'guest_vip'			=> (int) $this->guest_data['vip'],
	    'guest_honeymoon'		=> (int) $this->guest_data['honeymoon'],
	    'guest_room_share'		=> (int) $this->guest_data['room_share'],
	    'room_name'			=> (string) $this->guest_data['room'],
	);
	
	$sql = 'UPDATE ' . GUESTS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . " 
	    WHERE guest_reservation_id=" . $this->guest_data['resv_id'];
	$db->sql_query($sql);
	
	// set the old friend's room share status to false
	if( $guest_count > 1 )
	{
	    $sql = 'UPDATE ' . GUESTS_TABLE . " SET guest_room_share=0 
		WHERE room_name='" . $old_room . "'";
	    $db->sql_query($sql);
	    
	    //Reset room key
	    $sql = 'SELECT guest_reservation_id FROM ' . GUESTS_TABLE . "
		WHERE room_name='" . $old_room . "'";
	    
	    $result = $db->sql_query($sql);
	    $resv_id = $db->sql_fetchfield('guest_reservation_id');
	    $db->sql_freeresult($result);
	
	    $this->generate_room_key($resv_id, $old_room);
	
	}
	else
	{
	    $sql = 'UPDATE ' . ROOMS_TABLE . " SET room_key='' 
		WHERE room_name='" . $old_room . "'";
	    $db->sql_query($sql);
	}
	
	$sql = 'SELECT COUNT(guest_reservation_id) AS total_guests
		FROM ' . GUESTS_TABLE . " WHERE room_name='" . $this->guest_data['room'] . "'";

	$result = $db->sql_query($sql);
	$guest_count = (int) $db->sql_fetchfield('total_guests');
	$db->sql_freeresult($result);

	// set the new friend's room share status to true
	if( $guest_count > 1 )
	{
	    $sql = 'UPDATE ' . GUESTS_TABLE . " SET guest_room_share=1 
		WHERE room_name='" . $this->guest_data['room'] . "'";
	    $db->sql_query($sql);
	    
	}
	
	//Set room key
	$this->generate_room_key($this->guest_data['resv_id'], $this->guest_data['room']);
	
	$code = 0;
	return true;
    }
    
    function check_message($resv_id)
    {
		global $db, $config, $pms_config;
		
		if($resv_id != "") {
		$sql = "SELECT room_name FROM ".GUESTS_TABLE." WHERE guest_reservation_id = '".$resv_id."'";
		$result = $db->sql_query($sql);
		$room_name = $db->sql_fetchfield('room_name');
		
		// GET GUEST INFO FROM FOS
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $pms_config['url_request']."GetRoomStatus?RoomNo=".$room_name);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 2);
		$response = curl_exec($ch); 

		if(curl_errno($ch))
		{
			//print curl_error($ch);
			return false;
		}
		else
		{
			$xml = new SimpleXmlElement($response);	
			$j = 0;
			$message = array();
			foreach($xml as $item) {
				$message[0]['private'] = trim($item->RoomMessage);
				//$message[1]['private'] = 'test private message';
				$message[0]['group'] = trim($item->GroupMessage);
				//$message[1]['group'] = 'test group message'; //trim($item->GroupMessage);
				$j++;
			}
			
			for($i=0; $i<count($message); $i++) {
				
				$sql = "SELECT COUNT(*) AS total_entries FROM ".GUEST_MESSAGES_TABLE." WHERE guest_message_to = ".$resv_id." AND lower(guest_message_content) = '".strtolower($message[$i]['private'])."'";
				$result = $db->sql_query($sql);
				$total = $db->sql_fetchfield('total_entries');
				
				if($total == 0) {
					if(!empty($message[$i]['private'])) {
						$sql_ary = array(
						'guest_reservation_id'	=> 0,
						'guest_message_from'	=> (string) $config['hotel'],
						'guest_message_subject'	=> (string) $message[$i]['private'],
						'guest_message_content'	=> (string) $message[$i]['private'],
						'guest_message_date'	=> (int) time(),
						'room_name'				=> (string) $room_name,
						'guest_message_to'		=> (int) $resv_id,
						);
						
						$sql = 'INSERT INTO ' . GUEST_MESSAGES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
						$db->sql_query($sql);
						
					}
				}
				
				$sql = "SELECT COUNT(*) AS total_entries FROM ".GUEST_MESSAGES_TABLE." WHERE guest_message_to = ".$resv_id." AND lower(guest_message_content) = '".strtolower($message[$i]['group'])."'";
				$result = $db->sql_query($sql);
				$total = $db->sql_fetchfield('total_entries');
				
				if($total == 0) {
					if(!empty($message[$i]['group'])) {
						$sql_ary = array(
						'guest_reservation_id'	=> 0,
						'guest_message_from'	=> (string) $config['hotel'],
						'guest_message_subject'	=> (string) $message[$i]['group'],
						'guest_message_content'	=> (string) $message[$i]['group'],
						'guest_message_date'	=> (int) time(),
						'room_name'				=> (string) $room_name,
						'guest_message_to'		=> (int) $resv_id,
						);
						
						$sql = 'INSERT INTO ' . GUEST_MESSAGES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
						$db->sql_query($sql);
						
					}
				}
				
			}
			
			$db->sql_freeresult($result);
			curl_close($ch);
			
		}
		
		$sql = "SELECT COUNT(*) AS total_data FROM ".GUEST_MESSAGES_TABLE." WHERE guest_message_to = ".$resv_id." AND guest_message_read = 0";
		$result = $db->sql_query($sql);
		$total_data = $db->sql_fetchfield('total_data');
		//echo $sql; exit;
		if($total_data > 0) return true;
		else return false;
		} else {
			return false;
		}
	
    }

    function daily_occupancy(&$code='')
    {
	global $db;
	
	$this->guest_data['total_room'] = request_var('TotalRoom', '');
	$this->guest_data['non_paying_room'] = request_var('NonPayingRoom', '');
	$this->guest_data['date'] = $this->maketime(request_var('Date', ''));
	$this->guest_data['night_audit_time'] = $this->maketime(request_var('Time', ''));
    
	if(empty($this->guest_data['date']) || empty($this->guest_data['total_room']))
	{
	    $code = 220;
	    
	    return false;
	}
	
	$sql_ary = array(
	    'occupancy_daily_date'	=> (string) $this->guest_data['date'],
	    'occupancy_daily_totalroom'	=> (int) $this->guest_data['total_room'],
	    'occupancy_daily_nonpaying'	=> (int) $this->guest_data['non_paying_room'],
	    'occupancy_daily_time'	=> (int) $this->guest_data['night_audit_time'],
	);
	
	$sql = 'INSERT INTO ' . OCCUPANCY_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	
	//echo $sql; exit;
	$db->sql_query($sql);
	
	$code = 0;
	
	return true;
	
    }
    
    function daily_occupancy_detail(&$code='')
    {
	global $db;
	
	$this->guest_data['room'] = request_var('Room', '');
	$this->guest_data['guestname'] = request_var('GuestName', '');
	$this->guest_data['non_paying_room'] = request_var('NonPayingRoom', '');
	$this->guest_data['night_audit_time'] = $this->maketime(request_var('Time', ''));
	$this->guest_data['date'] = $this->maketime(request_var('Date', ''));
	
	$this->guest_data['non_paying_room'] = $this->guest_data['non_paying_room'] === 'Y' ? 1 : 0;
    
	if(empty($this->guest_data['date']) || empty($this->guest_data['room']))
	{
	    $code = 220;
	    
	    return false;
	}
	
	$sql_ary = array(
	    'occupancy_detail_guestname'=> (string) $this->guest_data['guestname'],
	    'occupancy_detail_room'	=> (string) $this->guest_data['room'],
	    'occupancy_detail_nonpaying'=> (int) $this->guest_data['non_paying_room'],
	    'occupancy_daily_date'	=> (string) $this->guest_data['date'],
	    'occupancy_daily_time'	=> (int) $this->guest_data['night_audit_time'],
	);
	
	$sql = 'INSERT INTO ' . OCCUPANCY_DETAIL_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	
	//echo $sql; exit;
	$db->sql_query($sql);
	
	$code = 0;
	
	return true;
    }
    
    function month_occupancy(&$code='')
    {
	global $db;
	
	$this->guest_data['total_room'] = request_var('TotalRoom', '');
	$this->guest_data['non_paying_room'] = request_var('NonPayingRoom', '');
	$this->guest_data['date'] = $this->maketime(request_var('Date', ''));
	$this->guest_data['night_audit_time'] = $this->maketime(request_var('Time', ''));
    
	if(empty($this->guest_data['date']) || empty($this->guest_data['total_room']))
	{
	    $code = 220;
	    
	    return false;
	}
	
	$sql_ary = array(
	    'occupancy_daily_date'	=> (string) $this->guest_data['date'],
	    'occupancy_daily_totalroom'	=> (int) $this->guest_data['total_room'],
	    'occupancy_daily_nonpaying'	=> (int) $this->guest_data['non_paying_room'],
	    'occupancy_daily_time'	=> (int) $this->guest_data['night_audit_time'],
	    'occupancy_daily_code'	=> (string) 'M',
	);
	
	$sql = 'INSERT INTO ' . OCCUPANCY_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	
	//echo $sql; exit;
	$db->sql_query($sql);
	
	$code = 0;
	
	return true;
    }
    
    function get_hotel_info()
    {
	global $pms_config, $pms_request;

	$url_request = $pms_config['url_request'] . '?Key=' . $pms_config['pms_userkey'] . 
		  '&Code=' .  $pms_request['hotel_info'];

	//echo file_get_contents($url_request); exit;
	// dummy data
	$url_request = $pms_config['url_request'] . $pms_request['hotel_info'] . '.xml';
	//echo $url_request; exit;
	// end dummy data

	//$xml = simplexml_load_file( $url_request ) or die('gagal! ' . $url_request);
	$xml = @simpleXML_load_file($url_request,"SimpleXMLElement",LIBXML_NOCDATA);
	
	if( !$xml )
	{
	    //exit('Failed to open >' . $url_request . '<');
	    $xml = array();
	    
	    return false;
	}
	else
	{
	    $this->info_data['error_code'] = (int) $xml->Status->attributes()->{'ErrorCode'};
	
	    if( $this->info_data['error_code'] != 0 )
	    {
		die('Cannot grab Hotel Info');
	    }
	    
	    $this->info_data['hotel_name'] = (string) $xml->Data->Record->HotelName;
	    $this->info_data['system_date'] = (string) $xml->Data->Record->SystemDate;
	    $this->info_data['current_shift'] = (string) $xml->Data->Record->CurrentShift;
	    $this->info_data['fax'] = (string) $xml->Data->Record->FaxNumber;
	    $this->info_data['phone'] = (string) $xml->Data->Record->Phone;
	    $this->info_data['email'] = (string) $xml->Data->Record->Email;
	    $this->info_data['address'] = (string) $xml->Data->Record->Address;
	}

	//echo 'name: ' . $this->info_data['hotel_name'] ; exit;
	//print_r( $this->info_data ); exit;
    
	return $this->info_data;
    }
    
    function get_pms_info()
    {
	global $pms_config;

	return $pms_config;
    }
    
    function get_profile()
    {
    
    }
    
    function get_guest_bill($resv_id, $room_name)
    {
	global $pms_config, $pms_request;
	
	$resv_id_str = (string) $resv_id;
	$a = strlen($resv_id_str);
	
	while ( $a < 8 ) {
	    $resv_id_str = '0' . $resv_id_str;
	    
	    $a++;
	}

	// GET GUEST BILL FROM FOS
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $pms_config['url_request']."GetRoomBillingInfo?RoomNo=".$room_name);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 2);
	$response = curl_exec($ch); 
	
	if(curl_errno($ch)) // jika koneksi ke PMS putus
	{
		return false;
	}
	else // jika koneksi ke PMS berhasil
	{
		$xml = new SimpleXmlElement($response);
		
	    $this->bill_data['bill_count'] = (int) count($xml->Entry);
	    $this->bill_data['total_credit'] = 0;
	    $this->bill_data['total_debit'] = 0;
	    
	    $i = 0;
	    
	    foreach($xml->Entry as $row)
	    {
		//echo '<font color="white">'.$row[8]->Amount.'<font>'; exit;
		$date = str_replace("-","",trim($row->Date));
		$datetime = $date.trim($row->Time);
		$amount = (int) $row->Amount;
		
		$this->bill_data[$i]['rec_id'] = (int) trim($row->RowNo);
		$this->bill_data[$i]['date'] = (int) $this->maketime($datetime);
		//$this->bill_data[$i]['category'] = (string) $row->Category;
		$this->bill_data[$i]['description'] = (string) trim($row->Description);
		//$this->bill_data[$i]['remark'] = (string) $row->Remark;
		//$this->bill_data[$i]['reference'] = (string) $row->Reference;
		$this->bill_data[$i]['currency'] = (string) $row->Currency;
		
		if($amount < 0) {
			$this->bill_data[$i]['credit'] = $amount;
			 $this->bill_data['credit'] += $this->bill_data[$i]['credit'];
		} else if($amount > 0) {
			$this->bill_data[$i]['debit'] = $amount;
			 $this->bill_data['debit'] += $this->bill_data[$i]['debit'];
		}
	//echo '<font color="#fff">debit:' .  $this->bill_data[$i]['debit'] . 'xx' . $this->bill_data['debit'] . '***' . 'credit:' .  $this->bill_data[$i]['credit'] .'xx' . $this->bill_data['credit'] .'<br>';	
		//$this->bill_data[$i]['balance'] = (string) $row->Balance;
		
		$this->bill_data[$i]['item'] = (string) trim($row->Description);
		/*
		if($amount < 0) {
			$this->bill_data['credit'] += (int) $amount;
		} else if($amount > 0) {
			$this->bill_data['debit'] += (int) $amount;
		}*/
//echo '<font color="white">'.$this->bill_data[$i]['debit'].' '.$this->bill_data[$i]['credit'].'<font>'; exit;
		//$this->bill_data['balance'] += (float) $row->Debit;
	    
		$i++;
	    }
	    //echo '<font color="white">'.$this->bill_data['debit'].' '.$this->bill_data['credit'].'<font>'; exit;
	    $this->bill_data['total_balance'] = (int) ($this->bill_data['debit'] + $this->bill_data['credit']);
	    //$this->bill_data['total_balance'] = $this->bill_data['balance'];
	}
	
	return true;
    }
	
	function get_room_list()
    {
	global $pms_config, $pms_request, $db;
	
	$sql = "SELECT COUNT(*) AS total_entries FROM ".ROOMS_TABLE." WHERE room_enabled = 1";
	$db->sql_query($sql);
	$total_data = $db->sql_fetchfield('total_entries');

	
	$sql2 = "SELECT * FROM ".ROOMS_TABLE." WHERE room_enabled = 1";
	$result = $db->sql_query($sql2);
	
	$this->room_data['room_count'] = $total_data;
	//$this->room_data['room_count'] = 1;
	   
	$i = 0;
	
	while($row = $db->sql_fetchrow($result))
	{
		
		// GET GUEST INFO FROM FOS
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $pms_config['url_request']."GetRoomStatus?RoomNo=".trim($row['room_name']));
		//curl_setopt($ch, CURLOPT_URL, $pms_config['url_request']."GetRoomStatus.xml");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 2);
		$response = curl_exec($ch); 

		if(curl_errno($ch))
		{
			//print curl_error($ch);
			return false;
		}
		else
		{ 
			$xml = new SimpleXmlElement($response);	
			$room_status = trim($xml->Entry->RoomStatusId); 	
			$roomNo = trim($xml->Entry->RoomNo);
			$guest_fullname = trim($xml->Entry->GuestName);
			
			//echo $roomNo.' - '.$row['room_name']. ' tes' . $guest_fullname; exit;
			//$this->room_data[$i]['rec_id'] = (int) $row->attributes()->{'id'};
			$this->room_data[$i]['room'] = (string) trim($xml->Entry->RoomNo);
			//$this->room_data[$i]['room_status'] = (string) $row->RoomStatus;
			//$this->room_data[$i]['connect_room'] = (string) $row->ConnectRoom;
			$this->room_data[$i]['resv_id'] = (int) $xml->Entry->FolioNo;
			//$this->room_data[$i]['arrival_date'] = (int) $this->maketime($row->ArrivalDate);
			//$this->room_data[$i]['first_name'] = (string) $row->FirstName;
			//$this->room_data[$i]['last_name'] = (string) $row->LastName;
			$this->room_data[$i]['full_name'] = (string) trim($xml->Entry->GuestName);
			$this->room_data[$i]['salutation'] = (string) $xml->Entry->Title;
			$this->room_data[$i]['language'] = trim($xml->Entry->DefLanguage);
			//$this->room_data[$i]['group'] = (string) $row->Group;
			$this->room_data[$i]['group_name'] = (string) $xml->Entry->GroupName;
			//$this->room_data[$i]['allow_post'] = (string) $row->AllowPost;
			//$this->room_data[$i]['allow_viewbill'] = (string) $row->AllowViewBill;
			//$this->room_data[$i]['vip'] = (string) $row->VIP;
			//$this->room_data[$i]['honeymoon'] = (string) $row->HoneyMoon;
			//$this->room_data[$i]['room_share'] = (string) $row->RoomShare;
			//$this->room_data[$i]['remark'] = (string) $row->Remark;

			//$i++;
			if(strcasecmp($this->room_data[$i]['language'], "INA") == 0) {
				$this->room_data[$i]['language'] = 'id';
			} else {
				$this->room_data[$i]['language'] = 'en';
			}
			
		}
		$i++;
	
		curl_close($ch);
		
	}
	//print_r($this->room_data); exit;
	//curl_close($ch);
	
	
	return true;
	
    }
    
    function _get_room_list()
    {
	global $pms_config, $pms_request;

	$url_request = $pms_config['url_request'] . '?Key=' . $pms_config['pms_userkey'] . 
		  '&Code=' .  $pms_request['room_list'];

	//echo file_get_contents($url_request); exit;
	// dummy data
	$url_request = $pms_config['url_request'] . $pms_request['room_list'] . '.xml';
	//echo $url_request; exit;
	// end dummy data

	//$xml = simplexml_load_file( $url_request ) or die('gagal! ' . $url_request);
	$xml = @simpleXML_load_file($url_request,"SimpleXMLElement",LIBXML_NOCDATA);
	
	if( !$xml )
	{
	    //exit('Failed to open >' . $url_request . '<');
	    $xml = array();
	    
	    return false;
	}
	else
	{
	    $this->room_data['room_count'] = (int) $xml->Data->attributes()->{'Count'};
	    
	    $i = 0;
	    
	    foreach($xml->Data->Record as $row)
	    {
	    //echo 'tes' . $row->ArrivalDate; exit;
		$this->room_data[$i]['rec_id'] = (int) $row->attributes()->{'id'};
		$this->room_data[$i]['room'] = (string) trim($row->Room);
		//$this->room_data[$i]['room_status'] = (string) $row->RoomStatus;
		$this->room_data[$i]['connect_room'] = (string) $row->ConnectRoom;
		$this->room_data[$i]['resv_id'] = (int) $row->ReservationID;
		$this->room_data[$i]['arrival_date'] = (int) $this->maketime($row->ArrivalDate);
		$this->room_data[$i]['first_name'] = (string) $row->FirstName;
		$this->room_data[$i]['last_name'] = (string) $row->LastName;
		$this->room_data[$i]['full_name'] = (string) $row->FullName;
		$this->room_data[$i]['salutation'] = (string) $row->Salutation;
		$this->room_data[$i]['language'] = (string) $row->Language;
		$this->room_data[$i]['group'] = (string) $row->Group;
		$this->room_data[$i]['group_name'] = (string) $row->GroupName;
		$this->room_data[$i]['allow_post'] = (string) $row->AllowPost;
		$this->room_data[$i]['allow_viewbill'] = (string) $row->AllowViewBill;
		$this->room_data[$i]['vip'] = (string) $row->VIP;
		$this->room_data[$i]['honeymoon'] = (string) $row->HoneyMoon;
		$this->room_data[$i]['room_share'] = (string) $row->RoomShare;
		//$this->room_data[$i]['remark'] = (string) $row->Remark;

		$i++;
	    }

	}
	
	return true;
	
    }
    
    
    function get_menu_item($menu_code='')
    {
	global $pms_config, $pms_request;

	// GET MENU ITEM FROM FOS
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $pms_config['url_request']."GetMenuList");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 2);
	$response = curl_exec($ch); 

	if(curl_errno($ch)) // jika koneksi dgn PMS putus
	{
	    //exit('Failed to open >' . $pms_config['url_request']."GetMenuList" . '<');
	    //$xml = array();
		return false;
	}
	else // jika koneksi berhasil
	{ 
	    $xml = new SimpleXmlElement($response);
	    $this->menu_data[0]['menu_count'] = (int) count($xml->Entry). ' ';
	    
	    $i = 0;
	    foreach($xml->Entry as $row)
	    {	
			if($row->ItemName != "") {	
				if($menu_code != "") { //echo 'a';exit;
					if(trim($row->ItemCode) == $menu_code) {
						$this->menu_data[0]['menu_id'] = (string) trim($row->ItemCode);
						$this->menu_data[0]['menu_name'] = (string) trim($row->ItemName);
						$this->menu_data[0]['description'] = (string) trim($row->TaxInfo);
						//$this->menu_data[$i]['signature'] = (string) $row->Signature;
						$this->menu_data[0]['price'] = (int) trim($row->Price);
						$this->menu_data[0]['tax_info'] = (string) $row->TaxInfo;
						$this->menu_data[0]['category_id'] = (string) trim($row->TypeId);
						$this->menu_data[0]['category_name'] = (string) trim($row->ItemCategory);
						$this->menu_data[0]['currency'] = (string) trim($row->Currency);
						$this->menu_data[0]['price_nett'] = (int) trim($row->PriceNett);
						
						$this->menu_data[0]['menu_match'] = 1;
					}
				} else { //echo 'b'; exit;
					$this->menu_data[$i]['menu_id'] = (string) trim($row->ItemCode);
					$this->menu_data[$i]['menu_name'] = (string) trim($row->ItemName);
					$this->menu_data[$i]['description'] = (string) trim($row->TaxInfo);
					//$this->menu_data[$i]['signature'] = (string) $row->Signature;
					$this->menu_data[$i]['price'] = (int) trim($row->Price);
					$this->menu_data[$i]['tax_info'] = (string) $row->TaxInfo;
					$this->menu_data[$i]['category_id'] = (string) trim($row->TypeId);
					$this->menu_data[$i]['category_name'] = (string) trim($row->ItemCategory);
					$this->menu_data[$i]['currency'] = (string) trim($row->Currency);
					$this->menu_data[$i]['price_nett'] = (int) trim($row->PriceNett);
					
					$this->menu_data[0]['menu_match'] = 1;
					$i++;
				}								


			} 

	    } 
		//print_r($this->menu_data);
		return true;
	}
    
	
    }

    function get_menu_item2($menu_id)
    {
	global $pms_config, $pms_request;

	// GET MENU ITEM FROM FOS
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $pms_config['url_request']."GetMenuList");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 1);
	$response = curl_exec($ch); 

	if(curl_errno($ch)) // jika koneksi dgn PMS putus
	{
	    //exit('Failed to open >' . $pms_config['url_request']."GetMenuList" . '<');
	    //$xml = array();
		return false;
	}
	else // jika koneksi berhasil
	{
		$xml = new SimpleXmlElement($response);
	    $this->menu_data['menu_count'] = (int) count($xml->Entry);
	    
	    $i = 0;
	    $j = 0;
	    foreach($xml->Entry as $row)
	    {	
			if(trim($row->ItemCode) == $menu_id) {
				$this->menu_data[$i]['menu_id'] = (string) trim($row->ItemCode);
				$this->menu_data[$i]['menu_name'] = (string) trim($row->ItemName);
				$this->menu_data[$i]['description'] = (string) trim($row->TaxInfo);
				//$this->menu_data[$i]['signature'] = (string) $row->Signature;
				$this->menu_data[$i]['price'] = (int) trim($row->Price);
				//$this->menu_data[$i]['unit'] = (string) $row->Unit;
				$this->menu_data[$i]['category_id'] = (string) trim($row->TypeId);
				$this->menu_data[$i]['category_name'] = (string) trim($row->TypeName);
				$this->menu_data[$i]['currency'] = (string) trim($row->Currency);
				
				$this->menu_data['menu_match'] = 1;
				$i++;
				break;
			} else {
				$this->menu_data['menu_match'] = 0;
				continue;
			}
			
			$j++;
	    } 
		return true;
	}
    
	
    }
    
    function get_shop_item($shop_id)
    {
    
    }
    
    function get_tour_item($tour_id)
    {
    
    }
    
    function get_spa_item($spa_id)
    {
    
    }
    
    function get_message_count($resv_id)
    {
    
    }
    
    function get_message_all($resv_id)
    {
		global $db;
    
		//Get message from Guest Message Table
		$sql = "SELECT guest_message_date, guest_message_from, room_name, replace(guest_message_subject,CHR(10),'<br/>') AS guest_message_subject, replace(guest_message_content,CHR(10),'<br/>') AS guest_message_content, guest_message_read FROM " . GUEST_MESSAGES_TABLE . " WHERE guest_message_to=$resv_id";
		//echo '<p>' . $sql; exit;
		$result = $db->sql_query($sql);

		$i = 0;
		
		while ($row = $db->sql_fetchrow($result))
		{
			$this->message_data[$i]['message_from'] = $row['room_name'] .' '. $row['guest_message_from'];
			$this->message_data[$i]['content'] = $row['guest_message_content'];
			$this->message_data[$i]['status'] = $row['guest_message_read'];
			$this->message_data[$i]['date'] = $row['guest_message_date'];
			
			$i++;
		}
		
		$sql = 'UPDATE ' . GUEST_MESSAGES_TABLE . " SET guest_message_read=1 WHERE guest_message_to=$resv_id";
		$db->sql_query($sql);

		//echo 'powerpro: ';print_r($this->message_data); exit;
		return true;
	}
    
    function send_message($resv_id, $room, $message)
    {
	global $pms_config, $pms_request;

	$url_request = $pms_config['url_request'] . '?Key=' . $pms_config['pms_userkey'] . 
		  '&Code=' .  $pms_request['send_message'] .
		  '&ReservationID=' .  $resv_id .
		  '&Room=' .  $room . 
		  '&Message=' .  $message;

	//echo file_get_contents($url_request); exit;
	// dummy data
	$url_request = $pms_config['url_request'] . $pms_request['menu_item'] . '.xml';
	//echo $url_request; exit;
	// end dummy data

	//$xml = simplexml_load_file( $url_request ) or die('gagal! ' . $url_request);
	$xml = @simpleXML_load_file($url_request,"SimpleXMLElement",LIBXML_NOCDATA);
	
	$error_code = 1;
	
	if( !$xml )
	{
	    $code = 220;
	    
	    return false;
	}
	
	return true;
    }
    
    function message_sync($resv_id)
    {
    
    }
	
	function pms_sync()
    {
	global $db;
	
	//Retrieve all In House data
	$pms_room = $this->get_room_list();
	
	if ( !$pms_room )
	{
	    echo 'Gagal sync om...'; exit;
	    return false;
	}
	//print_r($this->room_data); echo '<p>cort'; //exit;	//echo $this->room_data[0]['first_name'] . '<p>'; //exit////echo count($this->room_data) . '<p>'; //exit;
	
	// SET guest_sync_status OF EXISTING IN-HOUSE TO 1 FIRST
	
	$sql = 'UPDATE ' . GUESTS_TABLE . " SET guest_sync_status=1 WHERE guest_permanent=0";
	$db->sql_query($sql);
	//exit;
	// INSERT NEW FRESH DATA FROM HMS
	
	for ($i=0; $i < $this->room_data['room_count']; $i++)
	{
		$sql = "SELECT guest_arrival_date FROM ".GUESTS_TABLE." WHERE guest_reservation_id = ".$this->room_data[$i]['resv_id']."";
		$result = $db->sql_query($sql);
		$arrival_date = $db->sql_fetchfield('guest_arrival_date');		
	    
	    $this->room_data[$i]['group'] = $this->room_data[$i]['group'] === 'Y' ? 1 : 0;
	    $this->room_data[$i]['allow_post'] = $this->room_data[$i]['allow_post'] === 'Y' ? 1 : 0;
	    $this->room_data[$i]['allow_viewbill'] = $this->room_data[$i]['allow_viewbill'] === 'Y' ? 1 : 0;
	    $this->room_data[$i]['vip'] = $this->room_data[$i]['vip'] === 'Y' ? 1 : 0;
	    $this->room_data[$i]['honeymoon'] = $this->room_data[$i]['honeymoon'] === 'Y' ? 1 : 0;
	    $this->room_data[$i]['room_share'] = $this->room_data[$i]['room_share'] === 'Y' ? 1 : 0;
	    
	    if(!empty($this->room_data[$i]['resv_id'])) {	    
			$sql_ary = array(
			'guest_reservation_id'	=> (int) $this->room_data[$i]['resv_id'],
			'guest_arrival_date'	=> (!empty($arrival_date)) ? $arrival_date : time(), //(int) $this->room_data[$i]['arrival_date'],
			'guest_firstname'	=> (string) $this->room_data[$i]['first_name'],
			'guest_lastname'	=> (string) $this->room_data[$i]['last_name'],
			'guest_fullname'	=> (string) $this->room_data[$i]['full_name'],
			'guest_salutation'	=> (string) $this->room_data[$i]['salutation'],
			'guest_group'		=> (int) $this->room_data[$i]['group'],
			'guest_groupname'	=> (string) $this->room_data[$i]['group_name'],
			'guest_language'	=> (string) $this->room_data[$i]['language'],
			'guest_allow_post'	=> (int) $this->room_data[$i]['allow_post'],
			'guest_allow_viewbill'	=> (int) $this->room_data[$i]['allow_viewbill'],
			'guest_vip'		=> (int) $this->room_data[$i]['vip'],
			'guest_honeymoon'	=> (int) $this->room_data[$i]['honeymoon'],
			'guest_room_share'	=> (int) $this->room_data[$i]['room_share'],
			'room_name'		=> (string) $this->room_data[$i]['room'],
			'guest_connect_room'	=> (string) $this->room_data[$i]['connect_room'],
			);
		
			$sql = 'INSERT INTO ' . GUESTS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
			//echo $sql; exit;
			$db->sql_query($sql);
			//echo $sql; exit;
			//Set room key
			$this->generate_room_key($this->room_data[$i]['resv_id'], $this->room_data[$i]['room']);
	    }
	}
	
	// WIPE OUT guest_sync_status OF EXISTING IN-HOUSE
	$sql = 'DELETE FROM ' . GUESTS_TABLE . " 
	    WHERE guest_sync_status=1";
	$db->sql_query($sql);

	return true;
    }
    
    function _pms_sync()
    {
	global $db;
	
	//Retrieve all In House data
	$pms_room = $this->get_room_list();
	
	if ( !$pms_room )
	{
	    echo 'Gagal sync om...'; exit;
	    return false;
	}
	//print_r($this->room_data); echo '<p>cort'; //exit;	//echo $this->room_data[0]['first_name'] . '<p>'; //exit////echo count($this->room_data) . '<p>'; //exit;
	
	// SET guest_sync_status OF EXISTING IN-HOUSE TO 1 FIRST
	
	$sql = 'UPDATE ' . GUESTS_TABLE . " SET guest_sync_status=1 WHERE guest_permanent=0";
	$db->sql_query($sql);
	//exit;
	// INSERT NEW FRESH DATA FROM HMS
	
	for ($i=0; $i < $this->room_data['room_count']; $i++)
	{
	    
	    $this->room_data[$i]['group'] = $this->room_data[$i]['group'] === 'Y' ? 1 : 0;
	    $this->room_data[$i]['allow_post'] = $this->room_data[$i]['allow_post'] === 'Y' ? 1 : 0;
	    $this->room_data[$i]['allow_viewbill'] = $this->room_data[$i]['allow_viewbill'] === 'Y' ? 1 : 0;
	    $this->room_data[$i]['vip'] = $this->room_data[$i]['vip'] === 'Y' ? 1 : 0;
	    $this->room_data[$i]['honeymoon'] = $this->room_data[$i]['honeymoon'] === 'Y' ? 1 : 0;
	    $this->room_data[$i]['room_share'] = $this->room_data[$i]['room_share'] === 'Y' ? 1 : 0;
	    
	    $sql_ary = array(
		'guest_reservation_id'	=> (int) $this->room_data[$i]['resv_id'],
		'guest_arrival_date'	=> (int) $this->room_data[$i]['arrival_date'],
		'guest_firstname'	=> (string) $this->room_data[$i]['first_name'],
		'guest_lastname'	=> (string) $this->room_data[$i]['last_name'],
		'guest_fullname'	=> (string) $this->room_data[$i]['full_name'],
		'guest_salutation'	=> (string) $this->room_data[$i]['salutation'],
		'guest_group'		=> (int) $this->room_data[$i]['group'],
		'guest_groupname'	=> (string) $this->room_data[$i]['group_name'],
		'guest_language'	=> (string) $this->room_data[$i]['language'],
		'guest_allow_post'	=> (int) $this->room_data[$i]['allow_post'],
		'guest_allow_viewbill'	=> (int) $this->room_data[$i]['allow_viewbill'],
		'guest_vip'		=> (int) $this->room_data[$i]['vip'],
		'guest_honeymoon'	=> (int) $this->room_data[$i]['honeymoon'],
		'guest_room_share'	=> (int) $this->room_data[$i]['room_share'],
		'room_name'		=> (string) $this->room_data[$i]['room'],
		'guest_connect_room'	=> (string) $this->room_data[$i]['connect_room'],
	    );
	
	    $sql = 'INSERT INTO ' . GUESTS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	    //echo $sql; exit;
	    $db->sql_query($sql);
	    //echo $sql; exit;
	    //Set room key
	    $this->generate_room_key($this->room_data[$i]['resv_id'], $this->room_data[$i]['room']);

	}
	
	// WIPE OUT guest_sync_status OF EXISTING IN-HOUSE
	$sql = 'DELETE FROM ' . GUESTS_TABLE . " 
	    WHERE guest_sync_status=1";
	$db->sql_query($sql);

	return true;
    } 

  	function roomservice_sync()
    {
	global $pms_config, $pms_request, $db;

	// GET MENU ITEM FROM FOS
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $pms_config['url_request']."GetMenuList");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	$response = curl_exec($ch); 

	if(curl_errno($ch)) // jika koneksi dgn PMS putus
	{
	    exit('Failed to open >' . $pms_config['url_request']."GetMenuList" . '<');
	    //$xml = array();
		return false;
	}
	else // jika koneksi berhasil
	{
		$sqlUpdate = "UPDATE ".SERVICES_TABLE." SET service_enabled = 2";
		$db->sql_query($sqlUpdate);
 
		$xml = new SimpleXmlElement($response);
		//print_r($xml->Entry); exit;
		foreach($xml->Entry as $row) { 
			//check data roomservice
			$sql = "SELECT COUNT(*) AS total_entries FROM ".SERVICES_TABLE." WHERE service_code = '".trim($row->ItemCode)."'";
			$db->sql_query($sql);
			$total_data = $db->sql_fetchfield('total_entries');

			if($total_data > 0) {
				$sql = "SELECT service_id FROM ".SERVICES_TABLE." WHERE service_code = '".trim($row->ItemCode)."'";
				$db->sql_query($sql);
				$service_id = $db->sql_fetchfield('service_id');
			}
			
			//check data roomservice group
			$sql = "SELECT COUNT(*) AS total_entries_group FROM ".SERVICE_GROUPS_TABLE." s 
					JOIN ".SERVICE_GROUP_TRANSLATIONS_TABLE." t ON s.service_group_id = t.service_group_id
					WHERE lower(t.translation_title) = '".htmlspecialchars(strtolower(trim($row->ItemCategory)))."'";
			$db->sql_query($sql);
			$total_group = $db->sql_fetchfield('total_entries_group');
			
			if($total_group > 0) {
				$sql = "SELECT s.service_group_id FROM ".SERVICE_GROUPS_TABLE." s 
						JOIN ".SERVICE_GROUP_TRANSLATIONS_TABLE." t ON s.service_group_id = t.service_group_id
						WHERE lower(t.translation_title) = '".htmlspecialchars(strtolower(trim($row->ItemCategory)))."'";
				//echo $sql.'<br>';
				$result = $db->sql_query($sql);
				while($row1 = $db->sql_fetchrow($result)) {
					$group_id = $row1['service_group_id'];
				}
			} else {
				$group_id = 1;
			}

			//if(strtolower(trim($row->TypeName)) == "F") $group_id = 1;
			//else if($row->TypeId == "B") $group_id = 2;

			if($total_data == 0) {
				$sql_ary = array(
				'service_order'		=> 0,
				'service_enabled'	=> 1,
				'service_allow_ads'	=> 0,
				'service_price'		=> (int) trim($row->Price),
				'service_thumbnail'	=> '',
				'service_group_id'	=> (int) $group_id,
				'service_code'		=> (string) trim($row->ItemCode),
				'service_updated'	=> (int) 1,
				'service_currency'	=> (string) trim($row->Currency),
			     );

				$sql = 'INSERT INTO ' . SERVICES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
				//echo $sql; exit;
				$db->sql_query($sql);
				$rid = $db->sql_nextid();
	
				$sql2 = "SELECT * FROM languages WHERE language_enabled = 1";
				$result2 = $db->sql_query($sql2);
				while($row2 = $db->sql_fetchrow($result2)) {
					$sql_translation = array(
					'service_id'			=> (int) $rid,
					'translation_title'		=> (string) trim($row->ItemName),
					'translation_description'	=> '',
					'language_id'			=> $row2['language_id'],
					);

					$sql = 'INSERT INTO ' . SERVICE_TRANSLATIONS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_translation);
					$db->sql_query($sql);
				}
			} else {
				$sql_ary = array(
				'service_price'		=> (int) trim($row->Price),
				'service_currency'	=> (string) trim($row->Currency),
				'service_group_id'	=> (int) $group_id,
				'service_enabled'	=> 1,
			     );

				$sql = "UPDATE ".SERVICES_TABLE." SET ".$db->sql_build_array('UPDATE', $sql_ary) .
	    		" WHERE service_code = '".trim($row->ItemCode)."'";
				$db->sql_query($sql);
				//echo $sql.'<br>'; 
				
				$sql2 = "SELECT * FROM languages WHERE language_enabled = 1";
				$result2 = $db->sql_query($sql2);
				while($row2 = $db->sql_fetchrow($result2)) {
					$sql_translation = array(
					'translation_title'		=> (string) trim($row->ItemName),
					);

					$sql = "UPDATE ".SERVICE_TRANSLATIONS_TABLE." SET ".$db->sql_build_array('UPDATE', $sql_translation) .
					" WHERE service_id = '".$service_id."' AND language_id = '".$row2['language_id']."'";
					//echo $sql; exit;
					$db->sql_query($sql);
				}
			}
			
			$sqlUpdate2 = "UPDATE ".SERVICES_TABLE." SET service_enabled = 0 WHERE service_enabled = 2";
	                $db->sql_query($sqlUpdate2);
		}

		
	}
	return true;
    }
    
    function post_charge($values)
    {
	global $pms_config, $pms_request, $db;
	
	if( !is_array($values) )
	{
	    $code = 220;
	    
	    return false;
	}
	
	if ( empty($values['service_id']) )
	{
	    return true;
	}
	
	// Count Service Item
	$sql = 'SELECT COUNT(guest_services_detail_id) AS total_entries 
	    FROM ' . GUEST_SERVICES_DETAIL_TABLE . " WHERE guest_service_id=" . $values['service_id'];

	$result = $db->sql_query($sql);
	$service_count = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
	
	if ( $service_count < 1 )
	{
	    return true;
	}
	
	$sql = 'SELECT * FROM ' . GUEST_SERVICES_DETAIL_TABLE . ' WHERE guest_service_id=' . $values['service_id'];
	$result = $db->sql_query($sql);
	
	$i = 1;
	$reference = time();
	while ($row = $db->sql_fetchrow($result))
	{	  
		$url = $pms_config['url_request']."SetRoomServiceOrderItem";
		//$url = "http://192.168.0.14/testing/xmlpost/orderdata.php";
		$url .= "?RoomNo=" . urlencode($values['room_name']);
		$url .= "&ItemCode=" . urlencode($row['guest_service_code']);
		$url .= "&ItemName=" . urlencode($row['guest_service_item']);
		$url .= "&Qty=" . urlencode($row['guest_service_qty']);
		$url .= "&ReferenceNo=" . urlencode($reference);
		$url .= "&SpecialRequest=" . urlencode($row['guest_service_note']);
		//echo $url; 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		$response = curl_exec($ch); 
		
		
		
		if(curl_errno($ch))
		{
			//print curl_error($ch);
		}
		else
		{	
			$xml = new SimpleXmlElement($response);
			
			curl_close($ch);
		}
	    
	    $i++;	
	}
	
	// Send Order Confirm to FOS
	$url = $pms_config['url_request']."SetRoomServiceOrderConfirm";
	//$url = "http://192.168.0.14/testing/xmlpost/orderdata.php";
	$url .= "?RoomNo=" . urlencode($values['room_name']);
	$url .= "&ReferenceNo=" . urlencode($reference);
	//echo $url; exit;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
	curl_setopt($ch, CURLOPT_TIMEOUT, 3);
	$confirm_response = curl_exec($ch); 
		
	$xml = new SimpleXmlElement($confirm_response);
		
	if(curl_errno($ch))
	{
		//print curl_error($ch);
	}
	else
	{
		curl_close($ch);
	}
	
	return true;
    }
    
    function room_status_update($values)
    {
    global $pms_config, $pms_request;

	if( !is_array($values) )
	{
	    $code = 220;
	    
	    return false;
	}
	
	$url = $pms_config['url_request']."SetRoomStatusHousekeeping"; 
	$url .= "?RoomNo=" . urlencode($values['room_name']);
	$url .= "&StatusCode=" . urlencode($values['new_status']);
	$url .= "&UserIdHousekeeper=IPTV";
    	//echo '<font color="#fff">'.$url.'</font>'; exit;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 2);
	$response = curl_exec($ch); 
		
	if(curl_errno($ch))
	{
		//print curl_error($ch);
	}
	else
	{
		$xml = new SimpleXmlElement($response);
		curl_close($ch);
	}
    
	return true;
    }
    
    function generate_status_combo()
    {
    global $pms_config;
	
	// GET ROOM STATUS HOUSEKEEPING FROM FOS
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $pms_config['url_request']."GetRoomStatusHousekeepingList");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 2);
	$response = curl_exec($ch); 
	
	$room_status = '<select name="code">';
	
	if(curl_errno($ch)) // jika koneksi ke PMS putus
	{
		for($i=0; $i < count($pms_config['room_status']); $i++)
		{
			$room_status .= '<option value="' . $pms_config['room_status'][$i] . '" >' . $pms_config['room_status'][$i] . '</option>';
		}
	}
	else // jika koneksi ke PMS berhasil
	{
		$xml = new SimpleXmlElement($response); 
	
		foreach($xml->Entry as $row)
		{
			$room_status .= '<option value="' . $row->StatusCode . '" >' . $row->StatusName . '</option>';
		}
	}
	
	$room_status .= '</select>';
		
	return $room_status;
    }
    
    function pms_echo($var='Navicom-FOS test...')
    {
	echo '<center> >'.$var.'< </center>';
	return;
    }
    
    function send_reply_message($code)
    {
	global $pms_error_code;
	
	header("Content-type: text/xml");
	echo "<?xml version='1.0' encoding='UTF-8'?>";
	echo "<PINS_APIResponse>\n\t\t";
	echo "<Status ErrorCode=\"" . $code ."\">\n\t\t\t\t";
	echo "<Message>" . $pms_error_code[$code] . "</Message>\n\t\t";
	echo "</Status>\n";
	echo "</PINS_APIResponse>";
    }

        
    function maketime($datetime_int)
    {
	// yyyymmdd
	$year = substr($datetime_int, 0, 4);
	$month = substr($datetime_int, 4, 2);
	$date = substr($datetime_int, 6, 2);
	$hour = substr($datetime_int, 9, 2);
	$minute = substr($datetime_int, 12, 2);
    
	$datetime_int = mktime($hour, $minute, 0 , $month, $date, $year);
	
	return $datetime_int;
    }
    
}

?>
