<?php
/**
*
* admin/fe_menu_group.php
*
* Roberto Tonjaw. Mar 2015
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

//$keyword = '';

$u_action = append_sid("{$tonjaw_admin_path}fe_menu_group.$phpEx", "mode=update");
$d_action = append_sid("{$tonjaw_admin_path}fe_menu_group.$phpEx", "mode=detail");

//GRAB MENU GROUPS DATA
$menu_data = array();
$menu_count = 0;
//$sql_sort = 'log_time DESC';
$start = view_menu_groups($menu_data, $menu_count);

//print_r($menu_data);
if ($mode === 'update')
{
    $mid	= array();
    $mark	= array();
    
    $mid	= (isset($_REQUEST['menu_id'])) ? request_var('menu_id', array('0')) : array();
    //echo '<p>mid: '; print_r($mid);
    //echo '<br>mark: '; print_r($mark); echo '<p><p>'; exit; 
    
    $i = 0;
    foreach($menu_data as $row)
    {
	$mark[$i] = request_var('mark_' . $mid[$i], '')? '1' : '0';

	$sql = 'UPDATE ' . MENU_GROUPS_TABLE . ' 
	  SET menu_group_enabled=' . (string) $mark[$i] ."
	  WHERE menu_group_id = '" . $mid[$i] . "'";
	
	if( !empty($mid[$i]) )
	{
	    $db->sql_query($sql);
	    //echo '<p>' . $sql . "<br/>tv_id[$i]</p>";
	}
	
	$i++;
    }
    
    redirect($config['admin_path'] . 'fe_menu_group.' . $phpEx, $sid);
}

if (isset($_GET['id']) && $mode === 'delete')
{
	$menu_group_id = request_var('id', '');
    
    $sql = 'DELETE FROM ' . MENU_GROUPS_TABLE . ' WHERE menu_group_id = ' . (int) $menu_group_id;
    $db->sql_query($sql);
    
    redirect($config['admin_path'] . 'fe_menu_group.' . $phpEx, $sid);
}

// Generate the page
adm_page_header($module->active_module_name);

//print_r($style_data); echo '<br/>count: ' . $style_count; exit;

foreach ($menu_data as $row)
{
    //$data = array();
    $template->assign_block_vars('menu', array(
	'TITLE'			=> $row['menu_title'],
	'U_TITLE'		=> append_sid("{$tonjaw_admin_path}fe_menu_groupdetail.$phpEx", "mode=detail") . '&amp;id=' . $row['menu_id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'THUMBNAIL'		=> $row['menu_thumbnail'],
	'URL'			=> $row['menu_url'],
	'ORDER'			=> $row['menu_order'],
	'IN_MOBILE'		=> ($row['menu_in_mobile']) ? 'Yes' : 'No',
	'V_IN_MOBILE'		=> ($row['menu_in_mobile'])? 'checked' : '',
	'ENABLED'		=> ($row['menu_enabled']) ? 'Yes' : 'No',
	'V_ENABLED'		=> ($row['menu_enabled'])? 'checked' : '',
	'S_NID'			=> $row['menu_id'],
	//'S_ENABLED'		=> $row['enabled'],
	'U_UPDATE'		=> append_sid("{$tonjaw_admin_path}fe_menu_groupdetail.$phpEx", "mode=update") . '&amp;id=' . $row['menu_id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_UPDATE'		=> $adm_lang['edit'],
	'U_DELETE'		=> append_sid("{$tonjaw_admin_path}fe_menu_group.$phpEx", "mode=delete") . '&amp;id=' . $row['menu_id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
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
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}fe_menu_groupdetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_DATATABLE_NODES'		=> '1',
    'S_FOURTH_FIELD'		=> '1',
    'S_FIFTH_FIELD'		=> '1',
    'S_SEVENTH_FIELD'		=> '1',
    'S_EIGHT_FIELD'		=> '1',
    'S_NINTH_FIELD'		=> '1',
    'L_TITLE'			=> $adm_lang['menu_title'],
    'L_MEMBERS'			=> $adm_lang['member'],
    'L_ORDER'			=> $adm_lang['order'],
    'L_THUMBNAIL'		=> $adm_lang['thumbnail'],
    'L_IN_MOBILE'		=> $adm_lang['in_mobile'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'S_MENU'			=> ($menu_count > 0),
    'L_SUBMIT'			=> $adm_lang['submit'],
    'L_CONFIRM_DELETE'		=> $adm_lang['confirm_delete'],
    
    ));

$template->set_filenames(array(
	'body' => 'admin_menu_group.tpl',
));

//add_log($adm_lang['read']);
page_footer();


?>