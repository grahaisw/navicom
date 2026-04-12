<?php
/**
*
* admin/runningtext.php
*
* Agnes Emanuella. Mar 2014
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
$sid 		= request_var('sid', '');
$mid		= request_var('id', '');

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

//$flag_file 	= '0';
$error = '';
$error_msg = '';

$u_action = append_sid("{$tonjaw_admin_path}runningtext.$phpEx", "mode=update");

// This page depends on its parent and cannot be displayed alone

//GRAB RUNNINGTEXT DATA
$runningtext_data = array();
$runningtext_count = 0;
//$sql_sort = 'log_time DESC';
$start = grab_runningtext($runningtext_data, $runningtext_count);

//print_r($movie_data); exit;

if ($mode === 'update')
{
    $mid	= array();
    $mark	= array();
    
    $mid	= (isset($_REQUEST['message_id'])) ? request_var('message_id', array('0')) : array();

    //echo '<p>mid: '; print_r($mid);
    //echo '<br>mark: '; print_r($mark); echo '<p><p>'; exit; 
    
    $i = 0;
    foreach($runningtext_data as $row)
    {
	$mark[$i] = request_var('mark_' . $mid[$i], '')? '1' : '0';
	
	$sql = 'UPDATE ' . RUNNINGTEXT_TABLE . ' 
	  SET message_enabled=' . (string) $mark[$i] ."
	  WHERE message_id = '" . $mid[$i] . "'";
	
	if( !empty($mid[$i]) )
	{
	    $db->sql_query($sql);
	    //echo '<p>' . $sql . "<br/>tv_id[$i]</p>";
	}
	
	$i++;
    }
    
    redirect($config['admin_path'] . 'runningtext.' . $phpEx, $sid);

}

if (isset($_GET['id']) && $mode === 'delete')
{
    $nid        = request_var('id', '');

    $sql_message = "SELECT translation_message FROM " .  RUNNINGTEXT_TRANSLATIONS_TABLE . " WHERE language_id = 'en' AND message_id = " . (int) $nid;
    $result = $db->sql_query($sql_message);
    $message = $db->sql_fetchfield('translation_message');

    $sql = 'DELETE FROM ' .  RUNNINGTEXT_TABLE . ' WHERE message_id = ' . (int) $nid;
    $db->sql_query($sql);

    $sql_ary = array(
		'message_id'				=> (int) $nid,
		'message_text'				=> $message,
		'runningtext_log_time'		=> (int) time(),
		'runningtext_log_user'		=> $session->username,
		'runningtext_log_browser'	=> $session->browser,
     );
	 
     $sql_insert = 'INSERT INTO ' . RUNNINGTEXT_LOG_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
     $db->sql_query($sql_insert);

    redirect($config['admin_path'] . 'runningtext.' . $phpEx, $sid);
    //echo 'ready to wipe out ID: ' . $nid . '</br>SQL: ' . $sql; exit;

}


$thumbnail_path = $tonjaw_root_path . $config['media_path'] . $config['runningtext_icon_path'];

// Generate the page
adm_page_header($module->active_module_name);

foreach ($runningtext_data as $row)
{
    //$data = array();
    $thumbnail = file_exists($thumbnail_path.$row['thumbnail'])? $thumbnail_path.$row['thumbnail'] : $thumbnail_path.$config['default_thumbnail_movie'];
    
    $target = '<b>' . $row['zone'] . '</b><br/>' . $row['room'];
    
    //echo $thumbnail; exit;
    $template->assign_block_vars('runningtext', array(
	'S_MID'			=> $row['id'],
	'MESSAGE'		=> $row['message'],
	'TARGET'		=> $target, //($row['type'] == 1) ? 'Global' : 'Targetted',
	'ENABLED'		=> ($row['enabled']) ? 'Yes' : 'No',
	'GLOBAL'		=> ($row['global']) ? 'Yes' : 'No',
    'DAILY'        => ($row['daily']) ? 'Yes' : 'No',
    'START'         => date("Y-m-d H:i:s", $row['start']),
    'END'           => date("Y-m-d H:i:s", $row['end']),
	'V_ENABLED'		=> ($row['enabled'])? 'checked' : '',
	'U_UPDATE'		=> append_sid("{$tonjaw_admin_path}runningtextdetail.$phpEx", "mode=update") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_UPDATE'		=> $adm_lang['edit'],
	'U_NAME'		=> append_sid("{$tonjaw_admin_path}runningtextdetail.$phpEx", "mode=detail") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'U_DELETE'		=> append_sid("{$tonjaw_admin_path}runningtext.$phpEx", "mode=delete") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_DELETE'		=> $adm_lang['delete'],
	'ICON_PATH'		=> $tonjaw_root_path . $config['imageset_path'],
	'ORDER'			=> $row['order'],
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
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}runningtextdetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '1',
    'S_FOURTH_FIELD'		=> '1',
    'S_FIFTH_FIELD'		=> '1',
    'S_SEVENTH_FIELD'		=> '1',
    'L_ORDER'			=> $adm_lang['order'],
    'L_NAME'			=> $adm_lang['message'],
    'L_TARGET'			=> $adm_lang['target'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'L_GLOBAL'			=> $adm_lang['global'],
    'S_RUNNINGTEXT'		=> ($runningtext_count > 0),
    'L_SUBMIT'			=> $adm_lang['submit'],
    'L_CONFIRM_DELETE'	=> $adm_lang['confirm_delete'],
    'L_START'           => $adm_lang['start'],
    'L_END'             => $adm_lang['end'],
    'L_DAILY'           => $adm_lang['daily'],
	'L_ORDER'			=> $adm_lang['order'],
));

$template->set_filenames(array(
	'body' => 'admin_runningtext.tpl',
));

//add_log($adm_lang['read']);
page_footer();


?>
