<?php
/**
*
* admin/groupdetail.php
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
$gid		= request_var('id', '');

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
 
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    $group_name = utf8_normalize_nfc(request_var('name', ''));
    $group_description = utf8_normalize_nfc(request_var('description', ''));
    $group_disabled = request_var('enabled_flag', '');
    $group_disabled = $group_disabled == 'on' ? '1' : '0' ;
    
    $sql_ary = array(
	'user_group_name'		=> (string) $group_name,
	'user_group_description'	=> (string) $group_description,
	'user_group_enabled'		=> (int) $group_disabled,
    );
    
    //$parent_parameter = $sid . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,;
}

if ($mode === 'add' && isset($_POST['submit']))
{
    
    $sql = 'INSERT INTO ' . USER_GROUPS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);

    $db->sql_query($sql);
    
    redirect($config['admin_path'] . 'group.' . $phpEx, $sid);
    //echo $sql; exit;
}

if ($mode === 'update')
{
    $data = array();
    
    if (empty($gid))
    {
	die('Missing Group ID. Cannot update User Group Table.');
    }

    $label = ($mode === 'update') ? $adm_lang['update_item'] : $adm_lang['view_item'];
    
    if (isset($_POST['submit']))
    {
      
	$sql = 'UPDATE ' . USER_GROUPS_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE user_group_id = " .  (int) $gid;
	
	$db->sql_query($sql);
	
	redirect($config['admin_path'] . 'group.' . $phpEx, $sid);
	//echo $sql; exit;
    }
    else
    {
	// Get node data for updating
	$sql = 'SELECT * FROM ' . USER_GROUPS_TABLE . " WHERE user_group_id=" . (int) $gid;
    
	//echo $sql; exit;
	$result = $db->sql_query($sql);
	$data = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

    }
    
}

$s_hidden_fields = build_hidden_fields(array(
    'parent'	=> $parent,
    'mode'	=> $mode,
    'sid'	=> $sid,
    'module'	=> $modules,
    'id'	=> $gid)
);

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
    'U_ACTION'		=> append_sid("{$tonjaw_admin_path}groupdetail.$phpEx"),
    'L_COMPOSE'		=> ($mode === 'add')?$adm_lang['add'] : $adm_lang['edit'],
    'L_NAME'		=> $adm_lang['group_name'],
    'S_NAME'		=> $data['user_group_name'],
    'L_DESCRIPTION'	=> $adm_lang['description'],
    'S_DESCRIPTION'	=> $data['user_group_description'],
    'L_ENABLED'		=> $adm_lang['enabled'],
    'L_SUBMIT'		=> $adm_lang['submit'],
    'V_ENABLED'		=> ($data['user_group_enabled'])? 'checked' : '',
    'S_FORM_TOKEN'	=> $s_hidden_fields,
    'L_LABEL'			=> $label,
 ));

$template->set_filenames(array(
	'body' => 'admin_usergroupform.tpl',
));

page_footer();

?>