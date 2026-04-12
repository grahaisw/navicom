<?php
/**
*
* admin/airport.php
*
* Roberto Tonjaw. Oct 2014
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

$u_action = append_sid("{$tonjaw_admin_path}airport.$phpEx", "mode=update");

//GRAB SERVICE AIRPORT DATA
$airport_data = array();
$airport_count = 0;
//$sql_sort = 'log_time DESC';
$start = view_airports($airport_data, $airport_count);

//print_r($group_data); exit;

if ($mode === 'update')
{
    $aid	= array();
    $mark	= array();
    
    $aid	= (isset($_REQUEST['airport_id'])) ? request_var('airport_id', array('0')) : array();

    //echo '<p>aid: '; print_r($aid); exit;
    //echo '<br>mark: '; print_r($mark); echo '<p><p>'; exit; 
    
    $i = 0;
    foreach($airport_data as $row)
    {
	$mark[$i] = request_var('mark_' . $aid[$i], '')? '1' : '0';
	
	$sql = 'UPDATE ' . AIRPORTS_TABLE . ' 
	  SET airport_enabled=' . (string) $mark[$i] ."
	  WHERE airport_id = '" . $aid[$i] . "'";
	  
	if( !empty($aid[$i]) )
	{
	    $db->sql_query($sql);
	    //echo '<p>' . $sql . "<br/>tv_id[$i]</p>";
	}
	
	$i++;
    }
    
    redirect($config['admin_path'] . 'airport.' . $phpEx, $sid);

}

if (isset($_GET['id']) && $mode === 'delete')
{

}

// Generate the page
adm_page_header($module->active_module_name);

foreach ($airport_data as $row)
{
    //$thumbnail = file_exists($thumbnail_path.$row['thumbnail'])? $thumbnail_path.$row['thumbnail'] : $thumbnail_path.$config['default_thumbnail_service_group'];
    
    //$data = array();
    $template->assign_block_vars('airport', array(
	'CODE'			=> $row['code'],
	'NAME'			=> $row['name'],
	'DESCRIPTION'		=> $row['desc'],
	'S_AID'			=> $row['id'],
	//'S_ENABLED'		=> $row['enabled'],
	'V_ENABLED'		=> ($row['enabled'])? 'checked' : '',
	'ENABLED'		=> ($row['enabled']) ? 'Yes' : 'No',
	'U_UPDATE'		=> append_sid("{$tonjaw_admin_path}airportdetail.$phpEx", "mode=update") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_UPDATE'		=> $adm_lang['edit'],
	'U_DELETE'		=> append_sid("{$tonjaw_admin_path}airport.$phpEx", "mode=delete") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
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
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}airportdetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '1',
    'S_FOURTH_FIELD'		=> '1',
    'S_SEVENTH_FIELD'		=> '1',
    'L_CODE'			=> $adm_lang['code'],
    'L_NAME'			=> $adm_lang['name'],
    'L_DESCRIPTION'		=> $adm_lang['description'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'S_AIRPORTS'		=> ($airport_count > 0),
    'L_SUBMIT'			=> $adm_lang['submit'],
    'L_CONFIRM_DELETE'		=> $adm_lang['confirm_delete'],
    ));

$template->set_filenames(array(
	'body' => 'admin_airport.tpl',
));

//add_log($adm_lang['read']);
page_footer();

?>