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

$u_action = $tonjaw_admin_path . 'module_subdetail.' . $phpEx .'?sid=' . $sid;
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
    $category_id = request_var('cat_id', '');
    $module_id = request_var('module_id', '');
    $enabled = request_var('enabled_flag', '');
    $enabled = $enabled == 'on' ? '1' : '0';
    
    $sql_ary = array(
	'module_detail_name'		=> (string) $name,
	'module_detail_file'		=> (string) $file,
	'module_detail_desc'		=> (string) $description,
	'module_detail_cat_id'		=> (int) $category_id,
	'module_id'			=> (int) $module_id,
	'module_detail_enabled'		=> (int) $enabled,
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

    if (empty(trim($category_id)))
    {
	$error = true;
	$error_msg = ($error_msg) ? $error_msg . '<br />' . $adm_lang['Error_empty_category'] : $adm_lang['Error_empty_category'];
    }
    
    if (empty($module_id))
    {
	//die($adm_lang['Error_confirm_password']);
	$error = true;
	$error_msg = ($error_msg) ? $error_msg . '<br />' . $adm_lang['Error_empty_module'] : $adm_lang['Error_empty_module'];
    }
}

if ($mode === 'add' && isset($_POST['submit']))
{
    if (!$error)
    {
	// Add new record
	$sql = 'INSERT INTO ' . MODULES_DETAIL_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	//echo $sql; exit;
	$db->sql_query($sql);
    
	redirect($config['admin_path'] . 'module_sub.' . $phpEx, $sid);
    
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
	    $sql = 'UPDATE ' . MODULES_DETAIL_TABLE . " SET " . 
	    
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE module_detail_id = " .  (int) $mid;
	    //echo $sql; exit;
	    $db->sql_query($sql);
	
	    redirect($config['admin_path'] . 'module_sub.' . $phpEx, $sid);
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
	$sql = "SELECT d.module_detail_name, d.module_detail_file, d.module_detail_desc, d.module_detail_enabled, m.module_id, m.module_name, c.module_detail_cat_id, c.module_detail_cat_name 
		FROM " . MODULES_DETAIL_TABLE . " d, " . MODULES_TABLE . " m, " . MODULES_DETAIL_CAT_TABLE . " c
		WHERE d.module_id=m.module_id 
		    AND d.module_detail_cat_id=c.module_detail_cat_id 
		    AND d.module_detail_id = $mid";
    
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
    'L_CATEGORY'	=> $adm_lang['category'],
    'L_MODULE'		=> $adm_lang['module'],
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
	    'S_NAME'		=> $data['module_detail_name'],
	    'S_FILE'		=> $data['module_detail_file'],
	    'S_DESCRIPTION'	=> $data['module_detail_desc'],
	    
	    'S_CATEGORY'	=> generate_module_category('cat_id', $data['module_detail_cat_id']),
	    'S_MODULE'		=> generate_module('module_id', $data['module_id']),
	    'L_SUBMIT'		=> $adm_lang['submit'],
	    'V_ENABLED'		=> ($data['module_detail_enabled'])? 'checked' : '',
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
	'body' => 'admin_module_subform.tpl',
));

page_footer();



?>