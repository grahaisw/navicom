<?php
/**
*
* admin/style.php
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
$sid 		= request_var('sid', '');

//$keyword = '';

$u_action = append_sid("{$tonjaw_admin_path}style.$phpEx", "mode=update");

//GRAB STYLE DATA
$style_data = array();
$style_count = 0;
//$sql_sort = 'log_time DESC';
$start = view_styles($style_data, $style_count);

if ($mode === 'update')
{
    $style_id	= array();
    $mark	= array();
    
    $style_id	= (isset($_REQUEST['style_id'])) ? request_var('style_id', array(0)) : array();

    $i = 0;
    foreach($style_data as $row)
    {
	$mark[$i] = request_var('mark_' . $style_id[$i], '')? '1' : '0';
	
	$sql = 'UPDATE ' . STYLES_TABLE . ' 
	  SET style_active = ' . (string) $mark[$i] ."
	  WHERE style_id=" . $style_id[$i];
	  
	if( !empty($style_id[$i]) )
	{
	    $db->sql_query($sql);
	    //echo '<p>' . $sql . "<br/>tv_id[$i]</p>";
	}
	
	    //echo $sql . '<p>';
	    //echo '<p>ada yg rubah euy</br>lama:' . $row['enabled'] . '</br>baru:' . $mark[$i]; 
	    //echo '<p>Ready to update Node ID: ' . $nid[$i] . '</br>' . $sql . '<p>'; exit;
	$i++;
    }
    
    redirect($config['admin_path'] . 'style.' . $phpEx, $sid);
    //exit;
    
}

if (isset($_GET['id']) && $mode === 'delete')
{
    $style_id = request_var('id', '');
    
    $sql = 'DELETE FROM ' . STYLES_TABLE . ' WHERE style_id = ' . (int) $style_id;
    //$db->sql_query($sql);
    
    //redirect($config['admin_path'] . 'node.' . $phpEx, $sid);
    echo 'ready to wipe out ID: ' . $nid . '</br>SQL: ' . $sql; exit;
}

// Generate the page
adm_page_header($module->active_module_name);

//print_r($style_data); echo '<br/>count: ' . $style_count; exit;

foreach ($style_data as $row)
{
    //$data = array();
    $template->assign_block_vars('style', array(
	'NAME'			=> $row['name'],
	'DESCRIPTION'		=> $row['desc'],
	'S_NID'			=> $row['id'],
	//'S_ENABLED'		=> $row['enabled'],
	'V_ACTIVE'		=> ($row['active'])? 'checked' : '',
	'ACTIVE'		=> ($row['active']) ? 'Yes' : 'No',
	'TYPE'			=> ($row['type']) ? $adm_lang['control_panel'] : $adm_lang['front_end'],
	'EXIST'			=> file_exists($tonjaw_root_path . $config['style_path'] . $row['name'])? $adm_lang['yes'] : $adm_lang['no'],
	'U_UPDATE'		=> append_sid("{$tonjaw_admin_path}styledetail.$phpEx", "mode=update") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_UPDATE'		=> $adm_lang['edit'],
	'U_DELETE'		=> append_sid("{$tonjaw_admin_path}style.$phpEx", "mode=delete") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
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
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}styledetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '1',
    'S_FOURTH_FIELD'		=> '1',
    'S_FIFTH_FIELD'		=> '1',
    'S_SEVENTH_FIELD'		=> '1',
    'S_EIGHT_FIELD'		=> '1',
    'L_NAME'			=> $adm_lang['style_name'],
    'L_EXIST'			=> $adm_lang['exist'],
    'L_TYPE'			=> $adm_lang['type'],
    'L_DESCRIPTION'		=> $adm_lang['description'],
    'L_ACTIVE'			=> $adm_lang['active'],
    'S_STYLES'			=> ($style_count > 0),
    'L_SUBMIT'			=> $adm_lang['submit'],
    'L_CONFIRM_DELETE'		=> $adm_lang['confirm_delete'],
    ));

$template->set_filenames(array(
	'body' => 'admin_style.tpl',
));

//add_log($adm_lang['read']);
page_footer();

?>