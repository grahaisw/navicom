<?php
/**
*
* admin/roomservice_buffer_detail.php
*
* Roberto Tonjaw. Feb 2015
*/

/**
*/

define('IN_TONJAW', true);
define('IN_ADMIN', true);
define('NEED_SID', true);

$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './../';
$phpEx = substr(strrchr( $_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr( $_SERVER['PHP_SELF'], '/'), 1));
$files = str_replace("_detail", "", $file[0]);
// Include files
require($tonjaw_root_path . 'common.' . $phpEx);
$tonjaw_admin_path = $tonjaw_root_path . $config['admin_path'];
require($tonjaw_admin_path . 'common_adm.' . $phpEx);

$session->session_begin($file[0]);

require($tonjaw_root_path . $config['include_path'] . 'functions_module.' . $phpEx);

// Instantiate new module
$module = new p_master();

$template->set_template();

// Instantiate module system and generate list of available modules
$module->list_modules($files);

//Generate detail menu of the selected module
$module->list_modules_detail($files, $module->p_id);

// Assign data to the template engine for the list of modules
// We do this before loading the active module for correct menu display in trigger_error
$module->assign_tpl_vars(append_sid("{$tonjaw_admin_path}index.$phpEx"));

//echo $module->user_priviledge[2]; exit;
$bid 	= request_var('id', '');
$did 	= request_var('did', '');
$mode	= request_var('mode', 'list');
$sid 	= request_var('sid', '');

//$url = $tonjaw_admin_path . "roomservice_buffer_detail.$phpEx?mode=list&id=$bid";
//echo $id . '-crot...'; 
//echo 'a'.$mode; exit;
if ( $mode === 'delete' && !empty($did) ) 
{
    $sql = 'DELETE FROM ' . GUEST_SERVICES_DETAIL_TABLE . ' WHERE guest_services_detail_id=' . $did;
    //echo 'sql=' . $sql; exit; 
    $db->sql_query($sql);
    
    $mode = 'list';
    
    //redirect($config['admin_path'] . 'roomservice_buffer_detail.' . $phpEx . "?mode=list&id=$bid", $sid);
}

$template->set_template();

if ( $mode === 'update' && !empty($did) ) 
{
    $qty = request_var('qty', 0);

    if ( isset($_POST['btnSubmit']) && $qty > 0 )
    {
	$sql = 'UPDATE ' . GUEST_SERVICES_DETAIL_TABLE . " SET guest_service_qty=$qty WHERE guest_services_detail_id=" . $did;
	//echo 'sql=' . $sql; exit; 
	$db->sql_query($sql);
	
	$mode = 'list';
	
	
    }
    else
    {
	$sql = 'SELECT guest_service_item, guest_service_qty, guest_service_code, guest_service_note 
	FROM ' . GUEST_SERVICES_DETAIL_TABLE . ' WHERE guest_services_detail_id=' . $did;
	//echo 'sql=' . $sql; exit; 
	$result = $db->sql_query($sql);;
	
	while ($row = $db->sql_fetchrow($result))
	{
	    $item_name 	= $row['guest_service_item'];
	    $item_qty 	= $row['guest_service_qty'];
	    $item_code 	= $row['guest_service_code'];
	    $item_node 	= $row['guest_service_node'];
	}
	
	$db->sql_freeresult($result);
	
	 $url_cancel	= $tonjaw_admin_path . "roomservice_buffer_detail.$phpEx?mode=list&id=$bid&did=" . $row['guest_services_detail_id'];
	
	$template->assign_vars(array(
	    'L_TITLE'	=> strtoupper($item_code) . ' ' . strtoupper($item_name),
	    'T_THEME_PATH'	=> $tonjaw_root_path . $config['theme_path'],
	    'L_CODE'	=> $adm_lang['code'],
	    'L_ITEM'	=> $adm_lang['item'],
	    'L_QTY'	=> $adm_lang['quantity'],
	    'S_QTY'	=> generate_number_combo('qty', $config['max_qty'], $config['min_qty'], false, $lang['more_than'] . ' ' . $config['max_qty'], true, $item_qty ),
	    'L_APPROVE'	=> $adm_lang['update'],
	    'L_CANCEL'	=> $adm_lang['cancel'],
	    'L_CLOSE'	=> $adm_lang['close'],
	    'U_ACTION'	=> $tonjaw_admin_path."roomservice_buffer_detail.$phpEx?sid=$sid&mode=update&id=$bid&did=$did",
	    'ICON_PATH'	=> $tonjaw_root_path . $config['imageset_path'],
	    'S_UPDATE'	=> 1,
	    'U_CANCEL_URL'	=> $url_cancel,
	));
	
	$template->set_filenames(array(
	    'body' => 'admin_buffer_detail.tpl',
	));
	
	page_footer();
    
    }


    

}


