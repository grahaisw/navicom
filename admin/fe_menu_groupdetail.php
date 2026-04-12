<?php
/**
*
* admin/fe_menu_groupdetail.php
*
* Roberto Tonjaw. Mar 2015
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
$mid		= request_var('id', '');

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

$u_action = $tonjaw_admin_path . 'fe_menu_groupdetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    // Preparing UPDATE MENU TABLE
    $order = request_var('order', '');
    $enabled_flag = request_var('enabled_flag', '');
    $enabled_flag = $enabled_flag == 'on' ? '1' : '0' ;
    
    $in_mobile_flag = request_var('in_mobile_flag', '');
    $in_mobile_flag = $in_mobile_flag == 'on' ? '1' : '0' ;
    
    $in_stb_flag = request_var('in_stb_flag', '');
    $in_stb_flag = $in_stb_flag == 'on' ? '1' : '0' ;
    
    $in_empty_room_flag = request_var('in_empty_room_flag', '');
    $in_empty_room_flag = $in_empty_room_flag == 'on' ? '1' : '0' ;
    
    $thumbnail = request_var('thumbnail', '');
    $runningtext_enabled_flag = request_var('runningtext_enabled_flag', '');
    $runningtext_enabled_flag = $runningtext_enabled_flag == 'on' ? '1' : '0' ;
    
    $sql_ary = array(
	'menu_group_order'			=> (int) ($order)? $order : '0',
	'menu_group_in_mobile'			=> (int) $in_mobile_flag,
	'menu_group_in_stb'			=> (int) $in_stb_flag,
	'menu_group_in_empty_room'		=> (int) $in_empty_room_flag,
	'menu_group_enabled'			=> (int) $enabled_flag,
	'menu_group_thumbnail'			=> $thumbnail,
	'menu_group_runningtext_enabled'	=> (int) $runningtext_enabled_flag,
    );
    
    if ($mode === 'add')
    {
	$error = '';
	$error_msg = '';
/*
	if ((!empty($_FILES['uploadfile']['name'])) && $can_upload)
	{
	    //echo 'siap upload'; exit;
	    require_once($tonjaw_root_path . $config['include_path'] . 'functions_image.' . $phpEx);

	    //$filetype = explode('.', $_FILES['uploadfile']['name']);
	    $newfilename = $_FILES['uploadfile']['name'];//$lang_id . '.' . $filetype[1];
	    
	    $picture_name = upload_image($error, $error_msg, $newfilename, $_FILES['uploadfile']['tmp_name'], $_FILES['uploadfile']['size'], $_FILES['uploadfile']['type'], $path, 'menu');
	    //list($sql_ary['user_avatar_type'], $sql_ary['language_flag'], $sql_ary['user_avatar_width'], $sql_ary['user_avatar_height']) = image_upload('flag', $lang_id, $error);
	    $sql_ary['menu_thumbnail'] = $picture_name;
	}
*/
	if ( $error )
	{
	    die($error_msg);
	}
      
	$sql = 'INSERT INTO ' . MENU_GROUPS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	
	//echo $sql . 'master<p>'; //exit;
	$db->sql_query($sql);
	
	$mid = $db->sql_nextid();
	
	//echo 'query result:' . $db->query_result . '<br/>last sql: ' . $db->last_query_text . '<p>$db->sql_nextid: ' . //$pid; exit;
	
    }
    
    if ($mode === 'update')
    {
	$sql = 'UPDATE ' . MENU_GROUPS_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE menu_group_id = $mid";
	    
	    //echo $sql; exit;
	
	$db->sql_query($sql);
	
    }
    
    //$lang_id	= (isset($_REQUEST['lang_id'])) ? request_var('lang_id', array(0)) : array();
    
    //GRAB LANGUAGES DATA
    $lang_data = array();
    $lang_count = 0;
    //$sql_sort = 'log_time DESC';
    $start = view_langs($lang_data, $lang_count);

    //echo '<p>'; print_r($lang_data);
    $sql_translation 	= array();
    $i = 0;
    foreach($lang_data as $row)
    {
	$lang_id = request_var('lang_' . $row['id'], '');
	$translation_id = request_var('translation_' . $row['id'], '');
	$directory_title = utf8_normalize_nfc(request_var('title_' . $row['id'], '', true));
	$directory_content = utf8_normalize_nfc(request_var('content_' . $row['id'], '', true));
	
	$sql_translation = array(
	    'menu_group_id'		=> (int) $mid,
	    'translation_title'		=> (string) $directory_title,
	    'translation_description'	=> (string) $directory_content,
	    'language_id'		=> (string) $lang_id,
	);
	
	//if ($mode === 'add')
	if ( empty($translation_id) )
	{
	    $sql = 'INSERT INTO ' . MENU_GROUP_TRANSLATIONS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_translation);
	    
	}
	
	//if ($mode === 'update')
	if ( !empty($translation_id) )
	{
	    $sql = 'UPDATE ' . MENU_GROUP_TRANSLATIONS_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_translation) .
	    " WHERE translation_id = " .$translation_id;
	}
    
	//echo '<p>lang: ' . $sql; exit;
	$db->sql_query($sql);
	
    }


    redirect($config['admin_path'] . 'fe_menu_group.' . $phpEx, $sid);
}

$detail_data = array();
$lang_data = array();
$lang_count = 0;
$keyword = 'WHERE language_enabled = 1 ';
//$sql_sort = 'log_time DESC';
$start = view_langs($lang_data, $lang_count, $keyword);

