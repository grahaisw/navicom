<?php

/*
* cron_epg.php
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
$datenow =  mktime(0, 0, 0, date("m"), date("d"), date("Y"));


	$sql = "select fids_flight, fids_remark, fids_jdate, fids_time from airport_fids where fids_remark in ('Last Call','Boarding', 'Second Call', 'Departed', 'Landed') and fids_timestamp = '".$datenow."'";
	// echo $sql;exit();
$result = $db->sql_query($sql);


while ($row = $db->sql_fetchrow($result)) {
	$fids_flight = $row['fids_flight'];
	$status = $row['fids_remark'];
	$jd = $row['fids_jdate'];
	$fids_time = $row['fids_time'];
	$title = $fids_flight.' - '.$status;
	$body = $fids_flight.' - '.$status.' - '.$fids_time;
	$data_array[0] = array(
							'data'	=> array(
								'c_message' => $body,
								'c_info' => 'delete_data00',
								'c_click_action'	=> 'STATUS_UPDATE',
								'c_title' => $title,	
							),
							'to'	=> '/topics/android'.$fids_flight.$jd,
							'priority' => 'high'
						);


	$data_array[1] = array(
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
							'to'	=> '/topics/ios'.$fids_flight.$jd
						);
}


for($i=0; $i<2; $i++) {

	header('Content-type: application/json');
					$json_data = json_encode($data_array[$i]);

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

					$logfile = "cronfids.log";
			                $fh = fopen($logfile, 'w') or die("can't open file");
					
					//if($i < 2) {
						$stringData = "Access curl : http://fcm.googleapis.com/fcm/send \r\n";
						//fwrite($fh, $stringData);
					//}
					
					$err = curl_error($curl);

					curl_close($curl);

					if ($err) {
						//if($i < 2) {
							$stringData = 'cURL Error : '.$err." \r\n";
							//fwrite($fh, $stringData);
						//}
					} else {
					  //echo $response;
					}
}

// echo $stringData;


 $output = date("Y-m-d H:i:s")." : ".$stringData."  \n";
fwrite($fh, $output);
// echo $output;
?>
