<?php
/**
*
* pms/pms.php
*
* Roberto Tonjaw. Feb 2015
*/

/**
* 
*/
if (!defined('IN_TONJAW'))
{
	die('Hacking Attempt');
}

include_once($tonjaw_root_path . $config['pms_path'] . 'pmsal.' . $phpEx);

$pms_event['event'] 		= 'cmd';
$pms_event['check_in'] 		= 'CEKIN';
$pms_event['check_out']		= 'CEKOUT';
$pms_event['room_change'] 	= 'MOVE';
$pms_event['guest_change']	= 'CHANGE';
$pms_event['message']		= 'MSG';
$pms_event['daily_occupancy'] 	= 'OCC';
$pms_event['daily_occupancy_detail'] 	= 'OCCDETAIL';
$pms_event['month_occupancy'] 	= 'OCCMONTH';

$pms_event['sync_check']	= 'SYNCCEK';
$pms_event['sync_done']		= 'SYNCDONE';
$pms_event['sync']		= 'CEKINSYNC';
$pms_event['sync_init']		= 'INITSYNC';

$pms_event['service_sync_check']	= 'SVCSYNCCEK';
$pms_event['service_sync']		= 'SVCSYNC';

$pms_event['occupancy_by_date_check']	= 'OCCBYDATECEK';
$pms_event['occupancy_by_date']		= 'OCCBYDATE';

$pms_event['guest_bill_check']	= 'BILLVIEWCEK';
$pms_event['guest_bill_done']	= 'BILLVIEWDONE';

$pms_request['hotel_info']	= 'HELLO';
$pms_request['guest_bill']	= 'GUESTBILL';
$pms_request['room_list']	= 'ROOMLIST';
$pms_request['menu_item'] 	= 'MENUITEM';
$pms_request['send_message']	= 'SENDMESSAGE';
$pms_request['post_transaction'] = 'TRXSYNCCEK';

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

$pms_config['pms_name'] = 'VHP';
$pms_config['pms_version'] = 'n/a';
$pms_config['pms_vendor'] = 'PT. Supranusa Sindata';
$pms_config['pms_website'] = 'www.supranusasindata.com';

$pms_config['room_status'][0] = 'CLEAN';
$pms_config['room_status'][1] = 'DIRTY';
$pms_config['room_status'][2] = 'READY';

$pms_config['bill_exipred'] = 1800; //1800;

$pms_config['sync']		= 'SYNC';
$pms_config['item_sync']	= 'SVCSYNC';

$pms_config['outlet_id'][0]['table']		= SERVICES_TABLE;
$pms_config['outlet_id'][0]['table_t']		= SERVICE_TRANSLATIONS_TABLE;
$pms_config['outlet_id'][0]['table_p']		= GUEST_SERVICES_TABLE;
$pms_config['outlet_id'][0]['table_p_detail']	= GUEST_SERVICES_DETAIL_TABLE;
$pms_config['outlet_id'][0]['field_id']		= 'service_id';
$pms_config['outlet_id'][0]['field_code']	= 'service_code';
$pms_config['outlet_id'][0]['field_price']	= 'service_price';
$pms_config['outlet_id'][0]['field_updated']	= 'service_updated';
$pms_config['outlet_id'][0]['field_posted']	= 'guest_service_posted';
$pms_config['outlet_id'][0]['field_posted_id']	= 'guest_service_id';
$pms_config['outlet_id'][0]['field_posted_date']	= 'guest_service_received_date';
$pms_config['outlet_id'][0]['field_posted_approved']	= 'guest_service_approved';
$pms_config['outlet_id'][0]['field_posted_type']	= 'guest_service_type';
$pms_config['outlet_id'][0]['field_posted_code']	= 'guest_service_code';
$pms_config['outlet_id'][0]['field_posted_price']	= 'guest_service_price';
$pms_config['outlet_id'][0]['field_posted_qty']		= 'guest_service_qty';
$pms_config['outlet_id'][0]['field_posted_note']	= 'guest_service_note';


$pms_config['outlet_id'][1]['table']	= SHOPS_TABLE;
$pms_config['outlet_id'][1]['table_t']	= SHOP_TRANSLATIONS_TABLE;
$pms_config['outlet_id'][1]['table_p']		= GUEST_SERVICES_TABLE;
$pms_config['outlet_id'][1]['table_p_detail']	= GUEST_SERVICES_DETAIL_TABLE;
$pms_config['outlet_id'][1]['field_id']		= 'shop_id';
$pms_config['outlet_id'][1]['field_code']	= 'shop_code';
$pms_config['outlet_id'][1]['field_price']	= 'shop_price';
$pms_config['outlet_id'][1]['field_updated']	= 'shop_updated';
$pms_config['outlet_id'][1]['field_posted']	= 'guest_service_posted';
$pms_config['outlet_id'][1]['field_posted_id']	= 'guest_service_id';
$pms_config['outlet_id'][1]['field_posted_date']	= 'guest_service_received_date';
$pms_config['outlet_id'][1]['field_posted_approved']	= 'guest_service_approved';
$pms_config['outlet_id'][1]['field_posted_type']	= 'guest_service_type';
$pms_config['outlet_id'][1]['field_posted_code']	= 'guest_service_code';
$pms_config['outlet_id'][1]['field_posted_price']	= 'guest_service_price';
$pms_config['outlet_id'][1]['field_posted_qty']		= 'guest_service_qty';
$pms_config['outlet_id'][1]['field_posted_note']	= 'guest_service_note';

/**
* Realta Rhapsody Abstraction Layer
* Developed on Navicom IPTV
* @package pmsal
*/
class pmsal_vhp extends pmsal
{
    var $guest_data = array();
    var $info_data = array();
    var $bill_data = array();
    var $message_data = array();
    var $room_data = array();
    var $menu_data = array();

