<?php
/**
*
* admin/groupdetail.php
*
* Roberto Tonjaw. May 2014
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

$parent 	= request_var('parent', '');
$mode		= request_var('mode', '');
$sid 		= request_var('sid', '');
$module		= request_var('module', '');
$resv_id	= request_var('id', '');
$arrival_date	= time();

$session->session_begin($parent);

require($tonjaw_root_path . $config['include_path'] . 'functions_module.' . $phpEx);
//require($tonjaw_root_path . $config['pms_path'] . $pmsname . '.' . $phpEx);

// Instantiate new module
$module = new p_master();
//$pms	= new $pms_api();

$template->set_template();

// Instantiate module system and generate list of available modules
$module->list_modules($parent);

//Generate detail menu of the selected module
$module->list_modules_detail($parent, $module->p_id);

// Assign data to the template engine for the list of modules
// We do this before loading the active module for correct menu display in trigger_error
$module->assign_tpl_vars(append_sid("{$tonjaw_admin_path}index.$phpEx"));

//$flag_file 	= '0';
$error = '';
$error_msg = '';

//$u_action = $tonjaw_admin_path . 'guestdetail.' . $phpEx .'?sid=' . $sid;
 
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    $firstname = utf8_normalize_nfc(request_var('firstname', ''));
    $lastname = utf8_normalize_nfc(request_var('lastname', ''));
    $fullname = utf8_normalize_nfc(request_var('fullname', ''));
    $room_name = request_var('room_name', '');
    $group = utf8_normalize_nfc(request_var('guest_groups_name', ''));
    $salutation = request_var('salutation', '');
    $resv_id = request_var('resv_id', 0);
    $arrival_date = strtotime(request_var('startdatetime', ''));
    $permanent_guest = request_var('permanent', '');
    $permanent_guest = $permanent_guest == 'on' ? '1' : '0' ;
    
    $sql_ary = array(
	'guest_reservation_id'	=> (int) $resv_id,
	'guest_arrival_date'	=> (int) $arrival_date,
	'guest_firstname'	=> (string) $firstname,
	'guest_lastname'	=> (string) $lastname,
	'guest_fullname'	=> (string) $fullname,
	'guest_salutation'	=> (string) $salutation,
	//'guest_room_share'	=> (string) $this->guest_data['room_share'],
	'room_name'		=> (string) $room_name,
	'guest_groupname'	=> (string) $group,
	'guest_permanent'	=> (int) $permanent_guest,
    );

}

if ($mode === 'add' && isset($_POST['submit']))
{
    //validate Resv ID
    $sql = 'SELECT room_name FROM ' . GUESTS_TABLE . " WHERE guest_reservation_id=" . $resv_id;
    $result = $db->sql_query($sql);
    $guests_exist = $db->sql_fetchfield('room_name');
    $db->sql_freeresult($result);
    
    if( !empty($guests_exist) || empty($resv_id) )
    {
	die('Resv ID is already exist or empty!');
    }
    
    $sql = 'INSERT INTO ' . GUESTS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
    
    //echo $sql; exit;
    $db->sql_query($sql);
    
    $key = md5($resv_id . '*' . $room_name);
	
	$sql = 'UPDATE ' . ROOMS_TABLE . " SET room_key='" . $key . "' WHERE room_name='" . $room_name . "'";
	$db->sql_query($sql);
    
    // Check room share
    $room_share = set_roomshare($room_name);
    
    redirect($config['admin_path'] . 'guest.' . $phpEx, $sid);
    
}

if ( $mode === 'checkout' )
{
    
   $room_name = request_var('room_name', '');
    
    if ( empty($resv_id) && empty($room_name) )
    {
	die('Missing Resv ID and Room Name');
    }
    
    // remove the record from guest table
	$sql = 'DELETE FROM ' . GUESTS_TABLE . " 
	    WHERE guest_reservation_id=" . $resv_id;
	$db->sql_query($sql);
	
	// remove guest's message
	$sql = 'DELETE FROM ' . GUEST_MESSAGES_TABLE . " 
	    WHERE guest_reservation_id=" . $resv_id;
	$db->sql_query($sql);
	
	// remove guest's bill
	$sql = 'DELETE FROM ' . GUEST_BILLS_TABLE . " 
	    WHERE guest_reservation_id=" . $resv_id;
	$db->sql_query($sql);
	
	//set the guest share status
	$sql = 'UPDATE ' . GUESTS_TABLE . " SET guest_room_share=0 
	    WHERE room_name='" . $room_name . "'";
	$db->sql_query($sql);
    
    redirect($config['admin_path'] . 'guest.' . $phpEx, $sid);
    
}

if ($mode === 'update' || $mode === 'detail')
{
    $data = array();
    
    if (empty($resv_id))
    {
	die('Missing Resv ID. Cannot update Guest Table.');
    }

    if (isset($_POST['submit']))
    {
	$old_room = request_var('old_room', '');
	
	$sql = 'UPDATE ' . GUESTS_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE guest_reservation_id = " .  (int) $resv_id;
	
	$db->sql_query($sql);
	
	// Check room share
	$room_share = set_roomshare($room_name, $old_room);
	
	redirect($config['admin_path'] . 'guest.' . $phpEx, $sid);
	//echo $sql; exit;
    }
    else
    {
	$sql = 'SELECT * FROM ' . GUESTS_TABLE . " WHERE guest_reservation_id = " .  (int) $resv_id;
    
	//echo $sql; exit;
	$result = $db->sql_query($sql);
	$data = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	
	$arrival_date = $data['guest_arrival_date'];

    }
}

adm_page_header($module->active_module_name);

$template->assign_vars(array(
    'HIDE_DISPLAY_SIDE_MENU'	=> $adm_lang['hide_display_side_menu'],
    'LOGIN_AS'			=> $adm_lang['login_as'],
    'USERNAME'			=> $session->username,
    'U_LOGOUT'			=> append_sid("{$tonjaw_admin_path}index.$phpEx") . '&amp;mode=logout',
    'L_LOGOUT'			=> $adm_lang['logout'],
    'MODULE_TITLE'		=> $module->active_module_name,
    'MODULE_DESC' 		=> $module->active_module_desc,
    'U_ACTION'			=> append_sid("{$tonjaw_admin_path}guestdetail.$phpEx"),
    'L_RESV_ID'			=> $adm_lang['reservation_id'],
    'S_RESV_ID'			=> $data['guest_reservation_id'],
    'L_ROOM'			=> $adm_lang['room'],
    'L_PERMANENT_GUEST'		=> $adm_lang['permanent_guest'],
    'V_PERMANENT_GUEST'		=> ($data['permanent_guest'])? 'checked' : '',
    'L_FIRSTNAME'		=> $adm_lang['firstname'],
    'S_FIRSTNAME'		=> $data['guest_firstname'],
    'L_LASTNAME'		=> $adm_lang['lastname'],
    'S_LASTNAME'		=> $data['guest_lastname'],
    'L_FULLNAME'		=> $adm_lang['fullname'],
    'S_FULLNAME'		=> $data['guest_fullname'],
    'L_SALUTATION'		=> $adm_lang['salutation'],
    'S_SALUTATION'		=> $data['guest_salutation'],
    'L_GROUP'			=> $adm_lang['group'],
    'S_GROUP'			=> generate_guestgroup_combo('guest_groups_name', $data['guest_groupname']),
    'L_ARRIVAL_DATE'		=> $adm_lang['arrival_date'],
    'S_ARRIVAL_DATE'		=> date("Y/m/d H:i", $arrival_date),
    'S_DATETIME_PICKER'		=> '1',
    'L_PICK'			=> $adm_lang['pick'],
));

switch( $mode )
{
    case 'update':
    case 'add':

	$s_hidden_fields = build_hidden_fields(array(
	    'parent'	=> $parent,
	    'mode'	=> $mode,
	    'sid'	=> $sid,
	    'module'	=> $modules,
	    'id'	=> $resv_id,
	    'old_room'	=> $data['room_name'])
	);


	$template->assign_vars(array(
   
	    'S_FORM'		=> '1',
	    'S_ROOM'		=> generate_room_combo('room_name', $data['room_name']),
	    'L_SUBMIT'		=> $adm_lang['submit'],
	    'S_FORM_TOKEN'	=> $s_hidden_fields,
	));
	
	break;
	
    case 'detail':
    
	//GET GUEST BILL
	$pms->get_guest_bill($resv_id, $data['room_name']);
	//GET MESSAGE COUNT
	$message_count = $pms->get_message_count($resv_id);
	//print_r( $pms->bill_data ); exit;
	//$tes = $pms->get_message_all($resv_id);
	//$tes = $pms->message_sync($resv_id);
	
	$template->assign_vars(array(
	    'S_DETAIL'		=> '1',
	    'S_ROOM'		=> $data['room_name'],
	    'S_ADD_UPDATE'	=> $module->user_priviledge[1],
	    'L_CHECKOUT'	=> $adm_lang['check_out'],
	    'U_CHECKOUT'	=> append_sid("{$tonjaw_admin_path}guestdetail.$phpEx", "mode=checkout") . 
		'&amp;id=' . $resv_id . '&amp;room=' . $data['room_name'] . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
	    'U_ADD'		=> append_sid("{$tonjaw_admin_path}guestdetail.$phpEx", "mode=update") . 
		'&amp;id=' . $resv_id . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['edit'],
	    'L_MESSAGE_COUNT'	=> $adm_lang['message'],
	    'S_MESSAGE_COUNT'	=> $message_count,
	    'S_PERMANENT_GUEST'	=> ($data['permanent_guest'])? 'True' : 'False',
	    'L_GUEST_BILL'	=> $adm_lang['guest_bill'],
	    'L_NO'		=> $adm_lang['no'],
	    'L_DATE'		=> $adm_lang['date'],
	    'L_DESCRIPTION'	=> $adm_lang['description'],
	    'L_CREDIT'		=> $adm_lang['credit'],
	    'L_DEBIT'		=> $adm_lang['debit'],
	    'L_TOTAL_BALANCE'	=> $adm_lang['total_balance'],
	    'L_CURRENCY'	=> $config['currency'],
	    'S_TOTAL_BALANCE'	=> $pms->bill_data['total_balance'],
	    'S_BILLS'		=> ($pms->bill_data['bill_count'] > 0),
	    'L_SEND_MESSAGE'	=> $adm_lang['send_message'],
	    'U_SEND_MESSAGE'	=> append_sid("{$tonjaw_admin_path}guest_send_message.$phpEx", "mode=form") . 
		'&amp;id=' . $resv_id . '&amp;guest=' . $data['guest_fullname'] . '&amp;room=' . $data['room_name'] . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
	));

	$i = 1;
	foreach ($pms->bill_data as $row)
	{
	    //$data = array();
	    if ( !empty($row['date']) ) 
	    {

		$template->assign_block_vars('bill', array(
		    'S_NO'		=> $i,
		    'S_DATE'		=> date($config['log_dateformat'], $row['date']),
		    'S_DESCRIPTION'	=> $row['item'],
		    'S_CREDIT'		=> $row['credit'],
		    'S_DEBIT'		=> $row['debit'],
		));
		
		$i++;
	    }
	    
	}

	break;

} 
 
$template->set_filenames(array(
	'body' => 'admin_guestform.tpl',
));

page_footer();


?>