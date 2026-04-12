<?php
/**
*
* admin/roomservice_buffer.php
*
* Roberto Tonjaw. Sep 2014
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

$session->session_begin($file[0]);

require($tonjaw_root_path . $config['include_path'] . 'functions_module.' . $phpEx);

// Instantiate new module
$module = new p_master();

$template->set_template();

// Instantiate module system and generate list of available modules
$module->list_modules($file[0]);

//Generate detail menu of the selected module
$module->list_modules_detail($file[0], $module->p_id);

// Assign data to the template engine for the list of modules
// We do this before loading the active module for correct menu display in trigger_error
$module->assign_tpl_vars(append_sid("{$tonjaw_admin_path}index.$phpEx"));

// Set up general vars
$mode	= request_var('mode', 'list');
$sid 	= request_var('sid', '');
$bid 	= request_var('id', '');
$sound 	= null;

$u_action = append_sid("{$tonjaw_admin_path}roomservice_buffer.$phpEx", "mode=update");

if ($mode === 'approve') //process
{
    //GRAB DATA
    $sql = 'SELECT * FROM ' . GUEST_SERVICES_TABLE . ' WHERE guest_service_id=' . $bid;
    $result = $db->sql_query($sql);
    
    $values = array();
    
    while ($row = $db->sql_fetchrow($result))
    {
	
	$values = array(
	    'service_id'	=> $row['guest_service_id'],
	    'resv_id'		=> $row['guest_reservation_id'],
	    'room_name'		=> $row['guest_service_roomname'],
	    'guest_name'	=> $row['guest_service_guestname'],
	    'outlet_id'		=> $pms_config['outlet_id'][0]['code'],
	);
    $room_name = $row['guest_service_roomname'];
    }
    
    $db->sql_freeresult($result);
    
    //Send it to PMS
    //print_r($values); exit;
    
    require($tonjaw_root_path . $config['pms_path'] . $pmsname . '.' . $phpEx);
    $pms	= new $pms_api();
    $pms->post_charge($values);
    
    //print_r($values);
    //echo '<p>' . $tonjaw_root_path . $config['pms_path'] . $pmsname . '.' . $phpEx; exit;
    
     $sql = 'UPDATE ' . GUEST_SERVICES_TABLE . ' SET guest_service_received=1, guest_service_approved=1, guest_service_received_date=' . time() . ' WHERE guest_service_id=' . $bid;
  
    $db->sql_query($sql);
	
	//Send notification to guest via running text
	$sql = "SELECT room_id, zone_id FROM ".ROOMS_TABLE." WHERE room_name = '".$room_name."' AND room_enabled = 1";
	$result = $db->sql_query($sql);
	while($row = $db->sql_fetchrow($result)) {
		$room_id = $row['room_id'];
		$zone_id = $row['zone_id'];
	}
	
	$start = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
	$end = mktime(date("H"), date("i")+1, date("s"), date("m"), date("d"), date("Y"));
	$sql_ary = array(
		'message_global'			=> 0,
		'message_enabled'			=> 1,
		'message_schedule_start'	=> (int) $start,
		'message_schedule_end'	=> (int) $end,
     );
	$sql = 'INSERT INTO ' . RUNNINGTEXT_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	//echo $sql; exit;
	$db->sql_query($sql);
	$mid = $db->sql_nextid();
	
	$sql_ary = array(
	    'message_id'	=> $mid,
	    'room_id'		=> $room_id,
	);
	    
	$sql = 'INSERT INTO ' . RUNNINGTEXT_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	//echo $sql . 'master<p>'; //exit;
	$db->sql_query($sql);
	
	$sql_ary = array(
	    'message_id'	=> $mid,
	    'zone_id'		=> $zone_id,
	);
	    
	$sql = 'INSERT INTO ' . RUNNINGTEXT_ZONE_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	    //echo $sql . 'master<p>'; //exit;
	$db->sql_query($sql);
	
	
    $lang_data = array();
    $lang_count = 0;
    $start = view_langs($lang_data, $lang_count);

    $sql_translation 	= array();
    $i = 0;
    foreach($lang_data as $row)
    {
		$lang_id = $row['id'];
		
		require($tonjaw_root_path . $config['language_path'] . $lang_id . '.' . $phpEx);
		
		$title = $lang['roomservice_process_confirmation'];
		
		$sql_translation = array(
			'message_id'		=> (int) $mid,
			'translation_message'	=> (string) $title,
			'language_id'		=> (string) $lang_id,
		);
		
		//if ($mode === 'add')
		if ( empty($translation_id) )
		{
			$sql = 'INSERT INTO ' . RUNNINGTEXT_TRANSLATIONS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_translation);
			
		}
		
		//echo '<p>lang: ' . $sql; exit; 
		$db->sql_query($sql);
	
    }
	
	
	

    redirect($config['admin_path'] . 'roomservice_buffer.' . $phpEx, $sid);
}

if ($mode === 'decline') //decline
{
    $sql = 'UPDATE ' . GUEST_SERVICES_TABLE . ' SET guest_service_received=1, guest_service_approved=0, guest_service_received_date=' . time() . ' WHERE guest_service_id=' . $bid;
    $db->sql_query($sql);
    
    redirect($config['admin_path'] . 'roomservice_buffer.' . $phpEx, $sid);
}

if ($mode === 'delete') //process
{
    $sql = 'DELETE FROM ' . GUEST_SERVICES_TABLE . ' 
	WHERE guest_service_id=' . $bid;
    $db->sql_query($sql);
    
    $sql = 'DELETE FROM ' . GUEST_SERVICES_DETAIL_TABLE . ' 
	WHERE guest_service_id=' . $bid;
    $db->sql_query($sql);

    
    redirect($config['admin_path'] . 'roomservice_buffer.' . $phpEx, $sid);
}

//GRAB BUFFER DATA
$buffer_data = array();
$buffer_count = 0;

$start = view_buffers($buffer_data, $buffer_count, $config['roomservice_buffer_type']);


// Generate the page
adm_page_header($module->active_module_name);

foreach ($buffer_data as $row)
{
    //$data = array();
    //$button_flag = ($row['approved'] == 1 ) ? 'Yes' : 'No';
    //$sound = ($row['approved'] == 1 ) ? true : false;
    if ( $row['approved'] == 0  )
    {
	$sound = true;
    }
    
    // Count Service Item
    $sql = 'SELECT COUNT(guest_services_detail_id) AS total_entries 
	FROM ' . GUEST_SERVICES_DETAIL_TABLE . " WHERE guest_service_id=". $row['id'];

    $result = $db->sql_query($sql);
    $service_count = (int) $db->sql_fetchfield('total_entries');
    $db->sql_freeresult($result);
    
    $url = $tonjaw_admin_path . "roomservice_buffer_detail.$phpEx?mode=list&sid=$sid&id=" . $row['id'];
    
    $template->assign_block_vars('buffer', array(
	'DATETIME'		=> date($config['log_dateformat'], $row['id']),
	'ROOM'			=> $row['room_name'],
	'NAME'			=> prepare_message($row['guest_name']),
	'RESV_ID'		=> $row['resv_id'],
	'ITEM'			=> $service_count,
	'QTY'			=> $row['qty'],
	'NOTE'			=> prepare_message($row['note']),
	'U_UPDATE'		=> append_sid("{$tonjaw_admin_path}roomservice_buffer.$phpEx", "mode=update") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_UPDATE'		=> $adm_lang['edit'],
	'L_DELETE'		=> $adm_lang['delete'],
	'S_NOT_APPROVED'	=> ($row['approved'] == 0 ) ? 1 : null,
	'APPROVED'		=> ($row['approved'] == 1 ) ? 'Yes' : 'No',
	'S_NOT_RECEIVED'	=> ($row['received'] == 0 ) ? 1 : null,
	'RECEIVED'		=> ($row['received'] == 1 ) ? 'Yes' : 'No',
	'U_RECEIVED'		=> append_sid("{$tonjaw_admin_path}roomservice_buffer.$phpEx", "mode=approve") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'U_DELETE'		=> append_sid("{$tonjaw_admin_path}roomservice_buffer.$phpEx", "mode=delete") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_RECEIVED'		=> $adm_lang['process'],
	'ICON_PATH'		=> $tonjaw_root_path . $config['imageset_path'],
	'U_URL'			=> $url,
    ));
}

$template->assign_vars(array(
    'HIDE_DISPLAY_SIDE_MENU'	=> $adm_lang['hide_display_side_menu'],
    //'T_LOG_JS_PATH'		=> $tonjaw_root_path . $config['js_path'] . 'log.js',
    'LOGIN_AS'			=> $adm_lang['login_as'],
    'USERNAME'			=> $session->username,
    'U_LOGOUT'			=> append_sid("{$tonjaw_admin_path}index.$phpEx") . '&amp;mode=logout',
    'L_LOGOUT'			=> $adm_lang['logout'],
    'MODULE_TITLE'		=> $module->active_module_name,
    'MODULE_DESC' 		=> $module->active_module_desc,
    'U_ACTION'			=> $u_action,
    //'L_TITLE'			=> $adm_lang['users_online'] . $config['session_length']/3600 . ' hour',
    'S_ADD_UPDATE'		=> $module->user_priviledge[1],
    'S_DELETE'			=> $module->user_priviledge[2],
    'S_DATATABLE_NODES'		=> '1',
    'S_FOURTH_FIELD'		=> '1',
    'S_FIFTH_FIELD'		=> '1',
    'S_SEVENTH_FIELD'		=> '1',
    'S_EIGHT_FIELD'		=> '1',
    'S_NINTH_FIELD'		=> '1',
    'S_SOUND'			=> $sound,
    'T_MEDIA_AUDIO_PATH'	=> $tonjaw_root_path . $config['media_path'] . $config['audio_path'],
    'L_DATETIME'		=> $adm_lang['datetime'],
    'L_ROOM'			=> $adm_lang['room'],
    'L_NAME'			=> $adm_lang['guest_name'],
    'L_ITEM'			=> $adm_lang['item'],
    'L_QTY'			=> $adm_lang['quantity'],
    'L_NOTE'			=> $adm_lang['note'],
    'L_APPROVED'		=> $adm_lang['approved'],
    'L_DETAIL'			=> $adm_lang['detail'],
    'L_RECEIVED'		=> $adm_lang['received'],
    'L_DELETE'			=> $adm_lang['delete'],
    'S_BUFFERS'			=> ($buffer_count > 0),
    'S_IN_BUFFERS'		=> '1',
    'L_SUBMIT'			=> $adm_lang['process'],
    'L_CONFIRM_PROCESS'		=> $adm_lang['confirm_process'],
    
    ));

$template->set_filenames(array(
	'body' => 'admin_buffer.tpl',
));

//add_log($adm_lang['read']);
page_footer();
?>