// Count Service Item
$sql = 'SELECT COUNT(d.guest_services_detail_id) AS total_entries 
    FROM ' . GUEST_SERVICES_TABLE . " s, " . GUEST_SERVICES_DETAIL_TABLE . " d 
    WHERE s.guest_service_id=d.guest_service_id AND s.guest_service_id=$bid AND s.guest_service_type='" . $config['roomservice_buffer_type'] . "'";

$result = $db->sql_query($sql);
$service_count = (int) $db->sql_fetchfield('total_entries');
$db->sql_freeresult($result);

require($tonjaw_root_path . $config['pms_path'] . $pmsname . '.' . $phpEx);
$pms = new $pms_api();

$total_price = 0;
$total_price_nett = 0;

if ( $service_count > 0 )
{
    $sql = 'SELECT s.guest_reservation_id, s.guest_service_roomname, s.guest_service_guestname, s.guest_service_approved, s.guest_service_received, s.guest_service_received_date, sv.service_price, d.* 
	FROM ' . GUEST_SERVICES_TABLE . " s 
	LEFT JOIN " . GUEST_SERVICES_DETAIL_TABLE . " d ON s.guest_service_id=d.guest_service_id
	LEFT JOIN " . SERVICES_TABLE . " sv ON d.guest_service_code = sv.service_code
	WHERE s.guest_service_id=$bid AND s.guest_service_type='" . $config['roomservice_buffer_type'] . "'";

    //echo 'sql=' . $sql; exit; 
    $result = $db->sql_query($sql);

    while ($row = $db->sql_fetchrow($result))
    {
	/*$response = $pms->get_menu_item($row['guest_service_code']);
	if($response === TRUE) {
		$price_net = $pms->menu_data[0]['price_nett']; 
		$price_nett = $row['guest_service_qty'] * $price_net; 
	} else {
		$price_nett = 0;
	}*/
	$price_nett = $row['guest_service_qty'] * $row['guest_service_price']; 
	
	$price = $row['guest_service_qty'] * $row['service_price'];
	$total_price += $price;
	$total_price_nett += $price_nett;
	
	$resv_id 	= $row['guest_reservation_id'];
	$room_name 	= $row['guest_service_roomname'];
	$guest_name	= $row['guest_service_guestname'];
	$approved	= $row['guest_service_approved'];
	$not_received	= $row['guest_service_received'] ? 0 : 1;
	$received	= $row['guest_service_received'];
	$received_date	= $row['guest_service_received_date']; 
	$url_delete	= $tonjaw_admin_path . "roomservice_buffer_detail.$phpEx?sid=$sid&mode=delete&id=$bid&did=" . $row['guest_services_detail_id'];
	$url_update	= $tonjaw_admin_path . "roomservice_buffer_detail.$phpEx?mode=update&id=$bid&did=" . $row['guest_services_detail_id'];
	
	$template->assign_block_vars('buffer', array(
	    'U_CODE'		=> $row['guest_service_code'],
	    'U_QTY'		=> $row['guest_service_qty'],
	    'U_ITEM'		=> $row['guest_service_item'],
	    //'U_PRICE'		=> number_format($row['guest_service_price']),
		'U_PRICE'		=> number_format($price),
	    'U_NOTE'		=> $row['guest_service_note'],
	    'U_DELETE'		=> $url_delete,
	    'U_EDIT'		=> $url_update,
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
	'L_EDIT'	=> $adm_lang['edit'],
	'L_CLOSE'	=> $adm_lang['close'],
	'L_APPROVE'	=> $adm_lang['process'],
	'U_APPROVE_URL'	=> $tonjaw_admin_path."roomservice_buffer.$phpEx?sid=$sid&mode=approve&id=$bid",
	'L_DECLINE'	=> $adm_lang['decline'],
	'U_DECLINE_URL'	=> $tonjaw_admin_path."roomservice_buffer.$phpEx?sid=$sid&mode=decline&id=$bid",
	'ICON_PATH'	=> $tonjaw_root_path . $config['imageset_path'],
	'S_NOT_RECEIVED' => $not_received,
	'S_VIEW'	=> 1,
	'S_APPROVED'	=> $received,
	'L_APPROVE_DECLINE' => $approved_decline,
	'S_RECEIVED_DATE' => date($config['log_dateformat'], $received_date),
	'S_DELETE'	=> $module->user_priviledge[2],
	'L_SUBTOTAL'		=> strtoupper($adm_lang['subtotal']),
	'L_TOTAL'		=> strtoupper($adm_lang['total']),
	'U_PRICE'	=> number_format($total_price),
	'U_PRICE_NETT'	=> number_format($total_price_nett),
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