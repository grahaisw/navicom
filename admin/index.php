<?php
/**
*
* admin/index.php
*
* Roberto Tonjaw. Dec 2013
*/

/**
*/
define('IN_TONJAW', true);
define('IN_ADMIN', true);
define('NEED_SID', true);


//echo '<p>' . getenv('REQUEST_URI') . '</p>';
//echo '<p>' . $browser . '</p>';
//echo time();
$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './../';
$phpEx = substr(strrchr( $_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr( $_SERVER['PHP_SELF'], '/'), 1));
//echo '' . __FILE__; exit;
// Include files
require($tonjaw_root_path . 'common.' . $phpEx);
$tonjaw_admin_path = $tonjaw_root_path . $config['admin_path'];
require($tonjaw_admin_path . 'common_adm.' . $phpEx);

$session->session_begin($file[0]);

require($tonjaw_root_path . $config['include_path'] . 'functions_module.' . $phpEx);
//require($tonjaw_root_path . $config['include_path'] . 'functions_admin.' . $phpEx);

// Some oft used variables
$module_id	= request_var('i', '');
//$cat_id		= request_var('icat', '');
$mode		= request_var('mode', '');

if(empty($module_id))
{ 
    $module_id = $config['dashboard_id'];
}


// Instantiate new module
$module = new p_master();

$template->set_template();

// Instantiate module system and generate list of available modules
$module->list_modules($file[0], $module_id);

//Generate detail menu of the selected module
$module->list_modules_detail($file[0], $cat_id);

// Assign data to the template engine for the list of modules
// We do this before loading the active module for correct menu display in trigger_error
$module->assign_tpl_vars(append_sid("{$tonjaw_admin_path}index.$phpEx"));

// Load and execute the relevant module
//$module->load_active();

//GRAB SESSIONS

$start		= request_var('start', 0);
$sort_key	= request_var('sk', 't');
$sort_dir	= request_var('sd', 'd');
/* PENDING
// Sorting
$sort_by_text = array('b' => $adm_lang['browser'], 'n' => $adm_lang['node'], 'l' => $adm_lang['last_activity'], 'm' => $adm_lang['module'], 'u' => $adm_lang['username']);
$sort_by_sql = array('b' => 'session_browser', 'n' => 'session_node', 'l' => 'session_start', 'm' => 'session_module', 'u' => 'session_username');
*/

$u_action = append_sid("{$tonjaw_admin_path}index.$phpEx", "");

//GRAB SESSIONS DATA
$session_data = array();
$session_count = 0;
$sql_sort = 'session_start DESC';
$start = view_session($session_data, $session_count, $config['recs_per_page'], $start, $sql_sort, $keywords);

//print_r($session_data); exit;

//unset $file();
// Generate the page
adm_page_header($module->active_module_name);


foreach ($session_data as $row)
{
    //$data = array();
/*
    $checks = array('viewtopic', 'viewlogs', 'viewforum');
    foreach ($checks as $check)
    {
	if (isset($row[$check]) && $row[$check])
	{
	    $data[] = '<a href="' . $row[$check] . '">' . $user->lang['LOGVIEW_' . strtoupper($check)] . '</a>';
	}
    }
*/
    $template->assign_block_vars('session', array(
	'MAC'			=> $row['mac'],
	'NODE'			=> $row['ip'],
	'USERNAME'		=> $row['username'],
	'LAST_ACTIVITY'		=> date($config['log_dateformat'], $row['start']),
	'MODULE'		=> $row['module'],
	'BROWSER'		=> $row['browser'],
    ));
}

$template->assign_vars(array(
    'HIDE_DISPLAY_SIDE_MENU'	=> $adm_lang['hide_display_side_menu'],
    'LOGIN_AS'			=> $adm_lang['login_as'],
    'USERNAME'			=> $session->username,
    'U_LOGOUT'			=> append_sid("{$tonjaw_admin_path}index.$phpEx") . '&amp;mode=logout',
    'L_LOGOUT'			=> $adm_lang['logout'],
    'MODULE_TITLE'		=> $module->active_module_name,
    'MODULE_DESC' 		=> $module->active_module_desc,
    'L_TITLE'			=> $adm_lang['users_online'] . $config['session_length']/3600 . ' hour',
    'L_SEARCH_KEYWORDS'		=> $adm_lang['search_keyword'],
    'L_SEARCH'			=> $adm_lang['search'],
    'L_MAC'			=> $adm_lang['mac'],
    'L_IP'			=> $adm_lang['ip'],
    'L_LAST_ACTIVITY'		=> $adm_lang['last_activity'],
    'L_USERNAME'		=> $adm_lang['username'],
    'L_BROWSER'			=> $adm_lang['browser'],
    'L_MODULE'			=> $adm_lang['module'],
    'S_SESSIONS'		=> ($session_count > 0),
    'PAGINATION'		=> generate_pagination($u_action . "&amp;$u_sort_param$keywords_param", $session_count, $config['recs_per_page'], $start, true),

    ));

$template->set_filenames(array(
	'body' => 'admin_dashboard.tpl',
));

//add_log($adm_lang['read']);
page_footer();


?>

