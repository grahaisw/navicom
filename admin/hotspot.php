<?php
/**
*
* admin/hotspot.php
*
* Agnes Emanuella. Apr 2016
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

//echo $file[0]; exit;
//$template->set_template();

$mode		= request_var('mode', '');
$sid 		= request_var('sid', '');
$tid		= request_var('id', '');
$room		= request_var('room', '');

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

//$flag_file 	= '0';
$error = '';
$error_msg = '';

$u_action = append_sid("{$tonjaw_admin_path}tv.$phpEx", "mode=update");

// This page depends on its parent and cannot be displayed alone

//GRAB TV DATA
$hotspots_data = array();
$hotspot_count = 0;
//$sql_sort = 'log_time DESC';
$start = view_hotspot($hotspots_data, $hotspot_count);
/*
if ($mode === 'update')
{
    $tv_id	= array();
    $mark	= array();
    $order	= array();
    $tv_id	= (isset($_REQUEST['tv_id'])) ? request_var('tv_id', array('0')) : array();

    //echo '<p>gid: '; print_r($gid); exit;
    //echo '<br>mark: '; print_r($mark); echo '<p><p>'; exit; 
    
    $i = 0;
    foreach($hotspots_data as $row)
    {
	$mark[$i] = request_var('mark_' . $tv_id[$i], '')? '1' : '0';
	$order[$i] = request_var('order_' . $tv_id[$i], '');
	
	$sql = 'UPDATE ' . TV_CHANNELS_TABLE . ' 
	  SET tv_channel_enabled=' . (string) $mark[$i] .", tv_channel_order=" . (string) $order[$i] ."
	  WHERE tv_channel_id = '" . $tv_id[$i] . "'";
	
	if( !empty($tv_id[$i]) )
	{
	    $db->sql_query($sql);
	    //echo '<p>' . $sql . "<br/>tv_id[$i]</p>";
	}
	
	$i++;
    }
    //exit;
    redirect($config['admin_path'] . 'hotspot.' . $phpEx, $sid);

} */

if (isset($_GET['room']) && $mode === 'delete')
{
	$sql = 'DELETE FROM ' . HOTSPOTS_TABLE .
		" WHERE room_name = '".$room."'";
    $db->sql_query($sql);
    
    redirect($config['admin_path'] . 'hotspot.' . $phpEx, $sid);
}

$thumbnail_path = $tonjaw_root_path . $config['media_path'] . $config['tv_icon_path'];

// Generate the page
adm_page_header($module->active_module_name);

foreach ($hotspots_data as $row)
{	
    //$data = array();
    $thumbnail = file_exists($thumbnail_path.$row['thumbnail'])? $thumbnail_path.$row['thumbnail'] : $thumbnail_path.$config['default_thumbnail_tv'];
    
    //echo $thumbnail; exit;
    $template->assign_block_vars('hotspot', array(
	'ORDER'			=> $row['order'],
	'S_TID'			=> $row['id'],
	'ROOM'			=> $row['room'],
	'PASSWORD1'		=> $row['password'][1],
	'PASSWORD2'		=> $row['password'][2],
	'PASSWORD3'		=> $row['password'][3],
	'PASSWORD4'		=> $row['password'][4],
	'ENABLED'		=> ($row['enabled']) ? 'Yes' : 'No',
	'V_ENABLED'		=> ($row['enabled'])? 'checked' : '',
	'U_UPDATE'		=> append_sid("{$tonjaw_admin_path}hotspotdetail.$phpEx", "mode=update") . '&amp;room=' . $row['room'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_UPDATE'		=> $adm_lang['edit'],
	'U_NAME'		=> '#', //append_sid("{$tonjaw_admin_path}tvdetail.$phpEx", "mode=detail") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'U_DELETE'		=> append_sid("{$tonjaw_admin_path}hotspot.$phpEx", "mode=delete") . '&amp;room=' . $row['room'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
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
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}hotspotdetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '1',
    'S_FOURTH_FIELD'		=> '1',
    'S_EIGHT_FIELD'		=> '1',
    'S_NINTH_FIELD'		=> '1',
    'S_SEVENTH_FIELD'		=> '1',
    'L_ROOM'			=> $adm_lang['room'],
    'L_PASSWORD1'		=> $adm_lang['password'].' Week 1',
    'L_PASSWORD2'		=> $adm_lang['password'].' Week 2',
	'L_PASSWORD3'		=> $adm_lang['password'].' Week 3',
	'L_PASSWORD4'		=> $adm_lang['password'].' Week 4',
    'L_ENABLED'			=> $adm_lang['enabled'],
    'S_HOTSPOT'				=> ($hotspot_count > 0),
    'L_SUBMIT'			=> $adm_lang['submit'],
    'L_CONFIRM_DELETE'		=> $adm_lang['confirm_delete'],

));


$template->set_filenames(array(
	'body' => 'admin_hotspot.tpl',
));

//add_log($adm_lang['read']);
page_footer();



?>