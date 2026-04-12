<?php
/**
*
* admin/tv_promodetail.php
*
* Agnes Emanuella. Dec 2014
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
$tid		= request_var('id', '');

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
$group_data = array();

$u_action = $tonjaw_admin_path . 'tv_promodetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    // Preparing UPDATE TV PROMO TABLE
    $title = utf8_normalize_nfc(request_var('title', ''));
    $description = request_var('description', '');
    $thumbnail = utf8_normalize_nfc(request_var('thumbnail', ''));
    $start = strtotime(request_var('start', ''));
    $end = strtotime(request_var('end', ''));
    $default_flag = request_var('default_flag', '');
    $default_flag = $default_flag == 'on' ? '1' : '0' ;
	$enabled_flag = request_var('enabled_flag', '');
    $enabled_flag = $enabled_flag == 'on' ? '1' : '0' ;
    
    $sql_ary = array(
	    'tv_promo_title'		=> $title,
	    'tv_promo_description'	=> $description,
	    'tv_promo_thumbnail'	=> $thumbnail,
	    'tv_promo_start'		=> $start,
	    'tv_promo_end'			=> $end,
	    'tv_promo_default'		=> (int) ($default_flag),
	    'tv_promo_enabled'		=> (int) $enabled_flag,
    );

    if ($mode === 'add')
    {
	$sql = 'INSERT INTO ' . TV_PROMO_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	
	//echo $sql . 'master<p>'; //exit;
	$db->sql_query($sql);
	$tid = $db->sql_nextid();
	   
    }
    
    if ($mode === 'update')
    {
	$sql = 'UPDATE ' . TV_PROMO_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE tv_promo_id = $tid";
	$db->sql_query($sql);
	
    }
    
    redirect($config['admin_path'] . 'tv_promo.' . $phpEx, $sid);

}

if ($mode === 'update' || $mode === 'detail')
{
    if (empty($tid))
    {
	die('Missing TV Channel ID. Cannot update TV Channel Table.');
    }
    
    $label = ($mode === 'update') ? $adm_lang['update_item'] : $adm_lang['view_item'];
    
    // Grab tv data
    $sql = 'SELECT * FROM ' . TV_PROMO_TABLE . " WHERE tv_promo_id = $tid" ;

    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    
    $data_thumbnail = ($data['tv_promo_thumbnail'])? $data['tv_promo_thumbnail'] : '0';
    $thumbnail = $tonjaw_root_path . $config['media_path'] . $config['tv_icon_path'] . $data_thumbnail;
    
    $sql = 'SELECT tv_channel_group_id FROM ' . TV_GROUPINGS_TABLE . " WHERE tv_channel_id = $tid";
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    //$detail = $db->sql_fetchrow($result);
    
    $i = 0;
    while ($detail = $db->sql_fetchrow($result))
    {
	$group_data[$i] = $detail['tv_channel_group_id'];
	
	$i++;

    }
    
    $db->sql_freeresult($result);
    
}

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
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}tv_promodetail.$phpEx", "mode=add") . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
    'L_TITLE'			=> $adm_lang['title'],
    'L_DESCRIPTION'		=> $adm_lang['description'],
    'L_START'			=> $adm_lang['start'],
    'L_END'				=> $adm_lang['end'],
    'L_DEFAULT'			=> $adm_lang['default'],
    'L_ADD'				=> $adm_lang['add'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'L_THUMBNAIL'		=> $adm_lang['thumbnail'],
	'L_PICK'			=> $adm_lang['pick'],
    'THUMBNAIL_FILE'	=> file_exists($thumbnail)? '1' : '0',
    'S_THUMBNAIL_FILE'	=> $thumbnail,
	'S_THUMBNAIL'		=> $data_thumbnail,
    'S_START'		    => date($config['schedule_dateformat'], $data['tv_promo_start']),
	'S_END'			    => date($config['schedule_dateformat'], $data['tv_promo_end']),
    'S_TITLE'			=> $data['tv_promo_title'],
    'S_DESCRIPTION'		=> $data['tv_promo_description'],
	'S_DATETIME_PICKER'	=> '1',
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
	    'id'	=> $tid)
	);


	$template->assign_vars(array(
	    'L_NOTICE_THUMBNAIL'	=> $adm_lang['upload_thumbnail_notice'],
	    'S_THUMBNAIL'		=> $data_thumbnail,
	    'S_FORM'			=> '1',
	    'S_DEFAULT'			=> ($data['tv_promo_default'])? 'checked' : '',
	    'L_SUBMIT'			=> $adm_lang['submit'],
	    'S_ENABLED'			=> ($data['tv_promo_enabled'])? 'checked' : '',
	    'S_FORM_TOKEN'		=> $s_hidden_fields,
	));
	
	break;
	
    case 'detail':
    
	
	
	$template->assign_vars(array(
	    'S_GROUPNAME'	=> '',
	    
	    'S_DETAIL'		=> '1',
	    'S_DEFAULT'		=> ($data['tv_promo_default'])? $adm_lang['yes'] : $adm_lang['no'],
	    'S_ENABLED'		=> ($data['tv_promo_enabled'])? $adm_lang['yes'] : $adm_lang['no'],
	    'L_EDIT'		=> $adm_lang['update'],
	    'U_EDIT'		=> append_sid("{$tonjaw_admin_path}tv_promodetail.$phpEx", "mode=update") . '&amp;id=' .$tid . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
	));
	
	break;
	
}


$template->set_filenames(array(
	'body' => 'admin_tv_promoform.tpl',
));

page_footer();


?>