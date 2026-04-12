<?php
/**
*
* admin/signage/signage_general.php
*
* Agnes Emanuella. Nov 2014
*/

/**
*/
define('IN_TONJAW', true);
define('IN_ADMIN', true);
define('NEED_SID', true);

$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './../../';
$phpEx = substr(strrchr( $_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr( $_SERVER['PHP_SELF'], '/'), 1));

// Include files
require($tonjaw_root_path . 'common.' . $phpEx);
$tonjaw_admin_path = $tonjaw_root_path . $config['admin_path'];
require($tonjaw_admin_path . 'common_adm.' . $phpEx);
$tonjaw_admin_signage_path = $tonjaw_root_path . $config['signage_path'];

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
$module->assign_tpl_vars(append_sid("{$tonjaw_admin_signage_path}index.$phpEx"));

// Set up general vars
$mode		= request_var('mode', 'list');
$sid 		= request_var('sid', '');
$modules	= request_var('module', '');
$rid		= request_var('id', '');

$u_action = append_sid("{$tonjaw_admin_signage_path}signage_general.$phpEx", "mode=update");

// Preparing data
/*if (isset($_POST['submit']))
{
  
}*/

//GRAB DATA
$signage_data = array();
$signage_count = 0;
$start = view_general($signage_data, $signage_count);

if ($mode === 'update')
{
    $signage_id	= array();
    $mark	= array();
    
    $signage_id	= (isset($_REQUEST['signage_id'])) ? request_var('signage_id', array('0')) : array();
	//print_r($signage_id); exit;
    $i = 0;
    foreach($signage_data as $row)
    {
	$mark[$i] = !empty(request_var('mark_' . $signage_id[$i], ''))? '1' : '0';
	
	$sql = 'UPDATE ' . SIGNAGE_GENERALS_TABLE . ' 
	  SET signage_general_enabled=' . (string) $mark[$i] ."
	  WHERE signage_general_id=" . $signage_id[$i];
	//echo $sql . "<br/>"; 
	if( !empty($signage_id[$i]) )
	{
		$db->sql_query($sql);
	}
	
	$i++;
    }
    //exit;
    redirect($config['signage_path'] . 'signage_general.' . $phpEx, $sid);

}

if (isset($_GET['id']) && $mode === 'delete')
{
    $signage_id = request_var('id', '');
    
    $sql = 'DELETE FROM ' . SIGNAGE_GENERALS_TABLE . ' WHERE signage_general_id = ' . (int) $signage_id;
    //$db->sql_query($sql);
    
    //redirect($config['admin_path'] . 'node.' . $phpEx, $sid);
    echo 'ready to wipe out ID: ' . $rid . '</br>SQL: ' . $sql; exit;
}

adm_page_header($module->active_module_name);

foreach ($signage_data as $row)
{
    //$data = array();
    $template->assign_block_vars('signage', array(
	'TITLE'			=> $row['title'],
	'DATE'	    	=> date($config['schedule_dateformat'], $row['date']),
	'DESCRIPTION'   => $row['description'],
	'S_RID'			=> $row['id'],
    'V_ENABLED'		=> ($row['enabled'])? 'checked' : '',
	'ENABLED'		=> !empty($row['enabled']) ? 'Yes' : 'No',
	'U_UPDATE'		=> append_sid("{$tonjaw_admin_signage_path}signage_generaldetail.$phpEx", "mode=update") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_UPDATE'		=> $adm_lang['edit'],
	'U_DELETE'		=> append_sid("{$tonjaw_admin_signage_path}signage_general.$phpEx", "mode=delete") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
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
    'U_ADD'			    => append_sid("{$tonjaw_admin_signage_path}signage_generaldetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			    => $adm_lang['add'],
    'S_DATATABLE_NODES'		=> '1',
    'S_THIRD_FIELD'		=> '1',
    'S_FOURTH_FIELD'		=> '1',
    'L_REGION_GROUP_NAME' => $adm_lang['region_group'],
    'L_TITLE'			=> $adm_lang['title'],
    'L_DATE'	        => $adm_lang['date'],
    'L_SUBMIT'			=> $adm_lang['submit'],
    'S_SIGNAGES'		=> ($signage_count > 0),
	'L_DESCRIPTION'		=> $adm_lang['description'],
    'L_ENABLED'			=> $adm_lang['enabled'],
	
));

$template->set_filenames(array(
	'body' => 'admin_signage_general.tpl',
));

page_footer();


?>