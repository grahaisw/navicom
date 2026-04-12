<?php

/**
*
* admin/ads_home_scheduledetail.php
*
* Agnes Emanuella. Mar 2017
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

$parent     = request_var('parent', '');
$mode       = request_var('mode', '');
$sid        = request_var('sid', '');
$modules    = request_var('module', '');
$rid        = request_var('id', '');

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

//$flag_file    = '0';
$error = '';
$error_msg = '';
$node_data = array();

$u_action = $tonjaw_admin_path . 'ads_home_scheduledetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{ 
    
    // Preparing UPDATE ROOM TABLE
    $start = utf8_normalize_nfc(request_var('start', ''));
    $end = utf8_normalize_nfc(request_var('end', ''));
    $banner = request_var('ads_home_id', '');
    //$duration = request_var('duration', '');
    $order = request_var('order', '');
	$zid = array();
    $zid = (isset($_REQUEST['zone_id'])) ? request_var('zone_id', array('0')) : array();
	$enabled_flag = request_var('enabled_flag', '') == 'on' ? '1' : '0';

    $tanggalstart = explode('/', $start);
    $tglstart = mktime(0, 0, 0, $tanggalstart[1], $tanggalstart[2], $tanggalstart[0]);
    $tanggalend = explode('/', $end);
    $tglend = mktime(0, 0, 0, $tanggalend[1], $tanggalend[2], $tanggalend[0]);
   
    $sql_ary3 = array(
        //'ads_home_schedule_duration'  => $duration,
        'ads_home_schedule_order'  	=> $order,
        'ads_home_schedule_enabled'   => $enabled_flag,
        'ads_home_id' 				=> $banner,
        'ads_home_schedule_start' 	=> $tglstart,
        'ads_home_schedule_end' 		=> $tglend,
    );
    
    if ($mode === 'add')
    {
		$sql3 = 'INSERT INTO ' . ADS_HOME_SCHEDULES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary3);
		//echo $sql3; //exit;
		$db->sql_query($sql3);
		$rid = $db->sql_nextid();
		
		$sql_ary = array(
			'ads_home_schedule_id'    => $rid,
			'zone_id'   				=> $zone,
		  
		);
	
		$sql = 'INSERT INTO ' . ADS_HOME_ZONE_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
		$db->sql_query($sql);
		
    }
	
    if ($mode === 'update')
    {//print_r($zid); exit;
    $sql = 'UPDATE ' . ADS_HOME_SCHEDULES_TABLE . ' SET ' . 
        $db->sql_build_array('UPDATE', $sql_ary3) .
        " WHERE ads_home_schedule_id = $rid";
	//echo $sql; exit;
    $db->sql_query($sql);
    
	$sql_delete = "DELETE FROM " . ADS_HOME_ZONE_GROUPINGS_TABLE . " WHERE ads_home_schedule_id = ".$rid;
	$db->sql_query($sql_delete);
	
    
	
	$i = 0;
    while ( $i < sizeof($zid) )
    {
		$sql_ary = array(
			'ads_home_schedule_id'    => $rid,
			'zone_id'   				=> $zid[$i],
		  
		);

		$sql = 'INSERT INTO ' . ADS_HOME_ZONE_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
		$db->sql_query($sql);
	   
		$i++;
	}
	}
	redirect($config['admin_path'] . 'ads_home_schedule.' . $phpEx, $sid);
}

if ($mode === 'update')
{
    if (empty($rid))
    {
    die('Missing Room ID. Cannot update Room Table.');
    }

    // Get room data for updating
    $sql = 'SELECT * FROM ' . ADS_HOME_SCHEDULES_TABLE . " WHERE ads_home_schedule_id=" . (int) $rid;
    
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
 
}

$foreign_id = (!empty($rid))? $rid : 0;
//$zone_id = (!empty($zid))? $zid : 0;

$s_hidden_fields = build_hidden_fields(array(
    'parent'    => $parent,
    'mode'  => $mode,
    'sid'   => $sid,
    'module'    => $modules,
    'id'    => $rid)
);

//print_r($node_data); exit;

adm_page_header($module->active_module_name);

$template->assign_vars(array(
    'HIDE_DISPLAY_SIDE_MENU'    => $adm_lang['hide_display_side_menu'],
    //'T_LOG_JS_PATH'       => $tonjaw_root_path . $config['js_path'] . 'log.js',
    'LOGIN_AS'          => $adm_lang['login_as'],
    'USERNAME'          => $session->username,
    'U_LOGOUT'          => append_sid("{$tonjaw_admin_path}index.$phpEx") . '&amp;mode=logout',
    'L_LOGOUT'          => $adm_lang['logout'],
    'MODULE_TITLE'      => $module->active_module_name,
    'MODULE_DESC'       => $module->active_module_desc,
    'U_ACTION'          => $u_action,
    'S_ADD_UPDATE'      => $module->user_priviledge[1],
    // 'U_ADD'         => append_sid("{$tonjaw_admin_path}ads_popup_scheduledetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'         	=> $adm_lang['add'],
    'S_FACEBOX'         => '0',
    'S_DATATABLE_NODES' => '0',
    'S_START'       	=> (!empty($data['ads_home_schedule_start'])) ? date("Y/m/d", $data['ads_home_schedule_start']) : '',
    'S_END'         	=> (!empty($data['ads_home_schedule_end'])) ? date("Y/m/d", $data['ads_home_schedule_end']) : '',
    'L_START'    		=> $adm_lang['start'],
    'L_END'         	=> $adm_lang['end'],
    'L_BANNER'  		=> $adm_lang['banner'],
    'L_DURATION'        => $adm_lang['duration'],
    'L_ORDER'        	=> $adm_lang['order'],
    'L_ZONE'           	=> $adm_lang['zone'],
    'L_ENABLED'         => $adm_lang['enabled'],
    'S_ENABLED'         => ($data['ads_home_schedule_enabled'])? 'checked' : '',
    'S_FORM_TOKEN'      => $s_hidden_fields,
    'L_SUBMIT'          => $adm_lang['submit'],
	'S_ZONE'			=> generate_home_zone_grouping('zone_id[]', $foreign_id),
	'S_BANNER'			=> generate_ads_home('ads_home_id', $data['ads_home_id']),
	'S_DURATION'		=> $data['ads_home_schedule_duration'],
	'S_ORDER'			=> (!empty($data['ads_home_schedule_order'])) ? $data['ads_home_schedule_order'] : '1',
));

$template->set_filenames(array(
    'body' => 'admin_home_scheduleform.tpl',
));

page_footer();


?>