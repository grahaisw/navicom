<?php
/**
*
* admin/adsdetail.php
*
* Agnes Emanuella. Jul 2014
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

$parent     = 'ads_popup_schedule'; //request_var('parent', '');
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
$group_data = array();
$zone_data = array();

$u_action = $tonjaw_admin_path . 'ads_popup_scheduledetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data

// GRAB ROOMS DATA
$data_popup = array();
$popup_count = 0;
$param = $_GET['time'];
$start = view_popup($data_popup,$popup_count,$param);


$s_hidden_fields = build_hidden_fields(array(
    'parent'    => $parent,
    'mode'  => $mode,
    'sid'   => $sid,
    'module'    => $modules,
    'id'    => $rid)
); 

if (isset($_GET['id']) && $mode === 'delete')
{
    // echo "data_popup";die();
    $nid    = request_var('id', '');
    // echo $nid;die();
    $param = $_GET['time'];
    // $sql = "SELECT stb_id FROM " . NODES_TABLE . " WHERE node_id = ". $nid;
    // $result = $db->sql_query($sql);
    // $stb_id = $db->sql_fetchfield('stb_id');
    // $db->sql_freeresult($result);
    
    $sql = 'DELETE FROM ' . ADS_POPUP_SCHEDULES_TABLE . ' WHERE ads_popup_schedule_id = ' . (int) $nid;
    $db->sql_query($sql);

    $sql2 = 'DELETE FROM ' . ADS_CHANNEL_GROUPINGS_TABLE . ' WHERE ads_popup_schedule_id = ' . (int) $nid;
    $db->sql_query($sql2);

    $sql2 = 'DELETE FROM ' . ADS_ZONE_GROUPINGS_TABLE . ' WHERE ads_popup_schedule_id = ' . (int) $nid;
    $db->sql_query($sql2);
    // if(!empty($stb_id)) {
    // $sql = "DELETE FROM " . NODE_PAIRINGS_TABLE . " WHERE stb_id = '" . $stb_id . "'";
    //     $db->sql_query($sql);
    // }
  
    redirect($config['admin_path'] . 'ads_popup_listdetail.' . $phpEx .'?mode=detail&sid=' . $sid. '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name. '&time='. $param );
    //echo 'ready to wipe out ID: ' . $nid . '</br>SQL: ' . $sql; exit;
}
//print_r($data_popup); exit;


adm_page_header($module->active_module_name);

foreach ($data_popup as $row)
{   
    //$data = array();
    $template->assign_block_vars('popup', array(
 'NAME'          	=> $row['name'],
 'START'        	=> $row['date_start'],
 'S_RID'         => $row['ids'],
 'ZONE'         => grab_popup_zone($row['id']),
 'CHANNEL'      => grab_popup_channel($row['id']),
 'START'         => $row['date_start'],
 'END'         => $row['date_end'],
 'TIME'         => $row['time_start'],
  'TIMES'         => $_GET['time'],
 'V_ENABLED'     => ($row['enabled'])? 'checked' : '',
 'ENABLED'       => !empty($row['enabled']) ? 'Yes' : 'No',
 'U_UPDATE'      => append_sid("{$tonjaw_admin_path}ads_popup_scheduledetail.$phpEx", "mode=update") . '&amp;id=' . $row['id'] . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name . '&amp;time=' . $_GET['time'],
 'L_UPDATE'      => $adm_lang['edit'],
 'U_DELETE'      => append_sid("{$tonjaw_admin_path}ads_popup_listdetail.$phpEx", "mode=delete") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
 'L_DELETE'      => $adm_lang['delete'],
 'ICON_PATH'     => $tonjaw_root_path . $config['imageset_path'],
    ));
}

$template->assign_vars(array(
    'S_TARGET_ZONE' => generate_ads_zone('ads_popup_id', $rid),
    'S_TARGET_ROOM' => generate_popup_zone('zone_id[]', $rid),
    'S_TARGET_CHANNEL' => generate_popup_channel('tv_channel_id[]', $rid),
    'HIDE_DISPLAY_SIDE_MENU'    => $adm_lang['hide_display_side_menu'],
    //'T_LOG_JS_PATH'       => $tonjaw_root_path . $config['js_path'] . 'log.js',
    'LOGIN_AS'          => $adm_lang['login_as'],
    'USERNAME'          => $session->username,
    'U_LOGOUT'          => append_sid("{$tonjaw_admin_path}index.$phpEx") . '&amp;mode=logout',
    'L_LOGOUT'          => $adm_lang['logout'],
    'MODULE_TITLE'      => $module->active_module_name,
    'MODULE_DESC'       => $module->active_module_desc,
    'U_ACTION'          => $u_action,
    //'L_TITLE'         => $adm_lang['users_online'] . $config['session_length']/3600 . ' hour',
    'S_ADD_UPDATE'      => $module->user_priviledge[1],
    'S_DELETE'          => $module->user_priviledge[2],
    // 'U_ADD'         => append_sid("{$tonjaw_admin_path}ads_popup_scheduledetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'         => $adm_lang['add'],
    'S_FACEBOX'         => '0',
    'S_DATATABLE_NODES'     => '1',
	'S_THIRD_FIELD'		=> '1',
    'S_FOURTH_FIELD'		=> '1',
    'S_FIFTH_FIELD'		=> '1',
    'S_START'       => date($config['schedule_dateformat'], $data['message_schedule_start']),
    'S_END'         => date($config['schedule_dateformat'], $data['message_schedule_end']),
    'L_COMPANY_NAME'    => $adm_lang['company_name'],
    'L_ADS_NAME'         => $adm_lang['ads_name'],
    'L_DATE'  			=> $adm_lang['date'],
    'L_TIME'           => $adm_lang['time'],
    'L_ZONE'           => $adm_lang['zone'],
    'L_ENABLED'         => $adm_lang['enabled'],
    'L_CHANNEL'            => $adm_lang['channel_name'],
    'S_ADDRESS'         => $data['signage_ads_address'],
    'S_CONTACT_PERSON'  => $data['signage_ads_cp'],
    'S_PHONE'           => $data['signage_ads_phone'],
    'S_EMAIL'           => $data['signage_ads_email'],
    'S_ENABLED'         => ($data['signage_ads_enabled'])? 'checked' : '',
    'S_FORM_TOKEN'      => $s_hidden_fields,
    'L_SUBMIT'          => $adm_lang['submit'],
));

$template->set_filenames(array(
    'body' => 'admin_popup_schedulelist.tpl',
));

page_footer();


?>