<?php
/**
*
* admin/signage/signage_playlist.php
*
* Agnes Emanuella. Jul 2014
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

$u_action = append_sid("{$tonjaw_admin_signage_path}signage_playlist.$phpEx", "mode=update");

// Preparing data
if (isset($_POST['submit']))
{
  
}


//GRAB PLAYLIST DATA
$playlist_data = array();
$playlist_count = 0;
//$sql_sort = 'log_time DESC';
$start = view_signage_playlist($playlist_data, $playlist_count);

if ($mode === 'update')
{
    $playlist_id	= array();
    $mark	= array();
    
    $playlist_id	= (isset($_REQUEST['playlist_id'])) ? request_var('playlist_id', array('0')) : array();
	//print_r($playlist_id); exit;

    $i = 0;
	
    foreach($playlist_data as $row)
    {
	
	$mark[$i] = !empty(request_var('mark_' . $playlist_id[$i], ''))? '1' : '0';
	
	$sql = 'UPDATE ' . SIGNAGE_PLAYLIST_TABLE . ' 
	  SET playlist_enabled = ' . (string) $mark[$i] ."
	  WHERE playlist_id=" . $playlist_id[$i];
	  
	 //echo $sql . "<br/>"; 
	 if( !empty($playlist_id[$i]) )
	{
		$db->sql_query($sql);
	}
	
	$i++;
    }
    //exit;
    redirect($config['signage_path'] . 'signage_playlist.' . $phpEx, $sid);

}

if (isset($_GET['id']) && $mode === 'delete')
{

}

adm_page_header($module->active_module_name);

foreach ($playlist_data as $row)
{
    //$data = array();
    $template->assign_block_vars('signage', array(
	'NAME'			=> $row['name'],
	'DESCRIPTION'	=> $row['description'],
	'S_RID'			=> $row['id'],
    'TYPE'		    => $row['type'],
    'DURATION'		=> $row['duration'].' second',
	'V_ENABLED'		=> ($row['enabled'])? 'checked' : '',
	'ENABLED'		=> !empty($row['enabled']) ? 'Yes' : 'No',
	'U_UPDATE'		=> append_sid("{$tonjaw_admin_signage_path}signage_playlistdetail.$phpEx", "mode=update") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_UPDATE'		=> $adm_lang['edit'],
	'U_DELETE'		=> append_sid("{$tonjaw_admin_signage_path}signage_playlist.$phpEx", "mode=delete") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_DELETE'		=> $adm_lang['delete'],
	'ICON_PATH'		=> $tonjaw_root_path . $config['imageset_path'],
    'V_LOOP'		=> ($row['loop'])? 'checked' : '',
	'LOOP'		    => !empty($row['loop']) ? 'Yes' : 'No',
    'U_DETAIL'		=> append_sid("{$tonjaw_admin_signage_path}signage_playlistdetail.$phpEx", "mode=detail") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
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
    'U_ADD'			    => append_sid("{$tonjaw_admin_signage_path}signage_playlistdetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			    => $adm_lang['add'],
    'S_DATATABLE_NODES'		=> '1',
    'S_THIRD_FIELD'		=> '1',
    'S_FOURTH_FIELD'		=> '1',
    'L_NAME'			=> $adm_lang['name'],
    'L_TYPE'			=> $adm_lang['type'],
    'L_DESCRIPTION'		=> $adm_lang['description'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'L_SUBMIT'			=> $adm_lang['submit'],
    'S_SIGNAGES'		=> ($playlist_count > 0),
    'L_LOOP'			=> $adm_lang['loop'],
    'L_DURATION'		=> $adm_lang['duration'],
));

$template->set_filenames(array(
	'body' => 'admin_signage_playlist.tpl',
));

page_footer();


?>