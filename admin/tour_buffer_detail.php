<?php
/**
*
* admin/tour_buffer_detail.php
*
* Roberto Tonjaw. Mar 2015
*/

/**
*/
define('IN_TONJAW', true);
define('IN_ADMIN', true);
define('NEED_SID', true);

$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './../';
$phpEx = substr(strrchr( $_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr( $_SERVER['PHP_SELF'], '/'), 1));

// Include files
require($tonjaw_root_path . 'common.' . $phpEx);
$tonjaw_admin_path = $tonjaw_root_path . $config['admin_path'];
require($tonjaw_admin_path . 'common_adm.' . $phpEx);


$bid 	= request_var('id', '');
$did 	= request_var('did', '');
$mode	= request_var('mode', 'list');
$sid 	= request_var('sid', '');

//$url = $tonjaw_admin_path . "tour_buffer_detail.$phpEx?mode=list&id=$bid";
//echo $id . '-crot...'; 

// Count Service Item
$sql = 'SELECT COUNT(d.guest_services_detail_id) AS total_entries 
    FROM ' . GUEST_SERVICES_TABLE . " s, " . GUEST_SERVICES_DETAIL_TABLE . " d 
    WHERE s.guest_service_id=d.guest_service_id AND s.guest_service_id=$bid AND s.guest_service_type='" . $config['roomservice_buffer_type'] . "'";

$result = $db->sql_query($sql);
$service_count = (int) $db->sql_fetchfield('total_entries');
$db->sql_freeresult($result);

$template->set_template();

if ( $service_count > 0 )
{
    $sql = 'SELECT s.guest_reservation_id, s.guest_service_roomname, s.guest_service_guestname, s.guest_service_approved, s.guest_service_received, s.guest_service_received_date, d.* 
	FROM ' . GUEST_SERVICES_TABLE . " s, " . GUEST_SERVICES_DETAIL_TABLE . 
	" d WHERE s.guest_service_id=d.guest_service_id AND s.guest_service_id=$bid AND s.guest_service_type='" . $config['roomservice_buffer_type'] . "'";

    //echo 'sql=' . $sql; exit; 
    $result = $db->sql_query($sql);

    while ($row = $db->sql_fetchrow($result))
    {
	$resv_id 	= $row['guest_reservation_id'];
	$room_name 	= $row['guest_service_roomname'];
	$guest_name	= $row['guest_service_guestname'];
	$approved	= $row['guest_service_approved'];
	$not_received	= $row['guest_service_received'] ? 0 : 1;
	$received	= $row['guest_service_received'];
	$received_date	= $row['guest_service_received_date']; 
	$url_delete	= $tonjaw_admin_path . "roomservice_buffer_detail.$phpEx?mode=delete&id=$bid&did=" . $row['guest_services_detail_id'];
	
	$template->assign_block_vars('buffer', array(
	    'U_CODE'		=> $row['guest_service_code'],
	    'U_QTY'		=> $row['guest_service_qty'],
	    'U_ITEM'		=> $row['guest_service_item'],
	    'U_PRICE'		=> number_format($row['guest_service_price']),
	    'U_NOTE'		=> $row['guest_service_note'],
	    'U_DELETE'		=> $url_delete,
	    'ICON_PATH'		=> $tonjaw_root_path . $config['imageset_path'],
	    'ROOMNAME'		=> $row['guest_service_roomname'],
	));

    }

    $db->sql_freeresult($result);

    //print_r($buffers_data); exit;
    $approved_decline = $approved ? $adm_lang['approved'] : $adm_lang['decline'];
    
    $template->assign_vars(array(
	'L_TITLE'	=> strtoupper($adm_lang['order_detail']),
	'U_TIME'	=> date($config['log_dateformat'], $bid),
	'L_TIME'	=> $adm_lang['datetime'],
	'T_THEME_PATH'	=> $tonjaw_root_path . $config['theme_path'],
	'U_ROOMNAME'	=> $room_name,
	'L_GUEST'	=> $adm_lang['guest_name'],
	'U_GUESTNAME'	=> $guest_name,
	'U_RESV_ID'	=> $resv_id,
	'L_CODE'	=> $adm_lang['code'],
	'L_ITEM'	=> $adm_lang['item'],
	'L_QTY'		=> $adm_lang['quantity'],
	'L_PRICE'	=> $adm_lang['price'],
	'L_NOTE'	=> $adm_lang['note'],
	'L_DELETE'	=> $adm_lang['action'],
	'L_CLOSE'	=> $adm_lang['close'],
	'L_APPROVE'	=> $adm_lang['process'],
	'U_APPROVE_URL'	=> $tonjaw_admin_path."roomservice_buffer.$phpEx?sid=$sid&mode=approve&id=$bid",
	'L_DECLINE'	=> $adm_lang['decline'],
	'U_DECLINE_URL'	=> $tonjaw_admin_path."roomservice_buffer.$phpEx?sid=$sid&mode=decline&id=$bid",
	'ICON_PATH'	=> $tonjaw_root_path . $config['imageset_path'],
	'S_NOT_RECEIVED' => $not_received,
	'S_APPROVED'	=> $received,
	'L_APPROVE_DECLINE' => $approved_decline,
	'S_RECEIVED_DATE' => date($config['log_dateformat'], $received_date),
    ));
    
    $template->set_filenames(array(
	'body' => 'admin_buffer_detail.tpl',
    ));
    
    
}
else
{
    die("No record with guest_service_id=$bid in Service Detail");
}

page_footer();

?>