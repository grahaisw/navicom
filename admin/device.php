<?php
/**
*
* admin/module_sub.php
*
* Roberto Tonjaw. Jan 2014
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
$mode		= request_var('mode', 'list');
$sid 		= request_var('sid', '');

$u_action = append_sid("{$tonjaw_admin_path}device.$phpEx", "mode=update");

//GRAB MODULE DETAIL DATA
$device_data = array();
$device_count = 0;
//$sql_sort = 'log_time DESC';
$start = view_device($device_data, $device_count);

if ($mode === 'update')
{

}

if (isset($_GET['id']) && $mode === 'delete')
{
    $mid	= request_var('id', '');
    
    $sql = 'DELETE FROM ' . DEVICE_TABLE . ' WHERE device_id = ' . (int) $mid;
    $db->sql_query($sql);
    
    redirect($config['admin_path'] . 'device.' . $phpEx, $sid);
    // echo 'ready to wipe out ID: ' . $nid . '</br>SQL: ' . $sql; exit;
}

//echo 'priviledge: ' . $module->user_priviledge; exit;
// Generate the page
adm_page_header($module->active_module_name);

foreach ($device_data as $row)
{
    //$data = array();
    $template->assign_block_vars('device', array(
	'NAME'			=> $row['name'],
	'NODE'		=> $row['node'],
	'DEVICE_ID'		=> $row['smartid'],
	'STATUS'		=> ($row['status']) ? 'On' : 'Off',
	'ENABLED'		=> ($row['enabled']) ? 'Yes' : 'No',
	'S_MID'			=> $row['id'],
	'V_STATUS'		=> ($row['status'])? 'checked' : '',
	'V_ENABLED'		=> ($row['enabled'])? 'checked' : '',
	
	'U_DETAIL'		=> append_sid("{$tonjaw_admin_path}devicedetail.$phpEx", "mode=detail") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,

	'U_UPDATE'		=> append_sid("{$tonjaw_admin_path}devicedetail.$phpEx", "mode=update") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_UPDATE'		=> $adm_lang['edit'],
	'U_DELETE'		=> append_sid("{$tonjaw_admin_path}device.$phpEx", "mode=delete") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_DELETE'		=> $adm_lang['delete'],
	'ICON_PATH'		=> $tonjaw_root_path . $config['imageset_path'],
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
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}devicedetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '1',
    'S_THIRD_FIELD'		=> '1',
    'S_FOURTH_FIELD'		=> '1',
    'S_FIFTH_FIELD'		=> '1',
    'S_SEVENTH_FIELD'		=> '1',
    'L_DEVICE_NAME'			=> $adm_lang['device_name'],
    'L_NODE'				=> $adm_lang['node_name'],
    'L_STATUS'				=> $adm_lang['device_status'],
    'L_DEVICE_ID'			=> $adm_lang['device_id'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'S_DEVICE'			=> ($device_count > 0),
    'L_SUBMIT'			=> $adm_lang['submit'],
    'L_CONFIRM_DELETE'		=> $adm_lang['confirm_delete'],
));

$template->set_filenames(array(
	'body' => 'admin_device.tpl',
));

//add_log($adm_lang['read']);
page_footer();

?>