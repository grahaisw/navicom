<?php
/**
*
* admin/group.php
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
    $keyword = "WHERE user_group_enabled = '1'";
}

$u_action = append_sid("{$tonjaw_admin_path}group.$phpEx", "mode=update");

//GRAB GROUP DATA
$group_data = array();
$group_count = 0;
//$sql_sort = 'log_time DESC';
$start = view_groups($group_data, $group_count);

if ($mode === 'update')
{
    $gid	= array();
    $mark	= array();
    
    $gid	= (isset($_REQUEST['gid'])) ? request_var('gid', array(0)) : array();

    $i = 0;
    foreach($group_data as $row)
    {

	$mark[$i] = request_var('mark_' . $gid[$i], '')? '1' : '0';
    
	$sql = 'UPDATE ' . USER_GROUPS_TABLE . ' 
	  SET user_group_enabled = ' . (string) $mark[$i] ."
	  WHERE user_group_id=" . $gid[$i];
	
	if( !empty($gid[$i]) )
	{
	    $db->sql_query($sql);
	}
	
	    //echo $sql . '<p>';
	    //echo '<p>ada yg rubah euy</br>lama:' . $row['enabled'] . '</br>baru:' . $mark[$i]; 
	    //echo '<p>Ready to update Node ID: ' . $nid[$i] . '</br>' . $sql . '<p>'; 
	$i++;
    }
    
    redirect($config['admin_path'] . 'group.' . $phpEx, $sid);
    //exit;
}

if (isset($_GET['id']) && $mode === 'delete')
{
    $nid	= request_var('id', '');
    
    $sql = 'DELETE FROM ' . USER_GROUPS_TABLE . ' WHERE user_group_id = ' . (int) $gid;
    //$db->sql_query($sql);
    
    //redirect($config['admin_path'] . 'node.' . $phpEx, $sid);
    echo 'ready to wipe out ID: ' . $nid . '</br>SQL: ' . $sql; exit;
}

//print_r($group_data); exit;
// Generate the page
adm_page_header($module->active_module_name);

foreach ($group_data as $row)
{
    //$data = array();
    $template->assign_block_vars('group', array(
	'NAME'			=> $row['name'],
	'DESCRIPTION'		=> $row['desc'],
	'S_GID'			=> $row['id'],
	//'S_ENABLED'		=> $row['enabled'],
	'V_ENABLED'		=> ($row['enabled'])? 'checked' : '',
	'ENABLED'		=> ($row['enabled']) ? 'Yes' : 'No',
	'U_UPDATE'		=> append_sid("{$tonjaw_admin_path}groupdetail.$phpEx", "mode=update") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_UPDATE'		=> $adm_lang['edit'],
	'U_DELETE'		=> append_sid("{$tonjaw_admin_path}group.$phpEx", "mode=delete") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
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
    'U_ACTION'			=> $u_action . "&amp;$u_sort_param$keywords_param&amp;start=$start",
    //'L_TITLE'			=> $adm_lang['users_online'] . $config['session_length']/3600 . ' hour',
    'S_ADD_UPDATE'		=> $module->user_priviledge[1],
    'S_DELETE'			=> $module->user_priviledge[2],
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}groupdetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '1',
    'S_THIRD_FIELD'		=> '1',
    'L_ID'			=> $adm_lang['code'],
    'L_NAME'			=> $adm_lang['group_name'],
    'L_DESCRIPTION'		=> $adm_lang['description'],
    'L_NO_ENTRIES'		=> $adm_lang['no_entry'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'S_GROUP'			=> ($group_count > 0),
    'L_SUBMIT'			=> $adm_lang['submit'],
    'L_CONFIRM_DELETE'		=> $adm_lang['confirm_delete'],
    ));

$template->set_filenames(array(
	'body' => 'admin_usergroup.tpl',
));

//add_log($adm_lang['read']);
page_footer();


?>