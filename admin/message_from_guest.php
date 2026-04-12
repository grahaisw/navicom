<?php
/**
*
* admin/message_from_guest.php
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
$mode	= request_var('mode', 'list');
$sid 	= request_var('sid', '');
$mid 	= request_var('id', '');
$sound 	= null;

$u_action = append_sid("{$tonjaw_admin_path}message_from_guest.$phpEx", "mode=update");

//GRAB BUFFER DATA
$guest_message_data = array();
$guest_message_count = 0;

$start = view_guest_messages($guest_message_data, $guest_message_count);



if ($mode === 'read')
{
	$sql = 'UPDATE ' . GUEST_MESSAGES_TABLE . ' 
	  SET guest_message_read = 1 WHERE guest_message_id=' . $mid;
	  
	$db->sql_query($sql);
	
	redirect($config['admin_path'] . 'message_from_guest.' . $phpEx, $sid);
}

if ($mode === 'delete')
{
	$sql = 'DELETE FROM ' . GUEST_MESSAGES_TABLE . ' 
	  WHERE guest_message_id=' . $mid;
	  
	$db->sql_query($sql);
	
	redirect($config['admin_path'] . 'message_from_guest.' . $phpEx, $sid);
}

// Generate the page
adm_page_header($module->active_module_name);

foreach ($guest_message_data as $row)
{
    //$data = array();
    //$button_flag = ($row['approved'] == 1 ) ? 'Yes' : 'No';
    //$sound = ($row['approved'] == 1 ) ? true : false;
    if ( $row['read'] == 0  )
    {
	$sound = true;
    }
   
    $template->assign_block_vars('message', array(
	'DATETIME'		=> date($config['log_dateformat'], $row['date']),
	'ROOM'			=> $row['room_name'],
	'S_MID'			=> $row['id'],
	'SUBJECT'		=> prepare_message($row['subject']),
	'CONTENT'		=> prepare_message($row['content']),
	'READ'			=> ($row['read'] == 1 ) ? 'Yes' : 'No',
	'S_NOT_READ'		=> ($row['read'] == 0 ) ? 1 : null,
	'U_READ'		=> append_sid("{$tonjaw_admin_path}message_from_guest.$phpEx", "mode=read") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_READ'		=> $adm_lang['process'],
	
	'U_DELETE'		=> append_sid("{$tonjaw_admin_path}message_from_guest.$phpEx", "mode=delete") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
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
    'S_DATATABLE_NODES'		=> '1',
    'S_FOURTH_FIELD'		=> '1',
    'S_FIFTH_FIELD'		=> '1',
    'S_SEVENTH_FIELD'		=> '1',
    //'S_EIGHT_FIELD'		=> '1',
    //'S_NINTH_FIELD'		=> '1',
    'S_SOUND'			=> $sound,
    'T_MEDIA_AUDIO_PATH'	=> $tonjaw_root_path . $config['media_path'] . $config['audio_path'],
    'L_DATETIME'		=> $adm_lang['datetime'],
    'L_ROOM'			=> $adm_lang['room'],
    'L_SUBJECT'			=> $adm_lang['subject'],
    'L_CONTENT'			=> $adm_lang['content'],
    'S_GUEST_MESSAGE'		=> ($guest_message_count > 0),
    'S_IN_GUEST_MESSAGE'	=> '1',
    'L_SUBMIT'			=> $adm_lang['delete'],
    'L_CONFIRM_DELETE'		=> $adm_lang['confirm_delete'],
    
    ));
    
    

$template->set_filenames(array(
	'body' => 'admin_guest_message.tpl',
));

//add_log($adm_lang['read']);
page_footer();







?>