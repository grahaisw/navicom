<?php
/**
*
* pms/rhapsody.php
*
* Roberto Tonjaw. Oct 2014
*/

/**
* 
*/
if (!defined('IN_TONJAW'))
{
	die('Hacking Attempt');
}

include_once($tonjaw_root_path . $config['pms_path'] . 'pmsal.' . $phpEx);

$pms_event['event'] 		= 'Event';
$pms_event['check_in'] 		= 'CHECKIN';
$pms_event['check_out']		= 'CHECKOUT';
$pms_event['room_change'] 	= 'ROOMCHANGE';
$pms_event['guest_change']	= 'GUESTCHANGE';
$pms_event['message']		= 'MSG';
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

$pms_config['pms_name'] = 'Realta Rhapsody';
$pms_config['pms_version'] = 'n/a';
$pms_config['pms_vendor'] = 'PT. Realta Chakradarma';
$pms_config['pms_website'] = 'www.realta.co.id';

$pms_config['room_status'][0] = 'CLEAN';
$pms_config['room_status'][1] = 'DIRTY';
$pms_config['room_status'][2] = 'READY';


/**
* Realta Rhapsody Abstraction Layer
* Developed on Navicom IPTV
* @package pmsal
*/
class pmsal_rhapsody extends pmsal
{
    var $guest_data = array();
    var $info_data = array();
    var $bill_data = array();
    var $message_data = array();
    var $room_data = array();
    var $menu_data = array();

    function checkin(&$code='')
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
	
	$this->guest_data['group'] = $this->guest_data['allow_post'] === 'Y' ? 1 : 0;
	$this->guest_data['allow_post'] = $this->guest_data['allow_post'] === 'Y' ? 1 : 0;
	$this->guest_data['allow_viewbill'] = $this->guest_data['allow_viewbill'] === 'Y' ? 1 : 0;
	$this->guest_data['vip'] = $this->guest_data['vip'] === 'Y' ? 1 : 0;
	$this->guest_data['honeymoon'] = $this->guest_data['honeymoon'] === 'Y' ? 1 : 0;
	$this->guest_data['room_share'] = $this->guest_data['room_share'] === 'Y' ? 1 : 0;
	
