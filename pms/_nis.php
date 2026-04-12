<?php
/**
*
* pms/nis.php
*
* Roberto Tonjaw. May 2014
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

require('common_pms.' . $phpEx);

$event = request_var($pms_event['event'], '');

$new = request_var('Room', '');
$old = request_var('MoveTo', '');
$resv_id = request_var('ReservationID', '');

switch( $event )
{
    case $pms_event['check_in']:

	$success = $pms->checkin($code);
	//echo 'check_in jalan...';
	break;
	
    case $pms_event['check_out']:
    
	$success = $pms->checkout($code);
	break;
	
    case $pms_event['room_change']:
    
	$success = $pms->room_change($code);
	break;
	
    case $pms_event['guest_change']:
    
	$success = $pms->guest_change($code);
	break;
	
    case $pms_event['message']:
    
	$success = $pms->check_message($code);
	break;
	
    case $pms_event['daily_occupancy']:
    
	$success = $pms->daily_occupancy($code);
	break;

    case $pms_event['daily_occupancy_detail']:
	
	$success = $pms->daily_occupancy_detail($code);
	break;

    case $pms_event['month_occupancy']:
	
	$success = $pms->month_occupancy($code);
	break;
	
    case $pms_event['sync_check']:	// VHP
	
	$success = $pms->sync_check($code);
	break;

    case $pms_event['sync_done']:	// VHP
	
	$success = $pms->sync_done($code);
	break;
	
    case $pms_event['sync']:		// VHP
	
	$success = $pms->sync_checkin($code);
	break;
	
    case $pms_event['sync_init']:	// VHP
	
	$success = $pms->sync_init($code);
	break;
	
    case $pms_event['sync_init']:	// VHP
	
	$success = $pms->sync_init($code);
	break;
	
    case $pms_event['guest_bill_check']:	// VHP
	
	$success = $pms->guest_bill_check($code);
	break;
	
    case $pms_event['guest_bill_done']:	// VHP
	
	$success = $pms->guest_bill_done($code);
	break;

    case $pms_event['service_sync_check']:	// VHP
	
	$success = $pms->item_sync_check($code);
	break;
	
    case $pms_event['service_sync']:	// VHP
	
	$success = $pms->item_sync($code);
	break;
	
    case $pms_request['post_transaction']:  // VHP
    
    $success = $pms->post_charge($code);
	break;
}

//$pms->get_info();
//$code = 'Event=' . $event . ' - ' . 'Room=' . $old . ' - ' . 'MoveTo=' . $new . ' - ' . 'ResvID=' . $resv_id;

//$pms->send_reply_message($code);
//$pms->pms_echo($event);
unset($db);
unset($pms);


?>