<?php
/**
*
* admin/ads_home_log.php
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

// Load and execute the relevant module
//$module->load_active();

//GRAB LOGS

$u_action = append_sid("{$tonjaw_admin_path}ads_home_log.$phpEx", "mode=list");

$mode		= request_var('mode', '');

//GRAB LOGS DATA
$log_data = array();
$log_count = 0;
//$sql_sort = 'log_time DESC';
$start = view_ads_logs($log_data, $log_count, 'home', $mode);

// Generate the page
adm_page_header($module->active_module_name);


foreach ($log_data as $row)
{
    
    $template->assign_block_vars('log', array(
	'NAME'				=> $row['name'],
	'U_TIME'			=> append_sid("{$tonjaw_admin_path}ads_home_logdetail.$phpEx", "mode=view") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'TOTAL_WATCHED'		=> $row['count_log'],
	'SUBSCRIBER_NAME'	=> ($mode == "subs") ? $row['subscriber_name'] : '',
    ));
}

//echo on_page($log_count, $config['recs_per_page'], $start); exit;
$template->assign_vars(array(
    'HIDE_DISPLAY_SIDE_MENU'	=> $adm_lang['hide_display_side_menu'],
    //'T_LOG_JS_PATH'		=> $tonjaw_root_path . $config['js_path'] . 'log.js',
    'LOGIN_AS'			=> $adm_lang['login_as'],
    'USERNAME'			=> $session->username,
    'U_LOGOUT'			=> append_sid("{$tonjaw_admin_path}index.$phpEx") . '&amp;mode=logout',
    'L_LOGOUT'			=> $adm_lang['logout'],
    'MODULE_TITLE'		=> $module->active_module_name,
    'MODULE_DESC' 		=> $module->active_module_desc,
    'U_ACTION'			=> $u_action . "&amp;$u_sort_param$keywords_param&amp;start=$start",
    'U_LOG'				=> ($mode == "subs") ? $u_action : $u_action.'&mode=subs',
    //'L_TITLE'			=> $adm_lang['users_online'] . $config['session_length']/3600 . ' hour',
    'L_SEARCH_KEYWORDS'		=> $adm_lang['search_keyword'],
    'L_SEARCH'			=> $adm_lang['search'],
    'L_SUBSCRIBER_NAME'	=> $adm_lang['subscriber_name'],
    'L_NAME'			=> $adm_lang['ads_name'],
    'L_TOTAL_VIEWED'	=> $adm_lang['total_viewed'],
    'L_SUBSCRIBER_ID'	=> $adm_lang['subscriber_id'],
    'S_LOGS'			=> ($log_count > 0),
    'S_FACEBOX'			=> '1',
    //'S_ON_PAGE'			=> on_page($log_count, $config['recs_per_page'], $start),
    //'PAGINATION'		=> generate_pagination($u_action . "&amp;$u_sort_param$keywords_param", $log_count, $config['recs_per_page'], $start, true),
	'L_DISPLAY_LOG'		=> $adm_lang['display_log'],
    'L_SORT_BY'			=> $adm_lang['sort_by'],
    'L_GO'			=> $adm_lang['go'],
    'L_NO_ENTRIES'		=> $adm_lang['no_entry'],
	'S_DATATABLE_NODES_WITH_DATEPICKER'		=> '1',
	//'S_THIRD_FIELD'		=> '1',
    //'S_FOURTH_FIELD'		=> '1',
    //'S_FIFTH_FIELD'		=> '1',
	//'S_SEVENTH_FIELD'		=> '1',
	'L_SUBMIT'			=> $adm_lang['submit'],
	'S_SUBSCRIBER_LOG'	=> ($mode == "subs") ? '1' : '0',
	'S_MODE'			=> ($mode == "subs") ? 'subs' : '',
	'S_TYPE'			=> strtolower($adm_lang['home']),
	'S_DATEFROM'		=> date("Y-m-d"),
	'S_DATEEND'			=> date("Y-m-d"),
    ));

$template->set_filenames(array(
	'body' => 'admin_ads_home_log.tpl',
));

//add_log($adm_lang['read']);
page_footer();


?>