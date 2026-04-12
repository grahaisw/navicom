<?php
/**
*
* admin/weatherdetail.php
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

//echo $file[0]; exit;
//$template->set_template();

$parent 	= request_var('parent', '');
$mode		= request_var('mode', '');
$sid 		= request_var('sid', '');
$modules	= request_var('module', '');
$wid		= request_var('id', '');

$session->session_begin($parent);

require($tonjaw_root_path . $config['include_path'] . 'functions_module.' . $phpEx);

// Instantiate new module
$module = new p_master();

$template->set_template();

// Instantiate module system and generate list of available modules
$module->list_modules($parent);

//Generate detail menu of the selected module
$module->list_modules_detail($parent, $module->p_id);

// Assign data to the template engine for the list of modules
// We do this before loading the active module for correct menu display in trigger_error
$module->assign_tpl_vars(append_sid("{$tonjaw_admin_path}index.$phpEx"));

//$flag_file 	= '0';
$error = '';
$error_msg = '';

$u_action = $tonjaw_admin_path . 'weatherdetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    $city = request_var('city', '');
    $enabled_flag = request_var('enabled_flag', '');
    
    $enabled_flag = $enabled_flag == 'on' ? '1' : '0';

    $error = '';
    $error_msg = '';

    if(empty($city))
    {
	$error = true;
	$error_msg = 'City field cannot be left empty.';
	
	die($error_msg);
    }
    else
    {
    
	$sql_ary = array(
	    'weather_city'	=> $city,
	    'weather_enabled'	=> (int) $enabled_flag,
	    'weather_exist'	=> city_availability($city)? 1 : 0,
	);
	
	// Preparing upload poster file
	$path = $tonjaw_root_path . $config['media_path'] . $config['weather_icon_path'];
	$can_upload = (file_exists($tonjaw_root_path . $config['media_path'] . $config['weather_icon_path']) && tonjaw_is_writable($path) && (@ini_get('file_uploads') || strtolower(@ini_get('file_uploads')) == 'on')) ? true : false;
    
	if ($mode === 'add')
	{
	    if ((!empty($_FILES['uploadfile']['name'])) && $can_upload)
	    {
		//echo 'siap upload'; exit;
		require_once($tonjaw_root_path . $config['include_path'] . 'functions_image.' . $phpEx);

		//$filetype = explode('.', $_FILES['uploadfile']['name']);
		$newfilename = $_FILES['uploadfile']['name'];//$lang_id . '.' . $filetype[1];
	    
		$picture_name = upload_image($error, $error_msg, $newfilename, $_FILES['uploadfile']['tmp_name'], $_FILES['uploadfile']['size'], $_FILES['uploadfile']['type'], $path, 'city_icon');
		//list($sql_ary['user_avatar_type'], $sql_ary['language_flag'], $sql_ary['user_avatar_width'], $sql_ary['user_avatar_height']) = image_upload('flag', $lang_id, $error);
		$sql_ary['weather_country_icon'] = $picture_name;
	    }
	    elseif(!empty($_FILES['uploadfile']['name']) && !$can_upload)
	    {
		die('ga bs nulis');
	    }

	    if ( $error )
	    {
		die($error_msg);
	    }
      
	    $sql = 'INSERT INTO ' . WEATHER_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	
	    //echo $sql . 'master<p>'; //exit;
	    $db->sql_query($sql);

	}
    
	if ($mode === 'update')
	{
	    $sql = 'UPDATE ' . WEATHER_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE weather_id = $wid";
	
	    $db->sql_query($sql);
	}
    
    }

    //exit;
    redirect($config['admin_path'] . 'weather.' . $phpEx, $sid);
}

$detail_data = array();

if ($mode === 'update' || $mode === 'detail')
{
    if (empty($wid))
    {
	die('Missing Weather ID. Cannot update Weather Table.');
    }
    
    $label = ($mode === 'update') ? $adm_lang['update_item'] : $adm_lang['view_item'];
    
    // Grab page data
    $sql = 'SELECT * FROM ' . WEATHER_TABLE . " WHERE weather_id = $wid" ;

    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    
    $city_icon = ($data['weather_country_icon'])? $data['weather_country_icon'] : '0';
    $city_icon = $tonjaw_root_path . $config['media_path'] . $config['city_icon_path'] . $city_icon . $config['png_ext'];
    
    $weather_today_icon = ($data['weather_today_icon'])? $data['weather_today_icon'] : '0';
    $weather_today_icon = $tonjaw_root_path . $config['media_path'] . $config['weather_icon_path'] . $weather_today_icon . $config['png_ext'];

    $weather_day1_icon = ($data['weather_day1_icon'])? $data['weather_day1_icon'] : '0';
    $weather_day1_icon = $tonjaw_root_path . $config['media_path'] . $config['weather_icon_path'] . $weather_day1_icon . $config['png_ext'];

    $weather_day2_icon = ($data['weather_day2_icon'])? $data['weather_day2_icon'] : '0';
    $weather_day2_icon = $tonjaw_root_path . $config['media_path'] . $config['weather_icon_path'] . $weather_day2_icon . $config['png_ext'];

    $weather_day3_icon = ($data['weather_day3_icon'])? $data['weather_day3_icon'] : '0';
    $weather_day3_icon = $tonjaw_root_path . $config['media_path'] . $config['weather_icon_path'] . $weather_day3_icon . $config['png_ext'];

    if ( !file_exists(@tonjaw_realpath($city_icon)) )
    {
	$city_icon = $tonjaw_root_path . $config['media_path'] . $config['city_icon_path'] . $config['blank_png'];
    }
    
    if ( !file_exists(@tonjaw_realpath($weather_today_icon)) )
    {
	$weather_today_icon = $tonjaw_root_path . $config['media_path'] . $config['weather_icon_path'] . $config['blank_png'];
    }
    
    if ( !file_exists(@tonjaw_realpath($weather_day1_icon)) )
    {
	$weather_day1_icon = $tonjaw_root_path . $config['media_path'] . $config['weather_icon_path'] . $config['blank_png'];
    }
    
    if ( !file_exists(@tonjaw_realpath($weather_day2_icon)) )
    {
	$weather_day2_icon = $tonjaw_root_path . $config['media_path'] . $config['weather_icon_path'] . $config['blank_png'];
    }
    
    if ( !file_exists($weather_day3_icon) )
    {
	$weather_day3_icon = $tonjaw_root_path . $config['media_path'] . $config['weather_icon_path'] . $config['blank_png'];
    }
    
    //echo $weather_day3_icon; exit;
    //print_r($data); exit;
}

//$icon_city_path = $tonjaw_root_path . $config['media_path'] . $config['city_icon_path'];
//$icon_weather_path = $tonjaw_root_path . $config['media_path'] . $config['weather_icon_path'];
$label = (!$label) ? $adm_lang['add_item'] : $label;

adm_page_header($module->active_module_name);

$template->assign_vars(array(
    'HIDE_DISPLAY_SIDE_MENU'	=> $adm_lang['hide_display_side_menu'],
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
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}weatherdetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'L_CITY'			=> $adm_lang['city'],
    'L_FORECAST'		=> strtoupper($adm_lang['forecast']),
    'L_CITY_ICON'		=> $adm_lang['icon'],
    'L_NOTICE_CITY_ICON'	=> ($mode === 'update')? $adm_lang['upload_icon_city_notice'] : '',
    'L_TODAY'			=> $adm_lang['today'],
    'L_CITY_FULL'		=> $adm_lang['city'],
    'L_LABEL'			=> $label,
));

switch( $mode )
{
    case 'update':
    case 'add':

	$s_hidden_fields = build_hidden_fields(array(
	    'parent'	=> $parent,
	    'mode'	=> $mode,
	    'sid'	=> $sid,
	    'module'	=> $modules,
	    'id'	=> $wid)
	);

	$template->assign_vars(array(
	    'S_FORM'			=> '1',
	    'S_CITY'			=> $data['weather_city'],
	    'CITY_ICON_FILE'		=> $city_icon,
	    'S_CITY_ICON_FILE'		=> $thumbnail,
	    'S_CITY_ICON'		=> $data['city_icon'],
	    'L_SUBMIT'			=> $adm_lang['submit'],
	    'V_ENABLED'			=> ($data['weather_enabled'])? 'checked' : '',
	    'S_FORM_TOKEN'		=> $s_hidden_fields,
	));
	
	break;
	
    case 'detail':
    
	$template->assign_vars(array(
	    'S_DETAIL'		=> '1',
	    'S_CITY'		=> $data['weather_city'],
	    'S_CITY_ICON_FILE'	=> $thumbnail,
	    'S_CITY_ICON'	=> $data['city_icon'],
	    'S_CITY_FULL'	=> $data['weather_city_full'],
	    'S_ENABLED'		=> ($data['weather_enabled'])? $adm_lang['yes'] : $adm_lang['no'],
	    'CITY_FULL'		=> $data['weather_city_full'],
	    
	    'S_TODAY_TEXT'	=> $adm_lang['today'],
	    'S_TODAY_ICON'	=> $weather_today_icon,
	    'S_TODAY_TEMP_H'	=> $data['weather_today_temp_c_max'],
	    'S_TODAY_TEMP_L'	=> $data['weather_today_temp_c_min'],
	    'S_DAY1_TEXT'	=> $data['weather_day1_text'],
	    'S_DAY1_ICON'	=> $weather_day1_icon,
	    'S_DAY1_TEMP_H'	=> $data['weather_day1_temp_c_max'],
	    'S_DAY1_TEMP_L'	=> $data['weather_day1_temp_c_min'],
	    'S_DAY2_TEXT'	=> $data['weather_day2_text'],
	    'S_DAY2_ICON'	=> $weather_day2_icon,
	    'S_DAY2_TEMP_H'	=> $data['weather_day2_temp_c_max'],
	    'S_DAY2_TEMP_L'	=> $data['weather_day2_temp_c_min'],
	    'S_DAY3_TEXT'	=> $data['weather_day3_text'],
	    'S_DAY3_ICON'	=> $weather_day3_icon,
	    'S_DAY3_TEMP_H'	=> $data['weather_day3_temp_c_max'],
	    'S_DAY3_TEMP_L'	=> $data['weather_day3_temp_c_min'],
	    'L_EDIT'		=> $adm_lang['update'],
	    'U_EDIT'		=> append_sid("{$tonjaw_admin_path}weatherdetail.$phpEx", "mode=update") . '&amp;id=' .$wid . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
	));
	
	break;
	
}

$template->set_filenames(array(
	'body' => 'admin_weatherform.tpl',
));

page_footer();

?>