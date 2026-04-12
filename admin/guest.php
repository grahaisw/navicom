<?php
/**
*
* admin/guest.php
*
* Roberto Tonjaw. Apr 2014
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

//GRAB GUESTS DATA
$guest_data = array();
$guest_count = 0;
//$sql_sort = 'log_time DESC';
$start = view_guests($guest_data, $guest_count);

// Generate the page
adm_page_header($module->active_module_name);

//print_r($guest_data); exit;
foreach ($guest_data as $row)
{
    //$data = array();
    if ( empty($row['fullname']) )
    {
	$name = $row['lastname'] . ', ' . $row['firstname'];
    }
    else
    {
	$name = $row['fullname'];
    }

    $template->assign_block_vars('guest', array(
	'S_RESV_ID'		=> $row['resv_id'],
	'S_ROOM'		=> $row['room'],
	'U_NAME'		=> append_sid("{$tonjaw_admin_path}guestdetail.$phpEx", "mode=detail") . '&amp;id=' . $row['resv_id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'S_NAME'		=> $name,
	'S_SALUTATION'		=> $row['salutation'],
	'S_ARRIVAL'		=> date($config['default_dateformat'], $row['arrival']),
	//'S_GROUP'		=> $row['group'],
	//'S_ROOM_SHARE'		=> $row['room_share'],
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

    'L_RESV_ID'			=> $adm_lang['reservation_id'],
    'L_ROOM'			=> $adm_lang['room'],
    'L_NAME'			=> $adm_lang['name'],
    'L_ARRIVAL'			=> $adm_lang['arrival_date'],
    'L_GROUP'			=> $adm_lang['group'],
    'L_ROOM_SHARE'		=> $adm_lang['room_share'],
    'S_GUESTS'			=> ($guest_count > 0),
    'S_DATATABLE_NODES'		=> '1',
    'S_FOURTH_FIELD'		=> '1',
    'S_EIGHT_FIELD'		=> '1',
    'S_SEVENTH_FIELD'		=> '1',
    'S_ADD_UPDATE'		=> $module->user_priviledge[1],
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}guestdetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['check_in'],
    //'S_ON_PAGE'			=> on_page($log_count, $config['recs_per_page'], $start),
    //'PAGINATION'		=> generate_pagination($u_action . "&amp;$u_sort_param$keywords_param", $log_count, $config['recs_per_page'], $start, true),
    ));

$template->set_filenames(array(
	'body' => 'admin_guest.tpl',
));

//add_log($adm_lang['read']);
page_footer();




?>