    function checkin(&$code='')
    {
	global $db, $config;
	
	$date = request_var('d', '');
	$time = request_var('t', '');
	$data_stream = request_var('f', '');
	$datetime = $this->maketime($date, $time);
	$stream_array = explode('|', $data_stream);
	//echo "date: $date<br/>time: $time<br/>";
	//echo "date_int: " . $datetime . '<br>date: ' . date($config['default_dateformat'], $datetime);
	//echo "<p>stream: $data_stream<br/>"; print_r($stream_array); exit;

	$this->guest_data['room'] = $stream_array[1];
	$this->guest_data['arrival_date'] = $datetime;
	$this->guest_data['resv_id'] = $stream_array[2];
	$this->guest_data['resv_no'] = $stream_array[3];
	$this->guest_data['resv_line_no'] = $stream_array[4];
	$this->guest_data['fullname'] = $stream_array[8];
	$this->guest_data['salutation'] = $stream_array[7];
	$this->guest_data['language'] = $stream_array[9];
	$this->guest_data['group'] = $stream_array[5] === 'Yes' ? 1 : 0;
	$this->guest_data['compliment'] = $stream_array[13] === 'Yes' ? 1 : 0;
	$this->guest_data['payment_method'] = $stream_array[12];
	$this->guest_data['house_use'] = $stream_array[14] === 'Yes' ? 1 : 0;
	
	//print_r($this->guest_data); exit;
	//echo 'full: ' . $this->guest_data['fullname'] . '<br/>payment: ' . $this->guest_data['language']; exit;
	/*
	$this->guest_data['first_name'] = request_var('FirstName', '');
	$this->guest_data['last_name'] = request_var('LastName', '');
	$this->guest_data['allow_viewbill'] = strtoupper(request_var('AllowViewBill', 'N'));
	$this->guest_data['vip'] = strtoupper(request_var('VIP', 'N'));
	$this->guest_data['honeymoon'] = strtoupper(request_var('HoneyMoon', 'N'));
	$this->guest_data['room_share'] = strtoupper(request_var('RoomShare', 'N'));
	$this->guest_data['remark'] = request_var('Remark', '');
	*/
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
	    'guest_resv_no'		=> (string) $this->guest_data['resv_no'],
	    'guest_resv_line_no'	=> (string) $this->guest_data['resv_line_no'],
	    'guest_arrival_date'	=> (int) $this->guest_data['arrival_date'],
	    //'guest_firstname'		=> (string) $this->guest_data['first_name'],
	    //'guest_lastname'		=> (string) $this->guest_data['last_name'],
	    'guest_fullname'		=> (string) $this->guest_data['fullname'],
	    'guest_salutation'		=> (string) $this->guest_data['salutation'],
	    'guest_group'		=> (int) $this->guest_data['group'],
	    //'guest_groupname'		=> (string) $this->guest_data['group_name'],
	    'guest_language'		=> (string) $this->guest_data['language'],
	    //'guest_allow_post'		=> (int) $this->guest_data['allow_post'],
	    //'guest_allow_viewbill'	=> (int) $this->guest_data['allow_viewbill'],
	    //'guest_vip'			=> (int) $this->guest_data['vip'],
	    //'guest_honeymoon'		=> (int) $this->guest_data['honeymoon'],
	    //'guest_room_share'		=> (int) $this->guest_data['room_share'],
	    'room_name'			=> (string) $this->guest_data['room'],
	    //'guest_connect_room'	=> (string) $this->guest_data['connect_room'],
	    'guest_compliment'		=> (int) $this->guest_data['compliment'],
	    'guest_house_use'		=> (int) $this->guest_data['house_use'],
	    'guest_payment_method'	=> (string) $this->guest_data['payment_method'],
	);
	
	// Check if the Guest already checked in (VHP WiFi Login)
	$sql = 'SELECT COUNT(guest_resv_line_no) AS total FROM ' . GUESTS_TABLE . " 
	    WHERE guest_reservation_id= " . (int) $this->guest_data['resv_id'] . " 
	    AND guest_fullname = '" . trim($this->guest_data['fullname']) . "'";

	$result = $db->sql_query($sql);
	$count = (int) $db->sql_fetchfield('total');
	$db->sql_freeresult($result);
	
	if ( $count < 1 )
	{
	    $sql = 'INSERT INTO ' . GUESTS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	
	    //echo '<p>' . $sql; exit;
	    $db->sql_query($sql);
	    
	    //Set room key
	    $this->generate_room_key($this->guest_data['resv_id'], $this->guest_data['room']);
	    
	    $this->send_reply_message('200', '1', 'Check In has succeeded');

	    $code = 0;
	}
	else
	{
	    $code = 1;
	}
	
