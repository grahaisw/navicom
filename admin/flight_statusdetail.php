<?php
/**
*
* admin/flight_statusdetail.php
*
* Agnes Emanuella. Oct 2017
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
$modules	= request_var('module', '');
$aid		= request_var('id', '');

$session->session_begin($parent);

require($tonjaw_root_path . $config['include_path'] . 'functions_module.' . $phpEx);

// Instantiate new module
$module = new p_master();

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

$u_action = $tonjaw_admin_path . 'flight_statusdetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    //$title = utf8_normalize_nfc(request_var('title', ''));
    //$description = utf8_normalize_nfc(request_var('description', ''));
    $enabled_flag = request_var('enabled_flag', '');
    $enabled_flag = $enabled_flag == 'on' ? '1' : '0';
    $display_flag = request_var('display_flag', '');
	$display_flag = $display_flag == 'on' ? '1' : '0';
    $remark = utf8_normalize_nfc(request_var('remark', '', true));
    $display_mode = request_var('display_mode', '');
    $display_period = request_var('display_period', '');
    $priority = request_var('priority', '', true);
    $duration = request_var('duration', '', true);
    $ended_in = request_var('ended_in', '', true);
    
    if(empty($remark))
    {
	$error = true;
	$error_msg = 'Flight Status Remark field cannot be left empty.';
	
	die($error_msg);
    }
    else
    {
	$sql_ary = array(
	    'airport_flight_status_enabled'			=> (int) $enabled_flag,
	    'airport_flight_status_remark'			=> (string) $remark,
	    'airport_flight_status_priority'		=> (int) $priority,
		'airport_flight_status_display_on_tv'	=> (int) $display_flag,
		'airport_flight_status_display_mode'	=> $display_mode,
		'airport_flight_status_duration'		=> (int) $duration,
		'airport_flight_status_display_period'	=> $display_period,
		'airport_flight_status_ended_in'		=> (int) $ended_in,
	);

	if ($mode === 'add')
	{
	  
	    $sql = 'INSERT INTO ' . AIRPORT_FLIGHT_STATUS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	    
	    //echo $sql . 'master<p>'; exit;
	    $db->sql_query($sql);
	    
	}
	
	if ($mode === 'update')
	{
	    $sql = 'UPDATE ' . AIRPORT_FLIGHT_STATUS_TABLE . " SET " . 
		$db->sql_build_array('UPDATE', $sql_ary) .
		" WHERE airport_flight_status_id = $aid";
	    
	    $db->sql_query($sql);
	    
	}
    
    }
    
   
     redirect($config['admin_path'] . 'flight_status.' . $phpEx, $sid);
}

$detail_data = array();

if ($mode === 'update' || $mode === 'detail')
{
    if (empty($aid))
    {
	die('Missing Airport ID.');
    }
    
    $label = ($mode === 'update') ? $adm_lang['update_item'] : $adm_lang['view_item'];

    $data = array();
    
    // Get Airport data for updating
    $sql = 'SELECT * FROM ' . AIRPORT_FLIGHT_STATUS_TABLE . " WHERE airport_flight_status_id=" . (int) $aid;
    
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
	
	
}

if(!empty($data['airport_flight_status_display_period']) && $data['airport_flight_status_display_period'] == "time") {
	$display2 = 'display:table-row';
} else {
	$display2 = 'display:none';
}

if($data['airport_flight_status_display_mode'] == "popup" || $data['airport_flight_status_display_mode'] == "fullscreen") {
	$display3 = 'display:table-row';
} else {
	$display3 = 'display:none';
}


$label = (!$label) ? $adm_lang['add_item'] : $label;
adm_page_header($module->active_module_name);

$template->assign_vars(array(
     'HIDE_DISPLAY_SIDE_MENU'	=> $adm_lang['hide_display_side_menu'],
    //'T_LOG_JS_PATH'		=> $tonjaw_root_path . $config['js_path'] . 'log.js',
    'LOGIN_AS'			=> $adm_lang['login_as'],
    'USERNAME'			=> $session->username,
    'U_LOGOUT'			=> append_sid("{$tonjaw_admin_path}index.$phpEx") . '&amp;mode=logout',
    'L_LOGOUT'			=> $adm_lang['logout'],
    'MODULE_TITLE'		=> $module->active_module_name,
    'MODULE_DESC' 		=> $module->active_module_desc,
    'L_REMARK'			=> $adm_lang['remark'],
    'L_PRIORITY'		=> $adm_lang['priority'],
    'L_DISPLAY_ON_TV'	=> $adm_lang['display_on_tv'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'L_LABEL'			=> $label,
    'S_REMARK'			=> $data['airport_flight_status_remark'],
    'S_PRIORITY'		=> $data['airport_flight_status_priority'],
    'L_DISPLAY_MODE'	=> $adm_lang['display_mode'],
    'L_DISPLAY_PERIOD'	=> $adm_lang['display_period'],
    'L_DURATION'		=> $adm_lang['duration'],
    'L_END'				=> $adm_lang['ended_in'],
    'L_PICK'			=> $adm_lang['pick'],
	'S_DATETIME_PICKER'	=> 1,
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
	    'id'	=> $aid)
	);

	$template->assign_vars(array(
	    'S_FORM'		=> '1',
	    'U_ACTION'		=> $u_action,
	    'L_COMPOSE'		=> ($mode === 'add')?$adm_lang['add'] : $adm_lang['edit'],
	    'L_SUBMIT'		=> $adm_lang['submit'],
	    'V_ENABLED'		=> ($data['airport_flight_status_enabled'])? 'checked' : '',
	    'V_DISPLAY_ON_TV'	=> ($data['airport_flight_status_display_on_tv'])? 'checked' : '',
	    'S_FORM_TOKEN'	=> $s_hidden_fields,
		'S_DISPLAY'		=> ($data['airport_flight_status_display_on_tv']) ? 'display:table-row' : 'display:none',
		'S_DISPLAY_2'		=> $display2,
		'S_DISPLAY_3'		=> $display3,
		'S_DISPLAY_MODE'	=> generate_displaymode_combo('display_mode', $data['airport_flight_status_display_mode']),
		'S_DISPLAY_PERIOD'	=> generate_displayperiod_combo('display_period', $data['airport_flight_status_display_period']),
		'S_ENDED_IN'		=> $data['airport_flight_status_ended_in'],
		'S_DURATION'		=> $data['airport_flight_status_duration'],
		//'V_DISPLAY_ON_TV'	=> ($data['airport_flight_status_display_on_tv'])? 'checked' : '',
	));

	break;
	
    case 'detail':
	$template->assign_vars(array(
	    'S_DETAIL'		=> '1',
	    'L_COMPOSE'		=> $adm_lang['view'],
	    'S_ENABLED'		=> ($data['airport_flight_status_enabled'])? 'True' : 'False',
	    'S_DISPLAY_ON_TV'	=> ($data['airport_flight_status_display_on_tv'])? 'True' : 'False',
	    'L_EDIT'		=> $adm_lang['update'],
	    'U_EDIT'		=> append_sid("{$tonjaw_admin_path}flight_statusdetail.$phpEx", "mode=update") . '&amp;id=' .$aid . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
	));
	
	break;

    default:
	$error = true;
	$error_msg = ($error_msg) ? $error_msg . '<br />' . $adm_lang['Error_ilegal_mode'] : $adm_lang['Error_ilegal_mode'];
	
	break;
} 




$template->set_filenames(array(
	'body' => 'admin_flight_statusform.tpl',
));

page_footer();


?>