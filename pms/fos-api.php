#!/usr/bin/php -q
<?php

/*
* fos-api.php
*/

define('IN_TONJAW', true);

$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : '../';
$phpEx = substr(strrchr( $_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr( $_SERVER['PHP_SELF'], '/'), 1));

include($tonjaw_root_path . 'config.php');

// don't timeout!
set_time_limit(0);

require($tonjaw_root_path . 'common.' . $phpEx);
//require($tonjaw_root_path . 'fe_common.' . $phpEx);	
//require($tonjaw_root_path . 'includes/session.php');
//require($tonjaw_root_path . 'includes/db/postgres.php');
//require($tonjaw_root_path . 'includes/functions.php');
//require($tonjaw_root_path . 'includes/constants.php');
require($tonjaw_root_path . 'pms/fos.php');
//require_once('common_pms.php');

//$db	= new dbal_postgres();
// Connect to DB
//$db->sql_connect($dbhost, $dbuser, $dbpasswd, $dbname, $dbport, false, false);

$pms = new pmsal_fos();

// We do not need this any longer, unset for safety purposes
//unset($dbpasswd);
$i=1;
while (true)
{
    $sql = "SELECT * FROM rooms WHERE room_enabled = 1 ORDER BY room_name";
	$result = $db->sql_query($sql);
	while($row = $db->sql_fetchrow($result)) {
		// GET ROOM STATUS FROM FOS
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $pms_config['url_request']."GetRoomStatus?RoomNo=".trim($row['room_name']));
		//curl_setopt($ch, CURLOPT_URL, $pms_config['url_request']."GetRoomStatus".$i.".xml");
		
		//echo $pms_config['url_request']."GetRoomStatus?RoomNo=".$room_name; exit;
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 2);
		$response = curl_exec($ch);
	
		if(!curl_errno($ch)) { // jika koneksi ke PMS berhasil
			$xml = new SimpleXmlElement($response);
			$room_status = trim($xml->Entry->RoomStatusId); 	
			$roomNo = trim($xml->Entry->RoomNo);
			$guest_fullname = trim($xml->Entry->GuestName);
			$room_name = trim($row['room_name']);
			echo 'Room: '.$roomNo.' - '.$room_name.', Status: '.$room_status.' \n';
			if($roomNo == 'xxxx') {
				/*$lock = request_var('lock',0);

				if(empty($lock))
				{
				redirect('lock.'.$phpEx . '?lock=1');
				}*/
			}
			if(empty($roomNo)) { echo 'b';
				$guests_name = get_guests($room_name);

					if ( !empty(trim($guests_name[0]['resv_id'])) && !$config['lock_on_empty_room'] && defined('BYPASS_LOCK'))
					{ // jika tidak ada response RoomNo dari FOS,tapi di DB room tsb masih ter-checkin

						//require($tonjaw_root_path . $config['pms_path'] . 'common_pms.' . $phpEx);
						$pms->checkout($xml);

					} 
					/*
					$lock = request_var('lock',0);
					
					if(empty($lock))
					{
					redirect('lock.'.$phpEx . '?lock=1');
					}
					*/
			}

			curl_close($ch);
			
			if($roomNo == $room_name) {
				
				$sql1 = "SELECT COUNT(*) AS total_data FROM guests WHERE room_name = '".$room_name."'";
				$results = $db->sql_query($sql1);
				$count = $db->sql_fetchfield('total_data');
				echo $count.' ** '.$room_status.'\n ';
				$guests_name = get_guests($room_name);
				
				//require($tonjaw_root_path . $config['pms_path'] . 'common_pms.' . $phpEx);
				//$pms->checkout($xml);
				
				if($room_status == 1 && $count == 0) { //echo '..c '; // blm ter-checkin di IPTV
					echo 'cekin sukses \n';
					//require($tonjaw_root_path . $config['pms_path'] . 'common_pms.' . $phpEx);	
					$pms->checkin($xml);	
				} else if($room_status == 1 && $count > 0) { //echo '..d ';
					$fullname = $guests_name[0]['fullname'];
					$old_resv_id = $guests_name[0]['resv_id'];
					
					if($guest_fullname != $fullname) { //echo '..f ';
						//require($tonjaw_root_path . $config['pms_path'] . 'common_pms.' . $phpEx);
							$pms->checkout($xml,$code,$old_resv_id);
					}	
				} else if($room_status == 0) { //echo '..e ';
					if($count > 0) { // blm ter-checkout di IPTV
						//require($tonjaw_root_path . $config['pms_path'] . 'common_pms.' . $phpEx);
						$pms->checkout($xml);
					}
					if ( (empty($guests_name) || empty($guests_name[0]['resv_id'])) && $config['lock_on_empty_room'] && !defined('BYPASS_LOCK'))
					{
						/*$lock = request_var('lock',0);
						
						if(empty($lock))
						{
						redirect('lock.'.$phpEx . '?lock=1');
						}*/
						
					}
				}
			}
		} else { 
			//continue;
			echo 'blong \n'; //exit;
		}
		unset($room_name);
		unset($room_status);
		unset($results);
		unset($sql1);
		
		$i++;
	}
	//exit;
	// Take a rest for a while
    sleep(30);
}

function get_guests($room_name) {
	global $db;

	$sql = "SELECT r.room_name, n.node_name, g.guest_reservation_id, g.guest_firstname, g.guest_lastname, g.guest_fullname, g.guest_salutation, g.guest_groupname, g.guest_room_share, r.room_key, g.guest_language FROM guests g
        JOIN rooms r ON r.room_name=g.room_name
        JOIN nodes n ON n.room_id=r.room_id
        WHERE  r.room_name='".$room_name."'";
	$result = $db->sql_query($sql);
	$i = 0;
    $guests_data = array();
    while ($row = $db->sql_fetchrow($result))
    {
	$guests_data[$i] = array(
	    'resv_id'		=> $row['guest_reservation_id'],
	    'firstname'		=> $row['guest_firstname'],
	    'lastname'		=> $row['guest_lastname'],
	    'fullname'		=> $row['guest_fullname'],
	    'salutation'	=> $row['guest_salutation'],
	    'groupname'		=> $row['guest_groupname'],
	    'room'		=> $row['room_name'],
	    'node'		=> $row['node_name'],
	    'room_share'	=> $row['guest_room_share'],
	    'room_key'		=> $row['room_key'],
	    //'language'	=> strtolower($row['guest_language']),
	    'language'		=> strtolower(substr($row['guest_language'], 0,2)),
	);

	$i++;
    }
	return $guests_data;
}
?>
