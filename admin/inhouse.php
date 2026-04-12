<?php
/**
*
* admin/inhouse.php
*
* Agnes Emanuella. Mei 2015
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
$did		= request_var('id', '');

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

$u_action = append_sid("{$tonjaw_admin_path}inhouse.$phpEx", "mode=update");

//GRAB FITNESS DATA
$directory_data = array();
$directory_count = 0;
//$sql_sort = 'log_time DESC';

$start = grab_directory_grouping($directory_data, $directory_count, "inhouse");
//print_r($start); exit;

if ($mode === 'update')
{
    $mid	= array();
    $mark	= array();
    
    $mid	= (isset($_REQUEST['inhouses_id'])) ? request_var('inhouses_id', array('0')) : array();

    //echo '<p>mid: '; print_r($mid);
    //echo '<br>mark: '; print_r($mark); echo '<p><p>'; exit; 
    
    $i = 0;
    foreach($directory_data as $row)
    {
	$mark[$i] = request_var('mark_' . $mid[$i], '')? '1' : '0';
	
	$sql = 'UPDATE ' . INHOUSES_TABLE . ' 
	  SET inhouses_enabled=' . (string) $mark[$i] ."
	  WHERE inhouses_id = '" . $mid[$i] . "'";
	
	if( !empty($mid[$i]) )
	{
	    $db->sql_query($sql);
	    //echo '<p>' . $sql . "<br/>tv_id[$i]</p>";
	}
	
	$i++;
    }
    
    redirect($config['admin_path'] . 'inhouse.' . $phpEx, $sid);

}

if (isset($_GET['id']) && $mode === 'delete')
{

}

$thumbnail_path = $tonjaw_root_path . $config['media_path'] . $config['fitness_image_path'];

// Generate the page
adm_page_header($module->active_module_name);

foreach ($directory_data as $row)
{
    //$data = array();
    $thumbnail = file_exists($thumbnail_path.$row['image'])? $thumbnail_path.$row['image'] : $thumbnail_path.$config['default_thumbnail_fitness'];
    
    //echo $thumbnail; exit;
    $template->assign_block_vars('directory', array(
	'S_DID'			=> $row['id'],
	'TITLE'			=> $row['title'],
	'U_TITLE'		=> append_sid("{$tonjaw_admin_path}inhousedetail.$phpEx", "mode=detail") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'IMAGE_ENABLED'		=> ($row['image_enabled']) ? 'Yes' : 'No',
	'CLIP_ENABLED'		=> ($row['clip_enabled']) ? 'Yes' : 'No',
	'ORDER'			=> $row['order'],
	'THUMBNAIL'		=> $thumbnail,
	'ENABLED'		=> ($row['enabled']) ? 'Yes' : 'No',
	'V_ENABLED'		=> ($row['enabled'])? 'checked' : '',
	'U_UPDATE'		=> append_sid("{$tonjaw_admin_path}inhousedetail.$phpEx", "mode=update") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
	'L_UPDATE'		=> $adm_lang['edit'],
	'U_DELETE'		=> append_sid("{$tonjaw_admin_path}inhouse.$phpEx", "mode=delete") . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
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
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}inhousedetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '1',
    'S_FOURTH_FIELD'		=> '1',
    'S_EIGHT_FIELD'		=> '1',
    'S_SEVENTH_FIELD'		=> '1',
    'S_NINTH_FIELD'		=> '1',
    'L_ORDER'			=> $adm_lang['order'],
    'L_THUMBNAIL'		=> $adm_lang['image'],
    'L_TITLE'			=> $adm_lang['title'],
    'L_IMAGE_ENABLED'		=> $adm_lang['image_only'],
    'L_CLIP_ENABLED'		=> $adm_lang['clip_only'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'S_DIRECTORY'		=> ($directory_count > 0),
    'L_SUBMIT'			=> $adm_lang['submit'],
    'L_CONFIRM_DELETE'		=> $adm_lang['confirm_delete'],
    'ICON_PATH'			=> $tonjaw_root_path . $config['imageset_path'],

));

$template->set_filenames(array(
	'body' => 'admin_inhouse.tpl',
));

//add_log($adm_lang['read']);
page_footer();




?>