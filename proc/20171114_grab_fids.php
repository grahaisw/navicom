<?php
/**
*
* proc/grab_fids.php
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

$sql = 'SELECT airport_id, airport_code FROM ' . AIRPORTS_TABLE . ' WHERE airport_enabled = 1' ;
$result = $db->sql_query($sql);
//echo 'crot<p>' . $sql;
$data = array();
$flights = array();

while ($row = $db->sql_fetchrow($result))
{
    /*$url_request = $config['fids_server'] . 
		      '?key=' . $config['fids_key'] . 
		      '&id=' . $row['airport_code'] . 
		      '&format=' . $config['fids_data_format'];
    */
    switch( $config['fids_data_format'] )
    {
	case 'xml':
	    //dummy data
	    $url_request = $config['fids_server'] . 'fids.xml';
	    
	    $xml = @simpleXML_load_file($url_request,"SimpleXMLElement",LIBXML_NOCDATA);
	
	    if( !$xml )
	    {
			//exit('Failed to open >' . $url_request . '<');
			$xml = array();
	    }
	    else
	    {
			$airport_code = $xml->Airport->Code;
			
			$data['departure_count'] = (int) $xml->Departure->attributes()->{'DataCount'};
			
			$sql_departure = "SELECT fids_flight, fids_remark FROM " . AIRPORT_FIDS_TABLE . " WHERE fids_type = ".$config['fids_departure_code'];
			$result_departure = $db->sql_query($sql_departure);
			$departure_flights = array();
			$departure_remarks = array();
			while($row_departure = $db->sql_fetchrow($result_departure)) {
				$departure_flights[] = $row_departure['fids_flight'];
				$departure_remarks[] = $row_departure['fids_remark'];
			}
			
			// delete airport fids from AIRPORT_FIDS_TABLE
			$sql = 'DELETE FROM ' . AIRPORT_FIDS_TABLE . ' WHERE airport_id=' . $row['airport_id'] . ' AND fids_type = '.$config['fids_departure_code'];
			$db->sql_query($sql);
			
			foreach( $xml->Departure->Record as $row_rec )
			{
				if(in_array($row_rec->FlightID, $departure_flights)) { 
					$key = array_search($row_rec->FlightID, $departure_flights); 
					
					if(strtoupper($row_rec->Remark) != strtoupper($departure_remarks[$key])) {
						$flights[] = $row_rec->FlightID;
					}
				}
				
				$sql_ary = array(
					'fids_flight' 		=> (string) $row_rec->FlightID,
					'airport_id'		=> (int) $row['airport_id'],
					'fids_airline_code'	=> (string) $row_rec->AirlineCode,
					'fids_airline' 		=> (string) $row_rec->Airline,
					'fids_city' 		=> (string) $row_rec->Destination,
					'fids_time' 		=> (string) $row_rec->Time,
					'fids_terminal' 	=> (string) $row_rec->Terminal,
					'fids_gate' 		=> (string) $row_rec->Gate,
					'fids_remark'		=> (string) $row_rec->Remark,
					'fids_type' 		=> (int) $config['fids_departure_code'],
					'fids_lastupdate'	=> (int) $xml->Status->attributes()->{'TimeStamp'},
				);
				
				$sql_insert = 'INSERT INTO ' . AIRPORT_FIDS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
				//echo $sql_insert; 
				$db->sql_query($sql_insert);
				
			}
			
			
			$data['arrival_count'] = (int) $xml->Arrival->attributes()->{'DataCount'};
			
			$sql_arrival = "SELECT fids_flight, fids_remark FROM " . AIRPORT_FIDS_TABLE . " WHERE fids_type = ".$config['fids_arrival_code'];
			$result_arrival = $db->sql_query($sql_departure);
			$arrival_flights = array();
			$arrival_remarks = array();
			while($row_arrival = $db->sql_fetchrow($result_arrival)) {
				$arrival_flights[] = $row_arrival['fids_flight'];
				$arrival_remarks[] = $row_arrival['fids_remark'];
			}
			
			// delete airport fids from AIRPORT_FIDS_TABLE
			$sql = 'DELETE FROM ' . AIRPORT_FIDS_TABLE . ' WHERE airport_id=' . $row['airport_id'] . ' AND fids_type = '.$config['fids_arrival_code'];
			$db->sql_query($sql);
			
			foreach( $xml->Arrival->Record as $row_rec )
			{
				if(in_array($row_rec->FlightID, $departure_flights)) { 
					$key = array_search($row_rec->FlightID, $departure_flights); 
					
					if(strtoupper($row_rec->Remark) != strtoupper($departure_remarks[$key])) {
						$flights[] = $row_rec->FlightID;
					}
				}
				
				$sql_ary = array(
					'fids_flight' 		=> (string) $row_rec->FlightID,
					'airport_id'		=> (int) $row['airport_id'],
					'fids_airline_code'	=> (string) $row_rec->AirlineCode,
					'fids_airline' 		=> (string) $row_rec->Airline,
					'fids_city' 		=> (string) $row_rec->Origin,
					'fids_time' 		=> (string) $row_rec->Time,
					'fids_terminal' 	=> (string) $row_rec->Terminal,
					'fids_gate' 		=> (string) $row_rec->Gate,
					'fids_remark'		=> (string) $row_rec->Remark,
					'fids_type' 		=> (int) $config['fids_arrival_code'],
					'fids_lastupdate'	=> (int) $xml->Status->attributes()->{'TimeStamp'},
				);
				
				$sql_insert = 'INSERT INTO ' . AIRPORT_FIDS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
		
				//echo $sql_insert; 
				$db->sql_query($sql_insert);
				
			}

	    }
	
	    break;
	
	
	
	case 'json':
	    //dummy data
	    $url_request = $config['fids_server'] . 'fids.json';
			      
	    //$parsed_json = json_decode($json_string); 
    
    
	    break;
    }
   
}

//print_r($flights); exit;

// Send notification if flight status/remark has changed
foreach($flights as $flight_id) {
	$sql = "SELECT * FROM " . AIRPORT_FIDS_TABLE . " WHERE fids_flight = '".$flight_id."'";
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	
	// Send notification to STB
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $config['API_server']."/fis.php?mode=flight_remark&code=".$config['fids_airport_code_default']."&flight=".$flight_id."&remark=".$row['fids_remark']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 2);
	$response = curl_exec($ch); 

	if(curl_errno($ch)) {
		//print curl_error($ch);
		return false;
	} else {
		//echo $response;
	}
	
	
	// Send notification to APPS
	/*$title = $flight_id.' - '.$row['fids_remark'];
	$body = $flight_id.' - '.$row['fids_remark'].' - '.$row['fids_time'];
	
	$data_array = array(
			'notification'	=> array(
				'title'	=> $title,
				'body'	=> $body,
				'sound'	=> 'default',
				'click_action'	=> 'ALERT_ACTIVITY',
			),
			'data'	=> array(
				'extra_information' => $body,
			),
			'to'	=> '/topics/'.$flight_id
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
	  echo $response;
	}
	*/
}

unset($data);
unset($xml);

$db->sql_freeresult($result);

?>