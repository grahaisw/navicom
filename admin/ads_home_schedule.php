<?php
/**
*
* admin/ads_home_schedule.php
*
* Agnes Emanuella. Mar 2017
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
$modules	= request_var('module', '');
$rid		= request_var('id', '');

$u_action = append_sid("{$tonjaw_admin_path}ads_home_schedule.$phpEx", "mode=update");

// Preparing data
if (isset($_POST['submit']))
{
  
}


//GRAB ROOMS DATA
$ads_data = array();
$ads_count = 0;
//$sql_sort = 'log_time DESC';
$start = view_ads_home_schedule($ads_data, $ads_count);

if ($mode === 'update')
{
    $mid	= array();
    $mark	= array();
    
    $mid	= (isset($_REQUEST['nid'])) ? request_var('nid', array('0')) : array();

    $i = 0;
    foreach($ads_data as $row)
    {
	$mark[$i] = !empty(request_var('mark_' . $mid[$i], ''))? '1' : '0';
	
	$sql = 'UPDATE ' . ADS_HOME_SCHEDULES_TABLE . ' 
	  SET ads_home_schedule_enabled=' . (string) $mark[$i] ."
	  WHERE ads_home_schedule_id = '" . $mid[$i] . "'";
	$db->sql_query($sql);
	
	$i++;
    }
    
    redirect($config['admin_path'] . 'ads_home_schedule.' . $phpEx, $sid);

}

if (isset($_GET['id']) && $mode === 'delete')
{
	$sql = 'DELETE FROM ' . ADS_HOME_SCHEDULES_TABLE . ' WHERE ads_home_schedule_id=' . $_GET['id'];
	$db->sql_query($sql);
	
	redirect($config['admin_path'] . 'ads_home_schedule.' . $phpEx, $sid);
}

adm_page_header($module->active_module_name);

foreach ($ads_data as $row)
{
    //$data = array();
    $template->assign_block_vars('ads', array(
	'S_RID'			=> $row['id'],
	'ORDER'			=> $row['order'],
	'NAME'			=> $row['name'],
	'START'			=> date($config['vieworder_dateformat'], $row['start']),
	'END'			=> date($config['vieworder_dateformat'], $row['end']),
	'IMAGE'			=> $row['image'],
	'ZONE'			=> $row['zone'],
	'V_ENABLED'		=> ($row['enabled'])? 'checked' : '',
	'ENABLED'		=> !empty($row['enabled']) ? 'Yes' : 'No',
	'U_UPDATE'		=> append_sid("{$tonjaw_admin_path}ads_home_scheduledetail.$phpEx", "mode=update") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_UPDATE'		=> $adm_lang['edit'],
	'U_DELETE'		=> append_sid("{$tonjaw_admin_path}ads_home_schedule.$phpEx", "mode=delete") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
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
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}ads_home_scheduledetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '1',
    'S_FOURTH_FIELD'		=> '1',
    'S_FIFTH_FIELD'		=> '1',
    'S_SEVENTH_FIELD'		=> '1',
    'S_EIGHT_FIELD'		=> '1',
    'S_NINTH_FIELD'		=> '1',
    'L_ORDER'			=> $adm_lang['order'],
    'L_NAME'			=> $adm_lang['name'],
    'L_ZONE'			=> $adm_lang['zone'],
    'L_START'		    => $adm_lang['start'],
    'L_END'				=> $adm_lang['end'],
    'L_IMAGE'			=> $adm_lang['image'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'L_SUBMIT'			=> $adm_lang['submit'],
    'S_ADS'			=> ($ads_count > 0),
));

$template->set_filenames(array(
	'body' => 'admin_home_schedule.tpl',
));

page_footer();


?>