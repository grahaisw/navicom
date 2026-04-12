<?php
/**
*
* admin/log.php
*
* Roberto Tonjaw. Dec 2013
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

// Set up general vars
$start		= request_var('start', 0);
$log_id		= request_var('l', 0);
$deletemark	= ($_POST['delmarked']) ? true : false;
$deleteall	= ($_POST['delall']) ? true : false;
$marked		= request_var('mark', array(0));

// Sort Keys
$sort_key	= request_var('sk', 't');
$sort_dir	= request_var('sd', 'd');
$sort_days	= request_var('st', 0);

// Sorting
$limit_days = array(0 => $adm_lang['all_entries'], 1 => $adm_lang['1_day'], 7 => $adm_lang['7_days'], 14 => $adm_lang['2_weeks'], 30 => $adm_lang['1_month'], 90 => $adm_lang['3_months'], 180 => $adm_lang['6_months'], 365 => $adm_lang['1_year']);
$sort_by_text = array('u' => $adm_lang['username'], 't' => $adm_lang['time'], 'a' => $adm_lang['action'], 'm' => $adm_lang['module']);
$sort_by_sql = array('u' => 'log_user', 't' => 'log_time', 'a' => 'log_action', 'm' => 'log_module');

$s_limit_days = $s_sort_key = $s_sort_dir = $u_sort_param = '';
gen_sort_selects($limit_days, $sort_by_text, $sort_days, $sort_key, $sort_dir, $s_limit_days, $s_sort_key, $s_sort_dir, $u_sort_param);

// Define where and sort sql for use in displaying logs
$sql_where = ($sort_days) ? (time() - ($sort_days * 86400)) : 0;
$sql_sort = $sort_by_sql[$sort_key] . ' ' . (($sort_dir == 'd') ? 'DESC' : 'ASC');

$keywords = utf8_normalize_nfc(request_var('keywords', '', true));
$keywords_param = ($keywords) ? '&amp;keywords=' . urlencode(htmlspecialchars_decode($keywords)) : '';


$u_action = append_sid("{$tonjaw_admin_path}log.$phpEx", "mode=list");

//GRAB LOGS DATA
$log_data = array();
$log_count = 0;
//$sql_sort = 'log_time DESC';
$start = view_logs($log_data, $log_count, $config['recs_per_page'], $start, $sql_where, $sql_sort, $keywords);

// Generate the page
adm_page_header($module->active_module_name);


foreach ($log_data as $row)
{
    //$data = array();

    $template->assign_block_vars('log', array(
	'TIME'			=> date($config['log_dateformat'], $row['id']),
	'U_TIME'		=> append_sid("{$tonjaw_admin_path}logdetail.$phpEx", "mode=view") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'USERNAME'		=> $row['user'],
	'ACTION'		=> $row['action'],
	'MODULE'		=> $row['module'],
	'MAC'			=> $row['mac'],
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
    //'L_TITLE'			=> $adm_lang['users_online'] . $config['session_length']/3600 . ' hour',
    'L_SEARCH_KEYWORDS'		=> $adm_lang['search_keyword'],
    'L_SEARCH'			=> $adm_lang['search'],
    'L_MAC'			=> $adm_lang['mac'],
    'L_TIME'			=> $adm_lang['time'],
    'L_ACTION'			=> $adm_lang['action'],
    'L_USERNAME'		=> $adm_lang['username'],
    'L_MODULE'			=> $adm_lang['module'],
    'S_LOGS'			=> ($log_count > 0),
    'S_FACEBOX'			=> '1',
    //'S_ON_PAGE'			=> on_page($log_count, $config['recs_per_page'], $start),
    //'PAGINATION'		=> generate_pagination($u_action . "&amp;$u_sort_param$keywords_param", $log_count, $config['recs_per_page'], $start, true),
    'L_DISPLAY_LOG'		=> $adm_lang['display_log'],
    'L_SORT_BY'			=> $adm_lang['sort_by'],
    'L_GO'			=> $adm_lang['go'],
    'L_NO_ENTRIES'		=> $adm_lang['no_entry'],
    'S_LIMIT_DAYS'		=> $s_limit_days,
    'S_SORT_KEY'		=> $s_sort_key,
    'S_SORT_DIR'		=> $s_sort_dir,
    'S_KEYWORDS'		=> $keywords,

    ));

$template->set_filenames(array(
	'body' => 'admin_log.tpl',
));

//add_log($adm_lang['read']);
page_footer();


?>