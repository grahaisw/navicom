<?php
/**
*
* API/apps.php
*
* Agnes Emanuella. Oct 2017
*/

/**
* 
*/

define('IN_TONJAW', true);
define('NEED_SID', true);
//echo 'check_in jalan...'; exit;
$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './../';
$phpEx = substr(strrchr($_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr($_SERVER['PHP_SELF'], '/'), 1));
//echo $file[0].'.'.$phpEx;

require($tonjaw_root_path . 'common.' . $phpEx);

$mode = $_GET['mode'];
switch($mode) {
	case $pms_event['subscribe']:
	
	$success = $pms->subscribe();
	echo $success;
	break;
	
	case $pms_event['fids']:
	
	$success = $pms->fids();
	echo $success;
	break;
	
	case $pms_event['live']:
	
	$success = $pms->live();
	echo $success;
	break;

	case $pms_event['delete']:

        $success = $pms->delete();
        echo $success;
        break;

			
}
/*if($mode == "subscribe") {
	echo $_GET['FlightNo'].' '.$_GET['PassengerName'].' '.$_GET['SeatNo'].' '.$_GET['AirportCode'];
} else if($mode == "fids") {
	
	//echo $_GET['code'];
	
	$node[0] = array (
		'FlightID' 			=> 'GA 712',
		'AirlineCode'		=> 'GA',
		'Airline'			=> 'Garuda Indonesia',
		'Origin'			=> '',
		'Destination'		=> 'Jakarta CGK',
		'Time'				=> '00:10',
		'Terminal'			=> '2',
		'Gate'				=> '2',
		'Remark'			=> 'Landed',
		'Type'				=> 'Departure',
	);
	$node[1] = array (
		'FlightID' 			=> 'JT 300',
		'AirlineCode'		=> 'JT',
		'Airline'			=> 'Lion Air',
		'Origin'			=> 'Denpasar',
		'Destination'		=> '',
		'Time'				=> '01:15',
		'Terminal'			=> '1',
		'Gate'				=> 'E',
		'Remark'			=> 'Boarding',
		'Type'				=> 'Arrival',
	);
	$node[2] = array (
                'FlightID'                      => 'KT 300',
                'AirlineCode'           => 'JT',
                'Airline'                       => 'Sriwijaya Air',
                'Origin'                        => 'Bandung',
                'Destination'           => '',
                'Time'                          => '01:15',
                'Terminal'                      => '1',
                'Gate'                          => 'E',
                'Remark'                        => 'Boarding',
                'Type'                          => 'Arrival',
        );
	$node[3] = array (
                'FlightID'                      => 'JT 300',
                'AirlineCode'           => 'JT',
                'Airline'                       => 'Batik Air',
                'Origin'                        => '',
                'Destination'           => 'Denpasar',
                'Time'                          => '01:15',
                'Terminal'                      => '1',
                'Gate'                          => 'E',
                'Remark'                        => 'Boarding',
                'Type'                          => 'Departure',
        );
	$node[4] = array (
                'FlightID'                      => 'JT 400',
                'AirlineCode'           => 'JT',
                'Airline'                       => 'Lion Air',
                'Origin'                        => 'Surabaya',
                'Destination'           => '',
                'Time'                          => '01:15',
                'Terminal'                      => '2',
                'Gate'                          => 'E',
                'Remark'                        => 'Boarding',
                'Type'                          => 'Arrival',
        );
	$node[5] = array (
                'FlightID'                      => 'JT 369',
                'AirlineCode'           => 'JT',
                'Airline'                       => 'Lion Air',
                'Origin'                        => 'Medan',
                'Destination'           => '',
                'Time'                          => '01:15',
                'Terminal'                      => '1',
                'Gate'                          => 'E',
                'Remark'                        => 'Boarding',
                'Type'                          => 'Arrival',
        );
	$node[6] = array (
                'FlightID'                      => 'JH 500',
                'AirlineCode'           => 'JH',
                'Airline'                       => 'Batik Air',
                'Origin'                        => '',
                'Destination'           => 'Denpasar',
                'Time'                          => '01:15',
                'Terminal'                      => '1',
                'Gate'                          => 'E',
                'Remark'                        => 'Boarding',
                'Type'                          => 'Departure',
        );
	$node[7] = array (
                'FlightID'                      => 'KW 300',
                'AirlineCode'           => 'KW',
                'Airline'                       => 'Lion Air',
                'Origin'                        => '',
                'Destination'           => 'Denpasar',
                'Time'                          => '01:15',
                'Terminal'                      => '1',
                'Gate'                          => 'E',
                'Remark'                        => 'Boarding',
                'Type'                          => 'Departure',
        );
	$node[8] = array (
                'FlightID'                      => 'TK 870',
                'AirlineCode'           => 'TK',
                'Airline'                       => 'Lion Air',
                'Origin'                        => '',
                'Destination'           => 'Denpasar',
                'Time'                          => '01:15',
                'Terminal'                      => '1',
                'Gate'                          => 'E',
                'Remark'                        => 'Boarding',
                'Type'                          => 'Departure',
        );
	$data = array(
		'Status' => array(
				'attributes'	=> array(
					'ErrorCode'	=> 0,
					'TimeStamp'	=> time(),
				),
				'Message'		=> 'OK',			
				),
		'Airport' => array(
				'Name'	=> 'Sultan Hasanudin International Airportsssss',
				'Code'	=> 'UPG',
				'City'	=> 'Makassar',
				'State'	=> 'Sulawesi Selatan',
				'Country'	=> 'Indonesia',
				'Phone'		=> '+62 361 800000',			
				),
		'Record' => $node,
		
	);
	header('Content-type: application/json');	
	$json_data = json_encode($data);
	
	echo $json_data;
}

$success = $pms->info();
*/
//echo $success;

//$pms->get_info();
//$code = 'Event=' . $event . ' - ' . 'Room=' . $old . ' - ' . 'MoveTo=' . $new . ' - ' . 'ResvID=' . $resv_id;

//$pms->send_reply_message($code);
//$pms->pms_echo($event);
unset($db);
unset($pms);


?>
