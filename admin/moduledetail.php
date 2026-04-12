<?php
/**
*
* admin/moduledetail.php
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
$modules	= request_var('module', '');
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

$u_action = $tonjaw_admin_path . 'moduledetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    $name = utf8_normalize_nfc(request_var('name', ''));
    $file = utf8_normalize_nfc(request_var('file', ''));
    $description = utf8_normalize_nfc(request_var('description', ''));
    $in_admin = request_var('in_admin_flag', '');
    $order = request_var('order', '');
    $enabled = request_var('enabled_flag', '');
    
    $in_admin = $in_admin == 'on' ? '1' : '0';
    $enabled = $enabled == 'on' ? '1' : '0';
    
    $sql_ary = array(
	'module_name'		=> (string) $name,
	'module_file'		=> (string) $file,
	'module_description'	=> (string) $description,
	'module_in_admin'	=> (int) $in_admin,
	'module_order'		=> (int) $order,
	'module_enabled'	=> (int) $enabled,
    );
    
    if (empty(trim($name)))
    {
	$error = true;
	$error_msg = ($error_msg) ? $error_msg . '<br />' . $adm_lang['Error_empty_module_name'] : $adm_lang['Error_empty_module_name'];
    }
    
    if (empty($file))
    {
	//die($adm_lang['Error_confirm_password']);
	$error = true;
	$error_msg = ($error_msg) ? $error_msg . '<br />' . $adm_lang['Error_empty_file'] : $adm_lang['Error_empty_file'];
    }
   
}

if ($mode === 'add' && isset($_POST['submit']))
{
    if (!$error)
    {
	// Add new record
	$sql = 'INSERT INTO ' . MODULES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	//echo $sql; exit;
	$db->sql_query($sql);
    
	redirect($config['admin_path'] . 'module.' . $phpEx, $sid);
    
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
	    $sql = 'UPDATE ' . MODULES_TABLE . " SET " . 
	    
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE module_id = " .  (int) $mid;
	    //echo $sql; exit;
	    $db->sql_query($sql);
	
	    redirect($config['admin_path'] . 'module.' . $phpEx, $sid);
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
	$sql = "SELECT * 
		FROM " . MODULES_TABLE . "  
		WHERE module_id = $mid";
    
	///echo $sql; exit;
	$result = $db->sql_query($sql);
	$data = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
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
    'L_NAME'		=> $adm_lang['module'],
    'L_FILE'		=> $adm_lang['target_file'],
    'L_DESCRIPTION'	=> $adm_lang['description'],
    'L_ENABLED'		=> $adm_lang['enabled'],
    'L_IN_ADMIN'	=> $adm_lang['in_admin'],
    'L_ORDER'		=> $adm_lang['order'],
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
	    'S_NAME'		=> $data['module_name'],
	    'S_FILE'		=> $data['module_file'],
	    'S_ORDER'		=> $data['module_order'],
	    'S_DESCRIPTION'	=> $data['module_description'],
	    'V_IN_ADMIN'	=> ($data['module_in_admin'])? 'checked' : '',
	    'L_SUBMIT'		=> $adm_lang['submit'],
	    'V_ENABLED'		=> ($data['module_enabled'])? 'checked' : '',
	    'S_FORM_TOKEN'	=> $s_hidden_fields,
	));

	break;
	
    case 'detail':
	$template->assign_vars(array(
	    'S_DETAIL'		=> '1',
	    'L_COMPOSE'		=> $adm_lang['view'],
	    'S_NAME'		=> $data['module_name'],
	    'S_FILE'		=> $data['module_file'],
	    'S_ORDER'		=> $data['module_order'],
	    'S_DESCRIPTION'	=> $data['module_description'],
	    'S_ENABLED'		=> ($data['module_enabled'])? 'True' : 'False',
	    'S_IN_ADMIN'	=> ($data['module_in_admin'])? 'True' : 'False',
	    'L_EDIT'		=> $adm_lang['update'],
	    'U_EDIT'		=> append_sid("{$tonjaw_admin_path}moduledetail.$phpEx", "mode=update") . '&amp;id=' .$mid . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
	));
	
	break;

    default:
	$error = true;
	$error_msg = ($error_msg) ? $error_msg . '<br />' . $adm_lang['Error_ilegal_mode'] : $adm_lang['Error_ilegal_mode'];
	
	break;
} 

$template->set_filenames(array(
	'body' => 'admin_moduleform.tpl',
));

page_footer();



?>