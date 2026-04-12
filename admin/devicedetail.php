<?php
/**
*
* admin/module_subdetail.php
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

$template->set_template();

$parent 	= request_var('parent', '');
$mode		= request_var('mode', '');
$sid 		= request_var('sid', '');
$modules		= request_var('module', '');
$mid		= request_var('id', '');

//echo $parent; exit;
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

$u_action = $tonjaw_admin_path . 'devicedetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    $name = utf8_normalize_nfc(request_var('name', ''));
    $device = utf8_normalize_nfc(request_var('device', ''));
    $node_id = request_var('node_id', '');
    $status = request_var('status', '');
    $status = $status == 'on' ? '1' : '0';
    $enabled = request_var('enabled_flag', '');
    $enabled = $enabled == 'on' ? '1' : '0';
    
    $sql_ary = array(
	'device_name'		=> (string) $name,
	'device_smartid'		=> (string) $device,
	'node_id'		=> (string) $node_id,
	'device_status'			=> (int) $status,
	'enabled'		=> (int) $enabled,
    );
    
   
}

if ($mode === 'add' && isset($_POST['submit']))
{
    if (!$error)
    {
	// Add new record
	$sql = 'INSERT INTO ' . DEVICE_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	// echo $sql; exit;
	$db->sql_query($sql);
    
	redirect($config['admin_path'] . 'device.' . $phpEx, $sid);
    
    }
    else
    {
	die($error_msg);
    }

}

if ($mode === 'update' || $mode === 'detail')
{
    $data = array();
    
    if (empty($mid))
    {
	$error = true;
	$error_msg = ($error_msg) ? $error_msg . '<br />' . $adm_lang['Error_missing_id'] : $adm_lang['Error_missing_id'];
    }
    
    $label = ($mode === 'update') ? $adm_lang['update_item'] : $adm_lang['view_item'];

    if (isset($_POST['submit']))
    {
	if (!$error)
	{
	    $sql = 'UPDATE ' . DEVICE_TABLE . " SET " . 
	    
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE device_id = " .  (int) $mid;
	    //echo $sql; exit;
	    $db->sql_query($sql);
	
	    redirect($config['admin_path'] . 'device.' . $phpEx, $sid);
	}
	else
	{
	    die($error_msg);
	}
	//
    }
    else
    {
	// Get module data for updating
	  $sql ="SELECT  a.device_id, a.device_name, a.device_smartid, a.node_id, a.enabled,a.device_status ,b.node_name from " . DEVICE_TABLE . " a JOIN " . NODES_TABLE . " b ON a.node_id = b.node_id where a.device_id = $mid group by  a.device_id, a.device_name, a.device_smartid, a.node_id, a.enabled,a.device_status ,b.node_name";
    
	///echo $sql; exit;
	$result = $db->sql_query($sql);
	$data = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	// print_r($data); exit;
    }
    
}

$label = (!$label) ? $adm_lang['add_item'] : $label;
adm_page_header($module->active_module_name);

$template->assign_vars(array(
    'HIDE_DISPLAY_SIDE_MENU'	=> $adm_lang['hide_display_side_menu'],
    'LOGIN_AS'			=> $adm_lang['login_as'],
    'USERNAME'			=> $session->username,
    'U_LOGOUT'			=> append_sid("{$tonjaw_admin_path}index.$phpEx") . '&amp;mode=logout',
    'L_LOGOUT'			=> $adm_lang['logout'],
    'MODULE_TITLE'		=> $module->active_module_name,
    'MODULE_DESC' 		=> $module->active_module_desc,
    'S_ADD_UPDATE'		=> $module->user_priviledge[1],
    'S_DELETE'			=> $module->user_priviledge[2],
    'L_NAME'		=> $adm_lang['device_name'],
    'L_FILE'		=> $adm_lang['target_file'],
    'L_DEVICE_ON'		=> $adm_lang['device_on'],
    'L_ENABLED'		=> $adm_lang['enabled'],
    'L_NODE'		=> $adm_lang['category'],
    'L_DEVICE_ID'		=> $adm_lang['device_id'],
    'L_LABEL'		=> $label,
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
	    'id'	=> $mid)
	);

	$template->assign_vars(array(
	    'S_FORM'		=> '1',
	    'U_ACTION'		=> $u_action,
	    'L_COMPOSE'		=> ($mode === 'add')?$adm_lang['add'] : $adm_lang['edit'],
	    'S_NAME'		=> $data['device_name'],
	    'S_FILE'		=> $data['module_detail_file'],
	    'S_DEVICE'	=> $data['device_smartid'],
	    'V_STATUS'		=> ($data['device_status'])? 'checked' : '',
	    
	    'S_CATEGORY'	=> generate_node_combo('node_id', $data['node_id'],$mode),
	    // 'S_MODULE'		=> generate_module('module_id', $data['module_id']),
	    'L_SUBMIT'		=> $adm_lang['submit'],
	    'V_ENABLED'		=> ($data['enabled'])? 'checked' : '',
	    'S_FORM_TOKEN'	=> $s_hidden_fields,
	));

	break;
	
    case 'detail':
	$template->assign_vars(array(
	    'S_DETAIL'		=> '1',
	    'L_COMPOSE'		=> $adm_lang['view'],
	    'S_NAME'		=> $data['module_detail_name'],
	    'S_FILE'		=> $data['module_detail_file'],
	    'S_DESCRIPTION'	=> $data['module_detail_desc'],
	    'S_CATEGORY'	=> $data['module_detail_cat_name'],
	    'S_MODULE'		=> $data['module_name'],
	    'S_ENABLED'		=> ($data['module_enabled'])? 'True' : 'False',
	    'L_EDIT'		=> $adm_lang['update'],
	    'U_EDIT'		=> append_sid("{$tonjaw_admin_path}module_subdetail.$phpEx", "mode=update") . '&amp;id=' .$mid . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
	));
	
	break;

    default:
	$error = true;
	$error_msg = ($error_msg) ? $error_msg . '<br />' . $adm_lang['Error_ilegal_mode'] : $adm_lang['Error_ilegal_mode'];
	
	break;
} 

$template->set_filenames(array(
	'body' => 'admin_devicedetail.tpl',
));

page_footer();



?>