	//$get_profile = $this->get_profile();

	
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
	    'guest_connect_room'	=> (string) $this->guest_data['connect_room'],
	);
	
	$sql = 'INSERT INTO ' . GUESTS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	
	//echo $sql; exit;
	$db->sql_query($sql);
	
	//Set room key
	$this->generate_room_key($this->guest_data['resv_id'], $this->guest_data['room']);

	$code = 0;
	return true;
    }
    
    function checkout(&$code='')
    {
	global $db;
	
	$this->guest_data['room'] = request_var('Room', '');
	$this->guest_data['resv_id'] = request_var('ReservationID', '');
	
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
    
    function check_message(&$code='')
    {
	global $db;
	
	$this->guest_data['room'] = request_var('Room', '');
	$this->guest_data['message_from'] = request_var('MessageFrom', '');
	$this->guest_data['message_text'] = request_var('Message', '');
    
	if(empty($this->guest_data['room']) || empty($this->guest_data['message_text']))
	{
	    $code = 220;
	    
	    return false;
	}
	
	$sql = 'UPDATE ' . GUESTS_TABLE . " SET guest_message=1 
	    WHERE room_name='" . $this->guest_data['room'] . "'";
	$db->sql_query($sql);
	
	
	$sql_ary = array(
	    'guest_message_from'	=> (string) $this->guest_data['message_from'],
	    'guest_message_text'	=> (string) $this->guest_data['message_text'],
	    'room_name'			=> (string) $this->guest_data['room'],
	    'guest_message_date'	=> time(),
	);
	
	$sql = 'INSERT INTO ' . GUEST_MESSAGES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	
	//echo $sql; exit;
	$db->sql_query($sql);
	
	$code = 0;
	
	return true;
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
    
    function get_guest_bill($resv_id)
    {
	global $pms_config, $pms_request;
	
	$resv_id_str = (string) $resv_id;
	$a = strlen($resv_id_str);
	
	while ( $a < 8 ) {
	    $resv_id_str = '0' . $resv_id_str;
	    
	    $a++;
	}

	$url_request = $pms_config['url_request'] . '?Key=' . $pms_config['pms_userkey'] . 
		  '&Code=' . $pms_request['guest_bill'] .
		  '&ReservationID=' . $resv_id_str;

	// dummy data
	//$url_request = $pms_config['url_request'] . $pms_request['guest_bill'] . '.xml';
	// end dummy data
	//echo $url_request; exit;
	//$xml = simplexml_load_file( $url_request );
	$xml = @simpleXML_load_file($url_request,"SimpleXMLElement",LIBXML_NOCDATA);
	
	if( !$xml )
	{
	    //exit('Failed to open >' . $url_request . '<');
	    $xml = array();
	    
	    return false;
	}
	else
	{
	    $this->bill_data['bill_count'] = (int) $xml->Data->attributes()->{'Count'};
	    $this->bill_data['total_credit'] = 0;
	    $this->bill_data['total_debit'] = 0;
	    
	    $i = 0;
	    
	    foreach($xml->Data->Record as $row)
	    {
		$this->bill_data[$i]['rec_id'] = (int) $row->attributes()->{'id'};
		$this->bill_data[$i]['date'] = (int) $this->maketime($row->TransDate);
		$this->bill_data[$i]['category'] = (string) $row->Category;
		$this->bill_data[$i]['description'] = (string) $row->Decription;
		$this->bill_data[$i]['remark'] = (string) $row->Remark;
		$this->bill_data[$i]['reference'] = (string) $row->Reference;
		$this->bill_data[$i]['debit'] = (string) $row->Debit;
		$this->bill_data[$i]['credit'] = (string) $row->Credit;
		$this->bill_data[$i]['balance'] = (string) $row->Balance;
		
		$this->bill_data[$i]['item'] = (string) $row->Category . ' ' . $row->Decription . ' ' . $row->Reference;
		
		$this->bill_data['credit'] += (float) $row->Credit;
		$this->bill_data['debit'] += (float) $row->Debit;
		
		//$this->bill_data['balance'] += (float) $row->Debit;
	    
		$i++;
	    }
	    
	    $this->bill_data['total_balance'] = $this->bill_data['debit'] - $this->bill_data['credit'];
	    //$this->bill_data['total_balance'] = $this->bill_data['balance'];
	}
	
	return true;
    }
    
    function get_room_list()
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
    
    
    function get_menu_item($menu_id)
    {
	global $pms_config, $pms_request;

	$url_request = $pms_config['url_request'] . '?Key=' . $pms_config['pms_userkey'] . 
		  '&Code=' .  $pms_request['menu_item'] . 
		  '&MenuID=' .  $menu_id;

	//echo file_get_contents($url_request); exit;
	// dummy data
	$url_request = $pms_config['url_request'] . $pms_request['menu_item'] . $menu_id . '.xml';
	//echo $url_request; exit;
	// end dummy data

	//$xml = simplexml_load_file( $url_request ) or die('gagal! ' . $url_request);
	$xml = @simpleXML_load_file($url_request,"SimpleXMLElement",LIBXML_NOCDATA);
	
	if( !$xml )
	{
	    //exit('Failed to open >' . $url_request . '<');
	    $xml = array();
	}
	else
	{
	    $this->menu_data['menu_count'] = (int) $xml->Data->attributes()->{'Count'};
	    
	    $i = 0;
	    
	    foreach($xml->Data->Record as $row)
	    {
		$this->menu_data[$i]['rec_id'] = (int) $row->attributes()->{'id'};
		$this->menu_data[$i]['menu_id'] = (string) $row->MenuID;
		$this->menu_data[$i]['menu_name'] = (string) $row->MenuName;
		$this->menu_data[$i]['description'] = (string) $row->Description;
		$this->menu_data[$i]['signature'] = (string) $row->Signature;
		$this->menu_data[$i]['price'] = (int) $row->Price;
		$this->menu_data[$i]['unit'] = (string) $row->Unit;
		$this->menu_data[$i]['category_id'] = (string) $row->CategoryID;
		$this->menu_data[$i]['category_name'] = (string) $row->CategoryName;
	    
		$i++;
	    }
	
	}
    
	return true;
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
	
	//print_r($values); exit;
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
	
	$xml_data = '<HMS_APIRequest>
	    <Status ErrorCode="0" TimeStamp="' . time() . '">
		<Key>' . $pms_config['pms_userkey'] . '</Key>
		<Code>' . $pms_request['post_charge'] . '</Code>
		<ReservationID>' . $values['resv_id'] . '</ReservationID>
		<Room>' . $values['room_name'] . '</Room>
	    </Status>
	    <Data Count="' . $service_count . '">';
	
	
	$sql = 'SELECT * FROM ' . GUEST_SERVICES_DETAIL_TABLE . ' WHERE guest_service_id=' . $values['service_id'];
	$result = $db->sql_query($sql);
	
	$i = 1;
	while ($row = $db->sql_fetchrow($result))
	{
	    $items .= '<Record id="' . $i . '">
			  <ProductID>' . $row['guest_service_code'] . '</ProductID>
			  <ProductName>' . $row['guest_service_item'] . '</ProductName>
			  <Qty>' . $row['guest_service_qty'] . '</Qty>
			  <Remark>' . $row['guest_service_note'] . '</Remark>
		      </Record>';
	    
	    $i++;
	}
	
	$xml_data .= $items . '</Data>
			      </HMS_APIRequest>';
	
	//echo '<code>' . $xml_data . '</code>'; exit;
	$ch = curl_init();
	//curl_setopt($ch, CURLOPT_URL, "http://localhost/~tonjaw/testing/xmlpost/tes4.php");
	curl_setopt($ch, CURLOPT_URL, $pms_config['url_request']);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_data);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
	//curl_setopt($ch, CURLOPT_REFERER, 'http://localhost/~tonjaw/testing/xmlpost/tes4.php');
	curl_setopt($ch, CURLOPT_REFERER, $pms_config['url_request']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$data = curl_exec($ch); 

	if(curl_errno($ch))
	{
	    print curl_error($ch);
	}
	else
	{
	    curl_close($ch);
	}
	//exit;
	
	
	/*
	$url_request = $pms_config['url_request'] . '?Key=' . $pms_config['pms_userkey'] . 
		  '&Code=' .  $pms_request['post_charge'] .
		  '&ReservationID=' . $values['resv_id'] .
		  '&Room=' . $values['room_name'] . 
		  '&ProductID=' . $values['product_id'] .
		  '&ProductName=' . $values['product_name'] .
		  '&Remark=' . $values['remark'];

	//echo file_get_contents($url_request); exit;
	// dummy data
	$url_request = $pms_config['url_request'] . $pms_request['post_charge'] . '.xml';
	//echo $url_request; exit;
	// end dummy data
	
	$url_request = $pms_config['url_request'] . $pms_request['post_charge'] . 
		'?userid=' . $pms_config['pms_userid'] . 
		'&key=' . $pms_config['pms_userkey'] . 
		'&ReservationID=' . $values['resv_id'] . 
		'&Room=' . $values['room_name'] . 
		'&Category=' . $values['code'] . 
		'&Remark=' . $values['remark'] . 
		'&Reference=' . $values['item'] . 
		'&Amount=' . $values['price'] . 
		'&SourceID=' . time();//$values['source_id'];
		
		//echo $url_request; exit;
    
	//$xml = simplexml_load_file( $url_request );
	$xml = @simpleXML_load_file($url_request,"SimpleXMLElement",LIBXML_NOCDATA); */
	
	//print_r($xml); exit;
	//echo $url_request; exit;
	
	if( !empty($xml) )
	{
	    $code = 220;
	    
	    return false;
	}
    
	return true;
    }
    
    function room_status_update($values)
    {
    
    }
    
    function generate_status_combo()
    {
    
    }
    
    function pms_echo($var='Navicom-Rhapsody test...')
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