if ($mode === 'update' || $mode === 'detail')
{
    if (empty($mid))
    {
	die('Missing Menu Group ID. Cannot update Menu Groups Table.');
    }

    $label = ($mode === 'update') ? $adm_lang['update_item'] : $adm_lang['view_item'];
    
    // Grab directory data
    $sql = 'SELECT * FROM ' . MENU_GROUPS_TABLE . " WHERE menu_group_id = $mid" ;

    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
 /*   
    $data_thumbnail = !empty($data['menu_thumbnail'])? $data['menu_thumbnail'] : '0';
    $thumbnail = $tonjaw_root_path . $config['media_path'] . $config['menu_path'] . $data_thumbnail;
*/    
    $sql = 'SELECT * FROM ' . MENU_GROUP_TRANSLATIONS_TABLE . " WHERE menu_group_id = $mid";
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    //$detail = $db->sql_fetchrow($result);
    
    while ($detail = $db->sql_fetchrow($result))
    {
	$detail_data[$detail['language_id']] = array(
	    'translation_id'		=> $detail['translation_id'],
	    'translation_content'	=> $detail['translation_description'],
	    'translation_title'		=> $detail['translation_title'],
	);

    }
    
    $db->sql_freeresult($result);
}

$label = (!$label) ? $adm_lang['add_item'] : $label;

$flag_path = $tonjaw_root_path . $config['media_path'] . $config['flag_path'];

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
    //'U_ADD'			=> append_sid("{$tonjaw_admin_path}pagedetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    //'L_ADD'			=> $adm_lang['add'],
    'L_IN_STB'			=> $adm_lang['in_stb'],
    'L_IN_MOBILE'		=> $adm_lang['in_mobile'],
    'L_IN_EMPTY_ROOM'		=> $adm_lang['in_empty_room'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'L_RUNNINGTEXT_ENABLED'	=> $adm_lang['runningtext_enabled'],
    'L_ORDER'			=> $adm_lang['order'],
    'L_THUMBNAIL'		=> $adm_lang['image'],
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
	    'id'	=> $mid)
	);

	foreach ($lang_data as $row)
	{
	    //echo '<p>' . $tonjaw_root_path . $config['language_path'] . $row['id'] . ".$phpEx";
	    //$data = array();
	    $template->assign_block_vars('lang', array(
		'LANG_NAME'	=> $row['name']." (".$row['id'].")",	
		'TITLE'		=> $adm_lang['title'],
		'FLAG_FILE'	=> $flag_path . $row['flag'],
		'S_LID'		=> $row['id'],
		'S_TITLE'	=> $detail_data[$row['id']]['translation_title'],
		'CONTENT'	=> $adm_lang['content'],
		'S_CONTENT'	=> $detail_data[$row['id']]['translation_content'],
		'S_MID'		=> $detail_data[$row['id']]['translation_id'],
	    ));
	}

	$template->assign_vars(array(
	    'L_NOTICE_THUMBNAIL'	=> $adm_lang['upload_thumbnail_notice'],
	    'THUMBNAIL_FILE'		=> file_exists($thumbnail)? '1' : '0',
	    'S_THUMBNAIL_FILE'		=> $thumbnail,
	    'S_THUMBNAIL'		=> $data['menu_group_thumbnail'],
	    'S_FORM'			=> '1',
	    'L_UPLOAD'			=> $adm_lang['upload'] . ' ' . $adm_lang['image'],
	    'S_ORDER'			=> $data['menu_group_order'],
	    'L_SUBMIT'			=> $adm_lang['submit'],
	    'V_IN_STB'			=> ($data['menu_group_in_stb'])? 'checked' : '',
	    'V_IN_MOBILE'		=> ($data['menu_group_in_mobile'])? 'checked' : '',
	    'V_IN_EMPTY_ROOM'		=> ($data['menu_group_in_empty_room'])? 'checked' : '',
	    'V_ENABLED'			=> ($data['menu_group_enabled'])? 'checked' : '',
	    'V_RUNNINGTEXT_ENABLED'	=> ($data['menu_group_runningtext_enabled'])? 'checked' : '',
	    'S_FORM_TOKEN'		=> $s_hidden_fields,
	    
	));
	
	break;
	
    case 'detail':
    
	foreach ($lang_data as $row)
	{
	    //echo '<p>' . $tonjaw_root_path . $config['language_path'] . $row['id'] . ".$phpEx";
	    //$data = array();
	    $template->assign_block_vars('lang', array(
		'LANG_NAME'	=> $row['name']." (".$row['id'].")",	
		'FLAG_FILE'	=> $flag_path . $row['flag'],
		'TITLE'		=> $detail_data[$row['id']]['translation_title'],
		'CONTENT'	=> prepare_message($detail_data[$row['id']]['translation_content']),
	    ));
	}
	
	$template->assign_vars(array(
	    'THUMBNAIL_FILE'	=> file_exists($thumbnail)? '1' : '0',
	    'S_THUMBNAIL_FILE'	=> $thumbnail,
	    'S_DETAIL'		=> '1',
	    'S_ORDER'		=> $data['menu_group_order'],
	    'S_IN_STB'		=> ($data['menu_group_in_stb'])? $adm_lang['yes'] : $adm_lang['no'],
	    'S_IN_MOBILE'	=> ($data['menu_group_in_mobile'])? $adm_lang['yes'] : $adm_lang['no'],
	    'S_IN_EMPTY_ROOM'	=> ($data['menu_group_in_empty_room'])? $adm_lang['yes'] : $adm_lang['no'],
	    'S_ENABLED'		=> ($data['menu_group_enabled'])? $adm_lang['yes'] : $adm_lang['no'],
	    'L_EDIT'		=> $adm_lang['update'],
	    'U_EDIT'		=> append_sid("{$tonjaw_admin_path}fe_menu_groupdetail.$phpEx", "mode=update") . '&amp;id=' .$mid . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
	));
	
	break;
	
}


$template->set_filenames(array(
	'body' => 'admin_menu_groupform.tpl',
));

page_footer();

?>