<?php
/**
*
* admin/room.php
*
* Roberto Tonjaw. Feb 2014
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
$sid 		= request_var('sid', '');
$modules	= request_var('module', '');
$rid		= request_var('id', '');

$u_action = append_sid("{$tonjaw_admin_path}room.$phpEx", "mode=update");

// Preparing data
if (isset($_POST['submit']))
{
  
}


//GRAB ROOMS DATA
$room_data = array();
$room_count = 0;
//$sql_sort = 'log_time DESC';
$start = view_rooms($room_data, $room_count);

if ($mode === 'update')
{
    $mid	= array();
    $mark	= array();
    
    $mid	= (isset($_REQUEST['room_id'])) ? request_var('room_id', array('0')) : array();

    $i = 0;
    foreach($room_data as $row)
    {
	$mark[$i] = request_var('mark_' . $mid[$i], '')? '1' : '0';
	
	$sql = 'UPDATE ' . ROOMS_TABLE . ' 
	  SET room_enabled=' . (string) $mark[$i] ."
	  WHERE room_id = '" . $mid[$i] . "'";
	
	if( !empty($mid[$i]) )
	{
	    $db->sql_query($sql);
	    //echo '<p>' . $sql . "<br/>tv_id[$i]</p>";
	}
	
	$i++;
    }
    
    redirect($config['admin_path'] . 'room.' . $phpEx, $sid);

}

if (isset($_GET['id']) && $mode === 'delete')
{

$nid        = request_var('id', '');

    $sql = 'DELETE FROM ' . ROOMS_TABLE . ' WHERE room_id = ' . (int) $nid;
    $db->sql_query($sql);

    redirect($config['admin_path'] . 'room.' . $phpEx, $sid);

}

adm_page_header($module->active_module_name);

foreach ($room_data as $row)
{
    //$data = array();
    $template->assign_block_vars('room', array(
	'NAME'			=> $row['name'],
	'DESCRIPTION'		=> $row['description'],
	'S_RID'			=> $row['id'],
	'NODES'			=> $row['node_name'],
	'ZONES'			=> $row['zone_name'],
	'V_ENABLED'		=> ($row['enabled'])? 'checked' : '',
	'ENABLED'		=> ($row['enabled']) ? 'Yes' : 'No',
	'U_UPDATE'		=> append_sid("{$tonjaw_admin_path}roomdetail.$phpEx", "mode=update") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_UPDATE'		=> $adm_lang['edit'],
	'U_DELETE'		=> append_sid("{$tonjaw_admin_path}room.$phpEx", "mode=delete") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
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
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}roomdetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '1',
    'S_FOURTH_FIELD'		=> '1',
    'S_FIFTH_FIELD'		=> '1',
    'S_SEVENTH_FIELD'		=> '1',
    'S_EIGHT_FIELD'		=> '1',
    'L_NAME'			=> $adm_lang['name'],
    'L_ZONES'			=> $adm_lang['zone'],
    'L_DESCRIPTION'		=> $adm_lang['description'],
    'L_NODES'			=> $adm_lang['node'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'L_SUBMIT'			=> $adm_lang['submit'],
    'S_ROOMS'			=> ($room_count > 0),
));

$template->set_filenames(array(
	'body' => 'admin_room.tpl',
));

page_footer();


?>
