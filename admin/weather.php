<?php
/**
*
* admin/weather.php
*
* Roberto Tonjaw. Feb 2014
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
$keyword	= request_var('v', '');
$sid 		= request_var('sid', '');
$wid		= request_var('id', '');

$u_action = append_sid("{$tonjaw_admin_path}weather.$phpEx", "mode=update");

//GRAB WEATHER DATA
$weather_data = array();
$weather_count = 0;
//$sql_sort = 'log_time DESC';
$start = grab_weathers($weather_data, $weather_count);

if ($mode === 'update')
{
    $pid	= array();
    $mark	= array();
    
    $pid	= (isset($_REQUEST['weather_id'])) ? request_var('weather_id', array('0')) : array();

    //echo '<p>pid: '; print_r($pid);
    //echo '<br>mark: '; print_r($mark); echo '<p><p>'; exit; 
    
    $i = 0;
    foreach($weather_data as $row)
    {
	$mark[$i] = request_var('mark_' . $pid[$i], '')? '1' : '0';
	
	$sql = 'UPDATE ' . WEATHER_TABLE . ' 
	  SET weather_enabled=' . (string) $mark[$i] ."
	  WHERE weather_id = '" . $pid[$i] . "'";
	
	if( !empty($pid[$i]) )
	{
	    $db->sql_query($sql);
	    //echo '<p>' . $sql . "<br/>tv_id[$i]</p>";
	}
	
	$i++;
    }
    
    redirect($config['admin_path'] . 'weather.' . $phpEx, $sid);

}



if (!empty($wid) && $mode === 'delete')
{
    $sql = 'DELETE FROM ' . WEATHER_TABLE . ' WHERE weather_id = ' . (int) $wid;
    //$db->sql_query($sql);
    
    //redirect($config['admin_path'] . 'node.' . $phpEx, $sid);
    echo 'ready to wipe out ID: ' . $wid . '</br>SQL: ' . $sql; exit;
}

$thumbnail_path = $tonjaw_root_path . $config['media_path'] . $config['city_icon_path'];
// Generate the page
adm_page_header($module->active_module_name);

foreach ($weather_data as $row)
{
    //$data = array();
    $icon = file_exists($thumbnail_path.$row['country_icon'])? $thumbnail_path.$row['country_icon'] : $thumbnail_path.$config['default_country_icon'];
    
    //echo $thumbnail; exit;
    $template->assign_block_vars('weather', array(
	'S_WID'			=> $row['id'],
	'CITY'			=> $row['city'],
	'U_CITY'		=> append_sid("{$tonjaw_admin_path}weatherdetail.$phpEx", "mode=detail") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'ICON'			=> $icon,
	'ENABLED'		=> ($row['enabled']) ? 'Yes' : 'No',
	'V_ENABLED'		=> ($row['enabled'])? 'checked' : '',
	'TODAY_TEXT'		=> $row['today_text'],
	'TODAY_CONDITION'	=> $row['today_condition'],
	'U_UPDATE'		=> append_sid("{$tonjaw_admin_path}weatherdetail.$phpEx", "mode=update") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_UPDATE'		=> $adm_lang['edit'],
	'U_DELETE'		=> append_sid("{$tonjaw_admin_path}weather.$phpEx", "mode=delete") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
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
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}weatherdetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '1',
    'S_FOURTH_FIELD'		=> '1',
    'S_SEVENTH_FIELD'		=> '1',
    'L_CITY'			=> $adm_lang['city'],
    'L_ICON'			=> $adm_lang['icon'],
    'L_TODAY'			=> $adm_lang['today'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'S_WEATHER'			=> ($weather_count > 0),
    'L_SUBMIT'			=> $adm_lang['submit'],
    'L_CONFIRM_DELETE'		=> $adm_lang['confirm_delete'],

));

$template->set_filenames(array(
	'body' => 'admin_weather.tpl',
));

//add_log($adm_lang['read']);
page_footer();


?>