<?php
/**
*
* admin/configuration.php
*
* Roberto Tonjaw. Dec 2014
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

$session->session_begin($file[0]);

require($tonjaw_root_path . $config['include_path'] . 'functions_module.' . $phpEx);

// Instantiate new module
$module = new p_master();

$template->set_template();

// Instantiate module system and generate list of ava/*i*/lable modules
$module->list_modules($file[0]);

//Generate detail menu of the selected module
$module->list_modules_detail($file[0], $module->p_id);

// Assign data to the template engine for the list of modules
// We do this before loading the active module for correct menu display in trigger_error
$module->assign_tpl_vars(append_sid("{$tonjaw_admin_path}index.$phpEx"));

//$flag_file 	= '0';
$error = '';
$error_msg = '';

$u_action = append_sid("{$tonjaw_admin_path}configuration.$phpEx", "mode=update");

//GRAB CONFIG DATA FROM CONFIGURATION TABLE
$config_data = array();
$config_count = 0;
//$sql_sort = 'log_time DESC';
$start = grab_configurations($config_data, $config_count);


if ($mode === 'update')
{
  
    foreach ($config_data as $row)
    {
	${$row['title']} =  request_var($row['title'], '');
	//${$row['value']} =  request_var($row['value'], '');
    
	//echo $row['title'] . ' = ' . ${$row['title']} . '<br/>';
	$sql = 'UPDATE ' . CONFIGURATION_TABLE . " SET config_value='" . ${$row['title']} . "' WHERE config_title='" . $row['title'] . "'";
    
	//echo $sql . '<br>';
	$db->sql_query($sql);
    
    }
    
    
}

// Generate the page
adm_page_header($module->active_module_name);

foreach ($config_data as $row)
{
    //$data = array();    
    //echo $thumbnail; exit;
    $template->assign_block_vars('config', array(
	'S_CONFIG_NAME'		=> $row['name'],
	'S_CONFIG_TITLE'	=> $row['title'],
	'S_CONFIG_VALUE'	=> $row['value'],
	'S_CONFIG_ID'		=> $row['id'],
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
    'S_DATATABLE_NODES'		=> '0',
    'L_SUBMIT'			=> $adm_lang['submit'],
    'L_CONFIRM_DELETE'		=> $adm_lang['confirm_delete'],

));

$template->set_filenames(array(
	'body' => 'admin_configuration.tpl',
));

//add_log($adm_lang['read']);
page_footer();


//print_r($config_data); exit;



?>