	return true;
    }
    
    function checkout(&$code='')
    {
	global $db;
	
	$date = request_var('d', '');
	$time = request_var('t', '');
	$data_stream = request_var('f', '');
	$datetime = $this->maketime($date, $time);
	$stream_array = explode('|', $data_stream);
	
	$this->guest_data['room'] = $stream_array[1];
	$this->guest_data['resv_id'] = $stream_array[2];
	
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
	
	// remove guest's indirect buffer
	$sql = 'DELETE FROM ' . OUTLET_INDIRECT_BUFFER_TABLE . " 
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
	
	$this->send_reply_message('200', '1', 'Check Out has succeeded');
	
	return true;
    }

    function room_change(&$code='')
    {
	global $db;
	
	//$date = request_var('d', '');
	//$time = request_var('t', '');
	$data_stream = request_var('f', '');
	//$datetime = $this->maketime($date, $time);
	$stream_array = explode('|', $data_stream);
	//print_r($stream_array); exit;
    
	$this->guest_data['move_from'] = $stream_array[1];
	$this->guest_data['resv_id'] = $stream_array[3];
	$this->guest_data['room'] = $stream_array[2];
	
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
	
	$this->send_reply_message('200', '1', 'Room Change has succeeded');
	return true;
    }
    
    function guest_change(&$code='')
    {
	global $db;
	
	$date = request_var('d', '');
	$time = request_var('t', '');
	$data_stream = request_var('f', '');
	$datetime = $this->maketime($date, $time);
	$stream_array = explode('|', $data_stream);
	//echo "date: $date<br/>time: $time<br/>";
	//echo "date_int: " . $datetime . '<br>date: ' . date($config['default_dateformat'], $datetime);
	//echo "<p>stream: $data_stream<br/>"; print_r($stream_array); exit;

	$this->guest_data['room'] = $stream_array[1];
	$this->guest_data['arrival_date'] = $datetime;
	$this->guest_data['resv_id'] = $stream_array[2];
	$this->guest_data['fullname'] = $stream_array[8];
	$this->guest_data['salutation'] = $stream_array[7];
	$this->guest_data['language'] = $stream_array[9];
	$this->guest_data['group'] = $stream_array[5] === 'Yes' ? 1 : 0;
	$this->guest_data['compliment'] = $stream_array[13] === 'Yes' ? 1 : 0;
	$this->guest_data['payment_method'] = $stream_array[12];
	$this->guest_data['house_use'] = $stream_array[14] === 'Yes' ? 1 : 0;
	
/*
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
*/
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
	    //'guest_firstname'		=> (string) $this->guest_data['first_name'],
	    //'guest_lastname'		=> (string) $this->guest_data['last_name'],
	    'guest_fullname'		=> (string) $this->guest_data['fullname'],
	    'guest_salutation'		=> (string) $this->guest_data['salutation'],
	    'guest_group'		=> (int) $this->guest_data['group'],
	    //'guest_groupname'		=> (string) $this->guest_data['group_name'],
	    'guest_language'		=> (string) $this->guest_data['language'],
	    //'guest_allow_post'		=> (int) $this->guest_data['allow_post'],
	    //'guest_allow_viewbill'	=> (int) $this->guest_data['allow_viewbill'],
	    //'guest_vip'			=> (int) $this->guest_data['vip'],
	    //'guest_honeymoon'		=> (int) $this->guest_data['honeymoon'],
	    //'guest_room_share'		=> (int) $this->guest_data['room_share'],
	    'room_name'			=> (string) $this->guest_data['room'],
	    //'guest_connect_room'	=> (string) $this->guest_data['connect_room'],
	    'guest_compliment'		=> (int) $this->guest_data['compliment'],
	    'guest_house_use'		=> (int) $this->guest_data['house_use'],
	    'guest_payment_method'	=> (string) $this->guest_data['payment_method'],
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
	
	$this->send_reply_message('200', '1', 'Guest Change has succeeded');
	return true;
    }
    
    function check_message(&$code='')
    {
	global $db;
	
	
	
	return true;
    }

    function daily_occupancy(&$code='')
    {
	global $db;
	
	$date = request_var('d', '');
	$time = request_var('t', '');
	$datetime = $this->maketime($date, $time);
	$data_stream = request_var('f', '');
	$stream_array = explode('|', $data_stream);
	
	$this->guest_data['total_room'] = $stream_array[1];
	$this->guest_data['non_paying'] = $stream_array[2];
	
	//$this->guest_data['total_room'] = request_var('f', '');
	//$this->guest_data['non_paying_room'] = request_var('NonPayingRoom', '');
	$this->guest_data['date'] = $date;
	$this->guest_data['night_audit_time'] = $datetime;
    
	if(empty($this->guest_data['date']) || empty($this->guest_data['total_room']))
	{
	    $code = 220;
	    
	    return false;
	}
	
	$sql_ary = array(
	    'occupancy_daily_date'	=> (string) $this->guest_data['date'],
	    'occupancy_daily_totalroom'	=> (int) $this->guest_data['total_room'],
	    'occupancy_daily_nonpaying'	=> (int) $this->guest_data['non_paying'],
	    'occupancy_daily_time'	=> (int) $this->guest_data['night_audit_time'],
	);
	
	$sql = 'INSERT INTO ' . OCCUPANCY_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	
	//echo $sql; exit;
	$db->sql_query($sql);
	
	$code = 0;
	
	$this->send_reply_message('200', '1', 'Daily Occupancy has succeeded');
	
	return true;
	
    }
    
    function daily_occupancy_detail(&$code='')
    {
	global $db;
	
	
	$date = request_var('d', '');
	$time = request_var('t', '');
	$datetime = $this->maketime($date, $time);
	$data_stream = request_var('f', '');
	$stream_array = explode('|', $data_stream);
	
	$this->guest_data['room'] = $stream_array[2];
	$this->guest_data['guestname'] = $stream_array[1];
	$this->guest_data['non_paying'] = ( trim($stream_array[3]) === 'N' ) ? 1 : 0;
	$this->guest_data['night_audit_time'] = $datetime;
	$this->guest_data['date'] = $date;
	
	//$this->guest_data['non_paying_room'] = $this->guest_data['non_paying_room'] === 'Y' ? 1 : 0;
    
	if(empty($this->guest_data['date']) || empty($this->guest_data['room']))
	{
	    $code = 220;
	    
	    return false;
	}
	
	$sql_ary = array(
	    'occupancy_detail_guestname'=> (string) $this->guest_data['guestname'],
	    'occupancy_detail_room'	=> (string) $this->guest_data['room'],
	    'occupancy_detail_nonpaying'=> (int) $this->guest_data['non_paying'],
	    'occupancy_detail_date'	=> (string) $this->guest_data['date'],
	    'occupancy_detail_time'	=> (int) $this->guest_data['night_audit_time'],
	);
	
	$sql = 'INSERT INTO ' . OCCUPANCY_DETAIL_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	
	//echo $sql; exit;
	$db->sql_query($sql);
	
	$code = 0;
	
	$this->send_reply_message('200', '1', 'Occupancy Detail has succeeded');
	
	return true;
    }
    
    function month_occupancy(&$code='')
    {
	global $db;
	
	$date = request_var('d', '');
	$time = request_var('t', '');
	$datetime = $this->maketime($date, $time);
	//$data_stream = request_var('f', '');
	//$stream_array = explode('|', $data_stream);
	
	
	
	$this->guest_data['total_room'] = request_var('f', '');
	//$this->guest_data['non_paying_room'] = request_var('NonPayingRoom', '');
	$this->guest_data['date'] = $date;
	$this->guest_data['night_audit_time'] = $datetime;
    
	if(empty($this->guest_data['date']) || empty($this->guest_data['total_room']))
	{
	    $code = 220;
	    
	    return false;
	}
	
	$sql_ary = array(
	    'occupancy_daily_date'	=> (string) $this->guest_data['date'],
	    'occupancy_daily_totalroom'	=> (int) $this->guest_data['total_room'],
	    //'occupancy_daily_nonpaying'	=> (int) $this->guest_data['non_paying_room'],
	    'occupancy_daily_time'	=> (int) $this->guest_data['night_audit_time'],
	    'occupancy_daily_code'	=> (string) 'M',
	);
	
	$sql = 'INSERT INTO ' . OCCUPANCY_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	
	//echo $sql; exit;
	$db->sql_query($sql);
	
	$code = 0;
	
	$this->send_reply_message('200', '1', 'Occupancy Monthly has succeeded');
	
	return true;
    }
    
    function occupancy_request_check($code)
    {
	global $pms_config, $pms_request, $db, $pms_event;
	
	//$date = request_var('d', '');
	$sql = 'SELECT sync_request, sync_value FROM ' . SYNC_TABLE . " WHERE sync_code='" . $pms_event['occupancy_by_date'] . "'";
	//echo $sql; exit;
	$result = $db->sql_query($sql);
	//$sync_flag = (int) $db->sql_fetchfield('sync_request');
	//$sync_value = (string) $db->sql_fetchfield('sync_value');
	while ($row = $db->sql_fetchrow($result))
	{
	    $sync_flag = $row['sync_request'];
	    $sync_value = $row['sync_value'];
	}
	
	$db->sql_freeresult($result);
	
	if( $sync_flag )
	{
	    header("Content-type: text/xml");
	    echo "<?xml version='1.0' encoding='UTF-8'?>";
	    echo "<callback xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:noNamespaceSchemaLocation='schema.xsd'>\n\t\t";
	    echo "<body>\n\t\t\t\t";
	    echo "<status>200</status>\n\t\t";
	    echo "<message>The request has succeeded</message>\n\t\t";
	    echo "</body>\n";
	    echo "<content>\n\t\t\t\t";
	    echo "<data>\n\t\t\t\t";
	    echo "<date_requested>$sync_value</date_requested>\n\t\t";
	    echo "</data>\n";
	    echo "</content>\n";
	    
	    echo "</callback>";
	}
	else
	{
	    $this->send_reply_message('204', '0', 'No Request');
	}
	
	$code = 0;
	return true;
    }
    
    function occupancy_date_send($code)
    {
	global $db, $pms_event;
	
	$date_stamp = request_var('d', '');
	$time_stamp = request_var('t', '');
	$datetime_stamp = $this->maketime($date, $time);
	$data_stream = request_var('f', '');
	$stream_array = explode('|', $data_stream);
	
	$this->guest_data['total_room'] = $stream_array[1];
	$this->guest_data['non_paying'] = $stream_array[2];
	$date = $stream_array[3];
	
	//$this->guest_data['total_room'] = request_var('f', '');
	//$this->guest_data['non_paying_room'] = request_var('NonPayingRoom', '');
	$this->guest_data['date'] = $this->maketime($date, '00:00:00');
	$this->guest_data['night_audit_time'] = $this->maketime($date, '00:00:00');
    
	if(empty($this->guest_data['date']) || empty($this->guest_data['total_room']))
	{
	    $code = 220;
	    
	    return false;
	}
	
	$sql_ary = array(
	    'occupancy_daily_date'	=> (string) $this->guest_data['date'],
	    'occupancy_daily_totalroom'	=> (int) $this->guest_data['total_room'],
	    'occupancy_daily_nonpaying'	=> (int) $this->guest_data['non_paying'],
	    'occupancy_daily_time'	=> (int) $this->guest_data['night_audit_time'],
	);
	
	$sql = 'INSERT INTO ' . OCCUPANCY_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	
	//echo $sql; exit;
	$db->sql_query($sql);
	
	//RESET sync table
	$sql = 'UPDATE ' . SYNC_TABLE . " SET sync_request=0, sync_value='' WHERE sync_code='" . $pms_event['occupancy_by_date'] . "'";
	$db->sql_query($sql);
	
	$code = 0;
	
	$this->send_reply_message('200', '1', 'Occupancy By Date has succeeded');
	
	return true;
    }
    
    function occupancy_request($from, $to)
    {
	global $db, $pms_event;
	
	//UPDATE sync table
	$sql = 'UPDATE ' . SYNC_TABLE . " SET sync_request=1, sync_value='" . $from . "' WHERE sync_code='" . $pms_event['occupancy_by_date'] . "'";
	
	//echo $sql; exit;
	$db->sql_query($sql);
/*
	header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=document_name.xls");

echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
echo "<body>";
echo "<b>testdata1</b> \t <u>testdata2</u> \t \n ";
echo "</body>";
echo "</html>";
*/
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
    
    function guest_bill_check($code)
    {
	global $pms_config, $pms_request, $db, $pms_event;
	
	//$date = request_var('d', '');
	$sql = 'SELECT guest_reservation_id, guest_resv_no, guest_resv_line_no, room_name FROM ' . 
	    GUESTS_TABLE . " WHERE guest_bill_request='1'";
	
	$result = $db->sql_query($sql);
	
	$i = 0;
	$bill_request = array();
	
	while ($row = $db->sql_fetchrow($result))
	{
	    $bill_request[$i] = array(
		'resv_id'	=> $row['guest_reservation_id'],
		'resv_no'	=> $row['guest_resv_no'],
		'resv_line_no'	=> $row['guest_resv_line_no'],
		'room_name'	=> $row['room_name'],
	    );
	    
	    $sql = 'DELETE FROM ' . GUEST_BILLS_TABLE . " WHERE guest_reservation_id=" . $row['guest_reservation_id'];
	    $db->sql_query($sql);

	    $i++;
	}
    
	$db->sql_freeresult($result);
	
	if( $i > 0 )
	{
	    header("Content-type: text/xml");
	    echo "<?xml version='1.0' encoding='UTF-8'?>";
	    echo "<callback xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:noNamespaceSchemaLocation='schema.xsd'>\n\t\t";
	    echo "<body>\n\t\t\t\t";
	    echo "<status>200</status>\n\t\t";
	    echo "<message>The request has succeeded</message>\n\t\t";
	    echo "</body>\n";
	    $i = 1;
	    foreach ($bill_request as $row)
	    {
		echo "<data>\n\t\t\t\t";
		echo "<request_billingID>$i</request_billingID>\n\t\t";
		echo "<number>" . $row['room_name'] . "</number>\n\t\t";
		echo "<resNr>" . $row['resv_no'] . "</resNr>\n\t\t";
		echo "<resLnNr>" . $row['resv_line_no'] . "</resLnNr>\n\t\t";
		echo "</data>\n";
		
		$i++;
	    }
	    
	    echo "</callback>";
	 
	}
	else
	{
	    $this->send_reply_message('204', '0', 'No Content');
	}
	
	$code = 0;
	return true;
    }
    
    function guest_bill_done($code)
    {
	global $pms_config, $pms_request, $db;
	
	$data_stream = request_var('f', '');
	$stream_array = explode('|', $data_stream);
	//echo "date: $date<br/>time: $time<br/>";
	//echo "date_int: " . $datetime . '<br>date: ' . date($config['default_dateformat'], $datetime);
	//echo "<p>stream: $data_stream<br/>"; print_r($stream_array); exit;
	
	for( $i=1; $i <= count($stream_array); $i++ )
	{
	    $stream_detail = explode(',', $stream_array[$i]);
	    
	    $resv_id = $stream_detail[1] . $stream_detail[2];
	    $item = $stream_detail[3] . ' ' . $stream_detail[4];
	    $debit = $stream_detail[5];
	    $credit = $stream_detail[6];
	    
	    $datetime = explode(' ', $stream_detail[7]);
	    //$date = $datetime[1];
	    $date = (int) $this->maketime($datetime[0], $datetime[1]);
	    //echo date('F j, Y, g:i a', $date) . '<br/>';
	    
	    if( !empty($resv_id) )
	    {
		$sql_ary = array(
		    'guest_reservation_id'	=> (int) $resv_id,
		    'guest_bill_date'		=> (int) $date,
		    'guest_bill_description'	=> (string) $item,
		    'guest_bill_credit'		=> (int) $credit,
		    'guest_bill_debit'		=> (int) $debit,
		);
	    
		$sql = 'INSERT INTO ' . GUEST_BILLS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
		//echo '<p>' . $sql; exit;
		$db->sql_query($sql);
		
		$sql = "UPDATE " . GUESTS_TABLE . " SET guest_bill_request='0', guest_bill_lastupdate=" . time() . "
		    WHERE guest_reservation_id=$resv_id";
		    //echo '<p>' . $sql; exit;
		$db->sql_query($sql);
	    
	    }
	}
	
	$this->send_reply_message('202', '1', 'The request has accepted');

	return true;
    }
    
    function get_guest_bill($resv_id)
    {
	global $db, $pms_config, $config;

	$sql = 'SELECT guest_bill_lastupdate AS lastupdate FROM ' . GUESTS_TABLE . " WHERE guest_reservation_id=$resv_id";
	
	$result = $db->sql_query($sql);
	$lastupdate = (int) $db->sql_fetchfield('lastupdate');
	$db->sql_freeresult($result);
	
	$lastupdate += $pms_config['bill_exipred'];
	$expire = time() - $lastupdate;
	
	$sql = 'SELECT COUNT(guest_bill_id) AS total FROM ' . GUEST_BILLS_TABLE . " WHERE guest_reservation_id=$resv_id";
	
	$result = $db->sql_query($sql);
	$total = (int) $db->sql_fetchfield('total');
	$db->sql_freeresult($result);
	
	//echo time(); exit;
	//echo date($config['default_dateformat'],$lastupdate) . "<br/>" . date($config['default_dateformat'],$lastupdate1) . "<br/>" . date($config['default_dateformat'],time()); exit;
	if ( $lastupdate < time() || $total == 0)
	{
	    $sql = "UPDATE " . GUESTS_TABLE . " SET guest_bill_request='1' WHERE guest_reservation_id=$resv_id";
	    //echo 'crot: ' . $sql; exit;
	    $db->sql_query($sql);
	    
	    // Wait for a second...
	    $this->bill_data['total_balance'] = NULL;
	    
	}
	else
	{
	    $sql = 'SELECT guest_reservation_id, guest_bill_date, guest_bill_description, guest_bill_credit, guest_bill_debit FROM ' . GUEST_BILLS_TABLE . " WHERE guest_reservation_id=$resv_id";
	//echo 'crot: ' . $sql; exit;
	    $result = $db->sql_query($sql);
	    //print_r($result); exit;
	    $i = 0;
	    while ($row = $db->sql_fetchrow($result))
	    {
		$this->bill_data[$i]['date'] = $row['guest_bill_date'];
		$this->bill_data[$i]['debit'] = (float) $row['guest_bill_debit'];
		$this->bill_data[$i]['credit'] = (float) $row['guest_bill_credit'];
		
		$this->bill_data[$i]['item'] = $row['guest_bill_description'];
		
		$this->bill_data['credit'] += (float) $row['guest_bill_credit'];
		$this->bill_data['debit'] += (float) $row['guest_bill_debit'];
		
		$i++;
	    }
    
	    $this->bill_data['total_balance'] = $this->bill_data['debit'] - $this->bill_data['credit'];
	    
	    $db->sql_freeresult($result);
	
	}
	
	//print_r($this->bill_data); exit;
	return true;
	
    }
    
    function get_room_list()
    {
	
	
    }
    
    
    function get_menu_item($menu_id)
    {
	
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
	global $db;
	
	//Get message from Guest Message Table
	$sql = 'SELECT COUNT(guest_message_id) AS total_entries
		FROM ' . GUEST_MESSAGES_TABLE . " WHERE guest_message_to=$resv_id";
		
	$result = $db->sql_query($sql);
	$total_message = (int) $db->sql_fetchfield('total_entries');
	$db->sql_freeresult($result);
	
	//echo $total_message . '<br/>' . $resv_id; exit;
	//$a = strtotime('2013-09-30T17:10:01');
	//echo $a . '<br/>' . date($config['viewbill_dateformat'], $a); exit;
    
	return $total_message;
    }
    
    function get_message_all($resv_id)
    {
	global $db;
    
	//Get message from Guest Message Table
	$sql = "SELECT guest_message_date, guest_message_from, room_name, guest_message_subject, guest_message_content, guest_message_read FROM " . GUEST_MESSAGES_TABLE . " WHERE guest_message_to=$resv_id";
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
	global $pms_config, $db;
	
	//$date = request_var('d', '');
	
	$sql = 'UPDATE ' . SYNC_TABLE . " SET sync_request=1 WHERE sync_code='" . $pms_config['sync'] . "'";
	//echo 'sql: ' . $sql; exit;
	$db->sql_query($sql);

	return true;
    }
    
    function sync_check($code)
    {
	global $pms_config, $pms_request, $db, $pms_event;
	
	//$date = request_var('d', '');
	$sql = 'SELECT sync_request FROM ' . SYNC_TABLE . " WHERE sync_code='" . $pms_config['sync'] . "'";
	$result = $db->sql_query($sql);
	$sync_flag = (int) $db->sql_fetchfield('sync_request');
	$db->sql_freeresult($result);
	
	if( $sync_flag )
	{
	    $this->send_reply_message('200', '1', 'Need Sync');
	}
	else
	{
	    $this->send_reply_message('200', '0', 'No Need Sync');
	}
	
	$code = 0;
	return true;
    }
    
    function sync_init($code)
    {
	global $pms_config, $db;
	
	//$date = request_var('d', '');
	
	$sql = 'UPDATE ' . SYNC_TABLE . " SET sync_request=0, sync_status=1 WHERE sync_code='" . $pms_config['sync'] . "'";
	//echo 'sql: ' . $sql; exit;
	$db->sql_query($sql);
	
	// Set Sync Status in Guest Table
	$sql = 'UPDATE ' . GUESTS_TABLE . " SET guest_sync_status=1 WHERE guest_permanent=0";
	$db->sql_query($sql);
	
	$this->send_reply_message('200', '1', 'Ready To Sync'); //exit;
	$code = 0;
	return true;
    }
    
    function sync_done($code)
    {
	global $pms_config, $db;
	
	//$date = request_var('d', '');
	
	// WIPE OUT guest_sync_status OF EXISTING IN-HOUSE
	$sql = 'DELETE FROM ' . GUESTS_TABLE . " 
	    WHERE guest_sync_status=1";
	$db->sql_query($sql);
	
	// Reset Sync Status
	$sql = 'UPDATE ' . SYNC_TABLE . " SET sync_request=0, sync_status=0 WHERE sync_code='" . $pms_config['sync'] . "'";
	//echo 'sql: ' . $sql; exit;
	$db->sql_query($sql);
	$this->send_reply_message('200', '1', 'The request has succeeded'); //exit;
	$code = 0;
	return true;
    }
    
    function sync_checkin()
    {
	global $db, $config;
	
	$date = request_var('d', '');
	$time = request_var('t', '');
	$data_stream = request_var('f', '');
	$datetime = $this->maketime($date, $time);
	$stream_array = explode('|', $data_stream);
	//echo "date: $date<br/>time: $time<br/>";
	//echo "date_int: " . $datetime . '<br>date: ' . date($config['default_dateformat'], $datetime);
	//echo "<p>stream: $data_stream<br/>"; print_r($stream_array); exit;

	$this->guest_data['room'] = $stream_array[1];
	$this->guest_data['arrival_date'] = $datetime;
	$this->guest_data['resv_id'] = $stream_array[2];
	$this->guest_data['resv_no'] = $stream_array[3];
	$this->guest_data['resv_line_no'] = $stream_array[4];
	$this->guest_data['fullname'] = $stream_array[8];
	$this->guest_data['salutation'] = $stream_array[7];
	$this->guest_data['language'] = $stream_array[9];
	$this->guest_data['group'] = $stream_array[5] === 'Yes' ? 1 : 0;
	$this->guest_data['compliment'] = $stream_array[13] === 'Yes' ? 1 : 0;
	$this->guest_data['payment_method'] = $stream_array[12];
	//$this->guest_data['house_use'] = $stream_array[14] === 'Yes' ? 1 : 0;
	
	/*
	$this->guest_data['first_name'] = request_var('FirstName', '');
	$this->guest_data['last_name'] = request_var('LastName', '');
	$this->guest_data['allow_viewbill'] = strtoupper(request_var('AllowViewBill', 'N'));
	$this->guest_data['vip'] = strtoupper(request_var('VIP', 'N'));
	$this->guest_data['honeymoon'] = strtoupper(request_var('HoneyMoon', 'N'));
	$this->guest_data['room_share'] = strtoupper(request_var('RoomShare', 'N'));
	$this->guest_data['remark'] = request_var('Remark', '');
	*/
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
	    'guest_resv_no'		=> (string) $this->guest_data['resv_no'],
	    'guest_resv_line_no'	=> (string) $this->guest_data['resv_line_no'],
	    'guest_arrival_date'	=> (int) $this->guest_data['arrival_date'],
	    //'guest_firstname'		=> (string) $this->guest_data['first_name'],
	    //'guest_lastname'		=> (string) $this->guest_data['last_name'],
	    'guest_fullname'		=> (string) $this->guest_data['fullname'],
	    'guest_salutation'		=> (string) $this->guest_data['salutation'],
	    'guest_group'		=> (int) $this->guest_data['group'],
	    //'guest_groupname'		=> (string) $this->guest_data['group_name'],
	    'guest_language'		=> (string) $this->guest_data['language'],
	    //'guest_allow_post'		=> (int) $this->guest_data['allow_post'],
	    //'guest_allow_viewbill'	=> (int) $this->guest_data['allow_viewbill'],
	    //'guest_vip'			=> (int) $this->guest_data['vip'],
	    //'guest_honeymoon'		=> (int) $this->guest_data['honeymoon'],
	    //'guest_room_share'		=> (int) $this->guest_data['room_share'],
	    'room_name'			=> (string) $this->guest_data['room'],
	    //'guest_connect_room'	=> (string) $this->guest_data['connect_room'],
	    'guest_compliment'		=> (int) $this->guest_data['compliment'],
	    //'guest_house_use'		=> (int) $this->guest_data['house_use'],
	    'guest_payment_method'	=> (string) $this->guest_data['payment_method'],
	);
	
	$sql = 'INSERT INTO ' . GUESTS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	
	//echo '<p>' . $sql; exit;
	$db->sql_query($sql);
	
	//Set room key
	$this->generate_room_key($this->guest_data['resv_id'], $this->guest_data['room']);
	
	$this->send_reply_message('200', '1', 'The request has succeeded');

	$code = 0;
	return true;
    }
    
    function item_sync_check($code)
    {
	global $pms_config, $pms_request, $db, $pms_event;
	
	//$date = request_var('d', '');
	$sql = 'SELECT sync_request FROM ' . SYNC_TABLE . " WHERE sync_code='" . $pms_config['item_sync'] . "'";
	$result = $db->sql_query($sql);
	$sync_flag = (int) $db->sql_fetchfield('sync_request');
	$db->sql_freeresult($result);
	
	if( $sync_flag )
	{
	    $this->send_reply_message('200', '1', 'Need Sync');
	}
	else
	{
	    $this->send_reply_message('200', '0', 'No Sync');
	}
	
	$code = 0;
	return true;
    }
    
    function item_sync($code)
    {
	global $pms_config, $pms_request, $db, $config;
	
	$count_table = count($pms_config['outlet_id']);
	//echo $count_table; exit;
	
	for( $i = 0; $i<$count_table; $i++ )
	{
	    $sql = 'SELECT COUNT(' . $pms_config['outlet_id'][$i]['field_id'] . ') AS total_entries
		FROM ' . $pms_config['outlet_id'][$i]['table'] . ' 
		WHERE ' . $pms_config['outlet_id'][$i]['field_updated'] . '=1';
		
	    $result = $db->sql_query($sql);
	    $updated_count = (int) $db->sql_fetchfield('total_entries');
	    $db->sql_freeresult($result);
	    
	    if( $updated_count > 0 )
	    {
		$xml_content .= "<outlet id='" . $pms_config['outlet_id'][$i]['code'] . "'>
			  <data count='" . $updated_count . "'>";
		
		$sql = 'SELECT m.' . $pms_config['outlet_id'][$i]['field_id'] . ' AS id, 
		    m.' . $pms_config['outlet_id'][$i]['field_code'] . ' AS code, 
		    m.' . $pms_config['outlet_id'][$i]['field_price'] . ' AS price, 
		    t.translation_title AS name, t.translation_description AS description  
		    FROM ' . $pms_config['outlet_id'][$i]['table'] . ' m, ' . $pms_config['outlet_id'][$i]['table_t'] . ' t 
		    WHERE m.' . $pms_config['outlet_id'][$i]['field_id'] . '=t.' . $pms_config['outlet_id'][$i]['field_id'] . ' 
		    AND m.' . $pms_config['outlet_id'][$i]['field_updated'] . "=1 
		    AND t.language_id='" . $config['default_language'] . "'";
		//echo $sql; exit;
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{
		    $xml_content .= "<record>
			<article>" . $row['code'] . "</article>
			<name>" . $row['name'] . "</name>
			<description>" . $row['description'] . "</description>
			<price>" . $row['price'] . "</price>
		    </record>";
		    
		    $sql = 'UPDATE ' . $pms_config['outlet_id'][$i]['table'] . ' 
			SET ' . $pms_config['outlet_id'][$i]['field_updated'] . '=0 
			WHERE ' . $pms_config['outlet_id'][$i]['field_id'] . "=" . $row['id'];
			
		    $db->sql_query($sql);

		}
		$db->sql_freeresult($result);
		
		$xml_content .= "</data></outlet>";
		
	    }
	    
	}
	
	//RESET SYNC status
	$sql = 'UPDATE ' . SYNC_TABLE . " SET sync_request=0 WHERE sync_code='" . $pms_config['item_sync'] . "'";
	$db->sql_query($sql);
	
	header("Content-type: text/xml");
	echo "<?xml version='1.0' encoding='UTF-8'?>";
	echo "<callback xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:noNamespaceSchemaLocation='schema.xsd'>\n\t\t";
	echo $xml_content . "</callback>"; 
	
	return true;
    }
    
    function post_charge($code)
    {
	global $pms_config, $pms_request, $db;
	
	$count_table = count($pms_config['outlet_id']);
	
	for( $i = 0; $i<$count_table; $i++ )
	{
	    $sql = 'SELECT COUNT(p.' . $pms_config['outlet_id'][$i]['field_posted_id'] . ') AS total_entries
		FROM ' . $pms_config['outlet_id'][$i]['table_p'] . ' p 
		JOIN ' . $pms_config['outlet_id'][$i]['table_p_detail'] . ' d 
		ON p.' . $pms_config['outlet_id'][$i]['field_posted_id'] . '=d.' . $pms_config['outlet_id'][$i]['field_posted_id'] . ' 
		WHERE p.' . $pms_config['outlet_id'][$i]['field_posted'] . '=0 
		AND p.' . $pms_config['outlet_id'][1]['field_posted_approved'] . '=1 
		AND p.' . $pms_config['outlet_id'][$i]['field_posted_type'] ."='" . $pms_config['outlet_id'][$i]['buffer_type'] . "'";
		
	    $result = $db->sql_query($sql);
	    $posted_count = (int) $db->sql_fetchfield('total_entries');
	    $db->sql_freeresult($result);
	    
	    if( $posted_count > 0 )
	    {
	      //echo 'posted: ' . $posted_count; exit;
		$xml_content .= "<outlet id='" . $pms_config['outlet_id'][$i]['code'] . "'>
			  <data count='" . $posted_count . "'>";
			  
		$sql = 'SELECT p.' . $pms_config['outlet_id'][$i]['field_posted_id'] . ' AS id,  
			p.' . $pms_config['outlet_id'][$i]['field_posted_date'] . ' AS date, 
			d.' . $pms_config['outlet_id'][$i]['field_posted_code'] . ' AS code,
			d.' . $pms_config['outlet_id'][$i]['field_posted_qty'] . ' AS qty, 
			d.' . $pms_config['outlet_id'][$i]['field_posted_price'] . ' AS price,
			d.' . $pms_config['outlet_id'][$i]['field_posted_note'] . ' AS note, 
			p.guest_reservation_id AS resv_id 
		    FROM ' . $pms_config['outlet_id'][$i]['table_p'] . ' p 
		    JOIN ' . $pms_config['outlet_id'][$i]['table_p_detail'] . ' d 
		    ON p.' . $pms_config['outlet_id'][$i]['field_posted_id'] . '=d.' . $pms_config['outlet_id'][$i]['field_posted_id'] . ' 
		    WHERE p.' . $pms_config['outlet_id'][$i]['field_posted'] . '=0 
		    AND p.' . $pms_config['outlet_id'][$i]['field_posted_approved'] . '=1 
		    AND p.' . $pms_config['outlet_id'][$i]['field_posted_type'] ."='" . $pms_config['outlet_id'][$i]['buffer_type'] . "'";
	      //echo $sql; exit;
		$result = $db->sql_query($sql);
		$a = 1;
		while ($row = $db->sql_fetchrow($result))
		{
		    $sql = 'SELECT guest_resv_no, guest_resv_line_no FROM ' . GUESTS_TABLE . ' WHERE 
			guest_reservation_id=' . $row['resv_id'];
// 			//echo $sql; exit;
		    $result1 = $db->sql_query($sql);
		    
		    while ($row1 = $db->sql_fetchrow($result1))
		    {
			$resv_no 	= $row1['guest_resv_no'];
			$resv_line_no 	= $row1['guest_resv_line_no'];
		    }
		    $db->sql_freeresult($result1);
		    
		    $datetime = date('Y-m-d H:i:s', $row['date']);
		    
		    $xml_content .= "<record>
			<id>$a</id>
			<resNr>$resv_no</resNr>
			<resLnNr>$resv_line_no</resLnNr>
			<article>" . $row['code'] . "</article>
			<qty>" . $row['qty'] . "</qty>
			<price>" . $row['price'] . "</price>
			<note>" . $row['note'] . "</note>
			<datetime>$datetime</datetime>
		    </record>";
		    
		    $sql = 'UPDATE ' . $pms_config['outlet_id'][$i]['table_p'] . ' 
			SET ' . $pms_config['outlet_id'][$i]['field_posted'] . '=1 
			WHERE ' . $pms_config['outlet_id'][$i]['field_posted_id'] . "=" . $row['id'];
			
		    $db->sql_query($sql);
		    
		    $a++;

		}
		$db->sql_freeresult($result);
	      
		$xml_content .= "</data></outlet>";
	      
	      
	      
	      
	    }
	
	
	}
	
	header("Content-type: text/xml");
	echo "<?xml version='1.0' encoding='UTF-8'?>";
	echo "<callback xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:noNamespaceSchemaLocation='schema.xsd'>\n\t\t";
	echo $xml_content . "</callback>"; 
    
	return true;
    }
    
    function room_status_update($values)
    {
    
    }
    
    function generate_status_combo()
    {
    
    }
    
    function pms_echo($var='Navicom-VHP test...')
    {
	echo '<center> >'.$var.'< </center>';
	return;
    }
    
    function send_reply_message($status, $code='', $message='')
    {
	global $pms_error_code;
	
	header("Content-type: text/xml");
	echo "<?xml version='1.0' encoding='UTF-8'?>";
	echo "<callback xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:noNamespaceSchemaLocation='schema.xsd'>\n\t\t";
	echo "<body>\n\t\t\t\t";
	echo "<status>" . $status . "</status>\n\t\t";
	echo "<code>" . $code . "</code>\n\t\t";
	echo "<message>" . $message . "</message>\n\t\t";
	echo "</body>\n";
	echo "</callback>";
    }
        
    function maketime($date, $time)
    {	//     0123456789      01234567
	// d = yyyy-mm-dd. t = hh:mm:ss
	$year = substr($date, 0, 4);
	$month = substr($date, 5, 2);
	$date = substr($date, 8, 2);
	$hour = substr($time, 0, 2);
	$minute = substr($time, 3, 2);
	$second = substr($time, 6, 2);
    
	$datetime_int = mktime($hour, $minute, $second , $month, $date, $year);
	
	return $datetime_int;
    }
}

?>