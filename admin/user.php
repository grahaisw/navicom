<?php
/**
*
* admin/user.php
*
* Roberto Tonjaw. Jan 2014
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
$mode		= request_var('mode', 'list');
$keyword	= request_var('v', '');
$sid 		= request_var('sid', '');

//$keyword = '';

if($keyword === 'all')
{
    $keyword = "WHERE u.user_enabled = '1'";
}

$u_action = append_sid("{$tonjaw_admin_path}user.$phpEx", "mode=update");
$p_action = append_sid("{$tonjaw_admin_path}priviledge.$phpEx", "mode=user");

//GRAB USER DATA
$user_data = array();
$user_count = 0;
//$sql_sort = 'log_time DESC';
$start = view_users($user_data, $user_count);

if ($mode === 'update')
{
    $uid	= array();
    $mark	= array();
    
    $uid	= (isset($_REQUEST['uid'])) ? request_var('uid', array('0')) : array();

    $i = 0;
    foreach($user_data as $row)
    {
	$mark[$i] = request_var('mark_' . $uid[$i], '')? '1' : '0';

	$sql = 'UPDATE ' . USERS_TABLE . ' 
	  SET user_enabled=' . (string) $mark[$i] ."
	  WHERE user_id = " . $uid[$i] ;
	  
	if( !empty($uid[$i]) )
	{
	    $db->sql_query($sql);
	    //echo '<p>' . $sql . "<br/>tv_id[$i]</p>";
	}
	
	$i++;
    }
    
    redirect($config['admin_path'] . 'user.' . $phpEx, $sid);
}

if (isset($_GET['id']) && $mode === 'delete')
{
    $uid	= request_var('id', '');
    
    $sql = 'DELETE FROM ' . USERS_TABLE . ' WHERE user_id = ' . (int) $uid;
    //$db->sql_query($sql);
    
    echo 'ready to wipe out ID: ' . $uid . '</br>SQL: ' . $sql; exit;
}

// Generate the page
adm_page_header($module->active_module_name);

foreach ($user_data as $row)
{
    //$data = array();
    $template->assign_block_vars('user', array(
	'NAME'			=> $row['name'],
	'FULLNAME'		=> $row['fullname'],
	'GROUPNAME'		=> $row['groupname'],
	'LAST_VISIT'		=> ($row['lastvisit']) ? date($config['default_dateformat'], $row['lastvisit']) : '' ,
	'S_UID'			=> $row['id'],
	'U_DETAIL'		=> append_sid("{$tonjaw_admin_path}userdetail.$phpEx", "mode=detail") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'V_ENABLED'		=> ($row['enabled'])? 'checked' : '',
	'ENABLED'		=> ($row['enabled']) ? 'Yes' : 'No',
	'U_UPDATE'		=> append_sid("{$tonjaw_admin_path}userdetail.$phpEx", "mode=update") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_UPDATE'		=> $adm_lang['edit'],
	'U_DELETE'		=> append_sid("{$tonjaw_admin_path}user.$phpEx", "mode=delete") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_DELETE'		=> $adm_lang['delete'],
	'ICON_PATH'		=> $tonjaw_root_path . $config['imageset_path'],
	'L_PRIVILEDGE'		=> $adm_lang['priviledge'],
	'U_PRIVILEDGE'		=> $p_action . '&amp;uid=' . $row['id'] . '&amp;module=' . $module->active_module_name,
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
    'U_ACTION'			=> $u_action . "&amp;$u_sort_param$keywords_param&amp;start=$start",
    //'L_TITLE'			=> $adm_lang['users_online'] . $config['session_length']/3600 . ' hour',
    'S_ADD_UPDATE'		=> $module->user_priviledge[1],
    'S_DELETE'			=> $module->user_priviledge[2],
    'S_PRIVILEDGE'		=> '1',
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}userdetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '1',
    'S_THIRD_FIELD'		=> '1',
    'S_FOURTH_FIELD'		=> '1',
    'S_SEVENTH_FIELD'		=> '1',
    'S_EIGHT_FIELD'		=> '1',
    'L_NAME'			=> $adm_lang['username'],
    'L_FULLNAME'		=> $adm_lang['fullname'],
    'L_GROUPNAME'		=> $adm_lang['group_name'],
    'L_LAST_VISIT'		=> $adm_lang['last_activity'],
    'L_NO_ENTRIES'		=> $adm_lang['no_entry'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'S_USER'			=> ($user_count > 0),
    'L_SUBMIT'			=> $adm_lang['submit'],
    'L_CONFIRM_DELETE'		=> $adm_lang['confirm_delete'],
    ));

$template->set_filenames(array(
	'body' => 'admin_user.tpl',
));

//add_log($adm_lang['read']);
page_footer();


?>