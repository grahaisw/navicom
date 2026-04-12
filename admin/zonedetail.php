<?php
/**
*
* admin/zonedetail.php
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
$modules	= request_var('module', '');
$zid		= request_var('id', '');
 
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($modules) || empty($mode))
{
    die('Hacking Attempt');
}

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

//echo 'parent: ' . $parent . '<br/>p_id: ' . $module->p_id; exit;

// Preparing data
if (isset($_POST['submit']))
{
    $zone_name = utf8_normalize_nfc(request_var('name', ''));
    $zone_description = utf8_normalize_nfc(request_var('description', ''));
    $zone_disabled = request_var('enabled_flag', '');
    
    $zone_disabled = $zone_disabled == 'on' ? '1' : '0';
    
    $sql_ary = array(
	'zone_name'		=> (string) $zone_name,
	'zone_description'	=> (string) $zone_description,
	'zone_enabled'		=> (int) $zone_disabled,
    );
    
    //$parent_parameter = $sid . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,;
}

if ($mode === 'add' && isset($_POST['submit']))
{
    
    $sql = 'INSERT INTO ' . ZONES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);

    $db->sql_query($sql);
    
    redirect($config['admin_path'] . 'zone.' . $phpEx, $sid);
    //echo $sql; exit;
}

if ($mode === 'update')
{
    $data = array();
    
    if (empty($zid))
    {
	die('Missing Zone ID. Cannot update Zone Table.');
    }
    
    $label = ($mode === 'update') ? $adm_lang['update_item'] : $adm_lang['view_item'];

    if (isset($_POST['submit']))
    {
      
	$sql = 'UPDATE ' . ZONES_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE zone_id = " .  (int) $zid;
	
	$db->sql_query($sql);
	
	redirect($config['admin_path'] . 'zone.' . $phpEx, $sid);
	//echo $sql; exit;
    }
    else
    {
	// Get node data for updating
	$sql = 'SELECT * FROM ' . ZONES_TABLE . " WHERE zone_id=" . (int) $zid;
    
	//echo $sql; exit;
	$result = $db->sql_query($sql);
	$data = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

    }
    
}
//echo 'Crottttzzzz....'; exit;
$s_hidden_fields = build_hidden_fields(array(
    'parent'	=> $parent,
    'mode'	=> $mode,
    'sid'	=> $sid,
    'module'	=> $modules,
    'id'	=> $zid)
);

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


    'U_ACTION'		=> append_sid("{$tonjaw_admin_path}zonedetail.$phpEx"),
    'L_NAME'		=> $adm_lang['zone_name'],
    'S_NAME'		=> $data['zone_name'],
    'L_DESCRIPTION'	=> $adm_lang['description'],
    'S_DESCRIPTION'	=> $data['zone_description'],
    'L_ENABLED'		=> $adm_lang['enabled'],
    'L_SUBMIT'		=> $adm_lang['submit'],
    'V_ENABLED'		=> ($data['zone_enabled'])? 'checked' : '',
    'S_FORM_TOKEN'	=> $s_hidden_fields,
    'L_LABEL'			=> $label,
 ));

$template->set_filenames(array(
	'body' => 'admin_zoneform.tpl',
));

page_footer();

?>