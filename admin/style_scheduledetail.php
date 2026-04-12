<?php
/**
*
* admin/style_scheduledetail.php
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
$module		= request_var('module', '');
$schedule_id	= request_var('id', '');
$default_start	= time();
$default_end	= time();

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
    $name = utf8_normalize_nfc(request_var('name', ''));
    $style_id = request_var('style_id', '');
    $nodes = utf8_normalize_nfc(request_var('node', ''));
    $start = strtotime(request_var('start', ''));
    $end = strtotime(request_var('end', ''));
    $enabled = request_var('enabled_flag', '');
    
    $enabled = $enabled == 'on' ? '1' : '0';
    
    $sql_ary = array(
	'style_schedule_name'		=> (string) $name,
	'style_id'			=> (int) $style_id,
	'style_schedule_node'		=> (string) $nodes,
	'style_schedule_start'		=> (int) $start,
	'style_schedule_end'		=> (int) $end,
	'style_schedule_enabled'	=> (int) $enabled,
    );
    
    if ($end < $start)
    {
	$error = true;
	$error_msg = ($error_msg) ? $error_msg . '<br />' . $adm_lang['Error_start_end_date'] : $adm_lang['Error_start_end_date'];
    }
    
    if (empty(trim($name)))
    {
	$error = true;
	$error_msg = ($error_msg) ? $error_msg . '<br />' . $adm_lang['Error_empty_style_name'] : $adm_lang['Error_empty_style_name'];
    }
    
    if (empty(trim($style_id)))
    {
	$error = true;
	$error_msg = ($error_msg) ? $error_msg . '<br />' . $adm_lang['Error_empty_style_id'] : $adm_lang['Error_empty_style_id'];
    }
}

if ($mode === 'add' && isset($_POST['submit']))
{
    $sql = 'INSERT INTO ' . STYLE_SCHEDULES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);

    $db->sql_query($sql);
    
    redirect($config['admin_path'] . 'style_schedule.' . $phpEx, $sid);
    
}

if ($mode === 'update')
{
    $data = array();
    
    if (empty($schedule_id))
    {
	die('Missing Schedule Style ID. Cannot update Schedule Style Table.');
    }
    
    $label = ($mode === 'update') ? $adm_lang['update_item'] : $adm_lang['view_item'];

    if (isset($_POST['submit']))
    {
      
	$sql = 'UPDATE ' . STYLE_SCHEDULES_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE style_schedule_id = " .  (int) $schedule_id;
	
	$db->sql_query($sql);
	
	redirect($config['admin_path'] . 'style_schedule.' . $phpEx, $sid);
	//echo $sql; exit;
    }
    else
    {
	// Get node data for updating
	$sql = 'SELECT * FROM ' . STYLE_SCHEDULES_TABLE . " WHERE style_schedule_id=" . (int) $schedule_id;
    
	//echo $sql; exit;
	$result = $db->sql_query($sql);
	$data = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	$default_start = $data['style_schedule_start'];
	$default_end = $data['style_schedule_end'];
    }
}
//echo 'crotttt'; exit;
$s_hidden_fields = build_hidden_fields(array(
    'parent'	=> $parent,
    'mode'	=> $mode,
    'sid'	=> $sid,
    'module'	=> $modules,
    'id'	=> $schedule_id)
);

$label = (!$label) ? $adm_lang['add_item'] : $label;
adm_page_header($module->active_module_name);

$template->assign_vars(array(
    'LOGIN_AS'			=> $adm_lang['login_as'],
    'USERNAME'			=> $session->username,
    'U_LOGOUT'			=> append_sid("{$tonjaw_admin_path}index.$phpEx") . '&amp;mode=logout',
    'L_LOGOUT'			=> $adm_lang['logout'],
    'MODULE_TITLE'		=> $module->active_module_name,
    'MODULE_DESC' 		=> $module->active_module_desc,
    'U_ACTION'		=> append_sid("{$tonjaw_admin_path}style_scheduledetail.$phpEx"),
    'L_COMPOSE'		=> ($mode === 'add')?$adm_lang['add'] : $adm_lang['edit'],
    'S_DATETIME_PICKER'	=> '1',
    'L_PICK'		=> $adm_lang['pick'],
    'L_NAME'		=> $adm_lang['schedule_name'],
    'S_NAME'		=> $data['style_schedule_name'],
    'L_STYLE'		=> $adm_lang['style_name'],
    'S_STYLE'		=> generate_styles_combo('style_id', $data['style_id']),
    'L_NODE'		=> $adm_lang['node_name'],
    'S_NODE'		=> $data['style_schedule_node'],
    'L_START'		=> $adm_lang['start'],
    'S_START'		=> date("Y/m/d H:i", $default_start),
    'L_END'		=> $adm_lang['end'],
    'S_END'		=> date("Y/m/d H:i", $default_end),
    'L_ENABLED'		=> $adm_lang['enabled'],
    'V_ENABLED'		=> ($data['style_schedule_enabled'])? 'checked' : '',
    'L_SUBMIT'		=> $adm_lang['submit'],
    'S_FORM_TOKEN'	=> $s_hidden_fields,
    'L_LABEL'		=> $label,
 ));

$template->set_filenames(array(
	'body' => 'admin_style_scheduleform.tpl',
));

page_footer();


?>