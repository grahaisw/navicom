<?php
/**
*
* admin/lang.php
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
    $keyword = "WHERE language_enabled = '1'";
}

$u_action = append_sid("{$tonjaw_admin_path}lang.$phpEx", "mode=update");

//GRAB LANGUAGES DATA
$lang_data = array();
$lang_count = 0;
//$sql_sort = 'log_time DESC';
$start = view_langs($lang_data, $lang_count, $keyword);

if ($mode === 'update')
{
    $lid	= array();
    $mark	= array();
    
    $lid	= (isset($_REQUEST['lid'])) ? request_var('lid', array('0')) : array();
  
    $i = 0;
    foreach($lang_data as $row)
    {
	$mark[$i] = request_var('mark_' . $lid[$i], '')? '1' : '0';
    
	$sql = 'UPDATE ' . LANGUAGES_TABLE . ' 
	  SET language_enabled=' . (string) $mark[$i] ."
	  WHERE language_id = '" . $lid[$i] . "'";
	  
	if( !empty($lid[$i]) )
	{
	    $db->sql_query($sql);
	}

	$i++;
    }
    
    redirect($config['admin_path'] . 'lang.' . $phpEx, $sid);
}

if (isset($_GET['id']) && $mode === 'delete')
{
    $lid	= request_var('id', '');
    
    $sql = 'DELETE FROM ' . LANGUAGES_TABLE . ' WHERE language_id = ' . (int) $lid;
    //$db->sql_query($sql);
    
    echo 'ready to wipe out ID: ' . $nid . '</br>SQL: ' . $sql; exit;
}

$flag_path = $tonjaw_root_path . $config['media_path'] . $config['flag_path'];

// Generate the page
adm_page_header($module->active_module_name);

foreach ($lang_data as $row)
{
    //echo '<p>' . $tonjaw_root_path . $config['language_path'] . $row['id'] . ".$phpEx";
    //$data = array();
    $template->assign_block_vars('lang', array(
	'NAME'			=> $row['name'],
	'ID'			=> $row['id'],
	'FLAG_FILE'		=> $flag_path . $row['flag'],
	'S_LID'			=> $row['id'],
	'S_ENABLED'		=> $row['enabled'],
	'ENABLED'		=> ($row['enabled']) ? 'Yes' : 'No',
	'V_ENABLED'		=> ($row['enabled'])? 'checked' : '',
	'EXIST'			=> file_exists($tonjaw_root_path . $config['language_path'] . $row['id'] . ".$phpEx")? $adm_lang['yes'] : $adm_lang['no'],
	'U_UPDATE'		=> append_sid("{$tonjaw_admin_path}langdetail.$phpEx", "mode=update") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_UPDATE'		=> $adm_lang['edit'],
	'U_DELETE'		=> append_sid("{$tonjaw_admin_path}lang.$phpEx", "mode=delete") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
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
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}langdetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '1',
    'S_THIRD_FIELD'		=> '1',
    'S_FOURTH_FIELD'		=> '1',

    'L_ID'			=> $adm_lang['code'],
    'L_NAME'			=> $adm_lang['lang'],
    'L_FLAG'			=> $adm_lang['flag'],
    'L_NO_ENTRIES'		=> $adm_lang['no_entry'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'L_EXIST'			=> $adm_lang['exist'],
    'S_LANG'			=> ($lang_count > 0),
    'L_SUBMIT'			=> $adm_lang['submit'],
    'L_CONFIRM_DELETE'		=> $adm_lang['confirm_delete'],
    ));

$template->set_filenames(array(
	'body' => 'admin_lang.tpl',
));

//add_log($adm_lang['read']);
page_footer();








?>