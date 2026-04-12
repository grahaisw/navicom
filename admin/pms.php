<?php
/**
*
* admin/pms.php
*
* Roberto Tonjaw. May 2014
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

require($tonjaw_root_path . $config['include_path'] . 'functions_module.' . 
$phpEx);
//require($tonjaw_root_path . $config['pms_path'] . $pmsname . '.' . $phpEx);

// Instantiate new module
$module = new p_master();
//$pms	= new $pms_api();

$template->set_template();

// Instantiate module system and generate list of available modules
$module->list_modules($file[0]);

//Generate detail menu of the selected module
$module->list_modules_detail($file[0], $module->p_id);

// Assign data to the template engine for the list of modules
// We do this before loading the active module for correct menu display in trigger_error
$module->assign_tpl_vars(append_sid("{$tonjaw_admin_path}index.$phpEx"));

$hotel_info = array();
$pms_info = array();

//$hotel_info = $pms->get_hotel_info();
//$pms_info = $pms->get_pms_info();
//echo file_get_contents("http://192.168.101.180:1968/api/2.0/xml/"); exit;


adm_page_header($module->active_module_name);

$template->assign_vars(array(
    'HIDE_DISPLAY_SIDE_MENU'	=> $adm_lang['hide_display_side_menu'],
    //'T_LOG_JS_PATH'		=> $tonjaw_root_path . $config['js_path'] . 
'log.js',
    'LOGIN_AS'			=> $adm_lang['login_as'],
    'USERNAME'			=> $session->username,
    'U_LOGOUT'			=> 
append_sid("{$tonjaw_admin_path}index.$phpEx") . '&amp;mode=logout',
    'L_LOGOUT'			=> $adm_lang['logout'],
    'MODULE_TITLE'		=> $module->active_module_name,
    'MODULE_DESC' 		=> $module->active_module_desc,
    'S_HOTEL_NAME'		=> $hotel_info['hotel_name'],
    'S_HOTEL_ADDRESS'		=> $hotel_info['address'],
    'L_HOTEL_PHONE'		=> $adm_lang['phone'],
    'S_HOTEL_PHONE'		=> $hotel_info['phone'],
    'L_HOTEL_FAX'		=> $adm_lang['fax'],
    'S_HOTEL_FAX'		=> $hotel_info['fax'],
    'L_HOTEL_EMAIL'		=> $adm_lang['email'],
    'S_HOTEL_EMAIL'		=> $hotel_info['email'],
    //'S_PMS_NAME'		=> $pms_info['pms_name'],
    'L_PMS_VERSION'		=> $adm_lang['version'],
    //'S_PMS_VERSION'		=> $pms_info['pms_version'],
    'L_PMS_VENDOR'		=> $adm_lang['vendor'],
    //'S_PMS_VENDOR'		=> $pms_info['pms_vendor'],
    'L_PMS_WEBSITE'		=> $adm_lang['website'],
    //'S_PMS_WEBSITE'		=> $pms_info['pms_website'],
));

$template->set_filenames(array(
	'body' => 'admin_pms.tpl',
));

page_footer();



?>