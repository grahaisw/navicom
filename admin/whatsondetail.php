<?php
/**
*
* admin/whatsondetail.php
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
$did		= request_var('id', '');

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

$u_action = $tonjaw_admin_path . 'whatsondetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    // Preparing UPDATE PAGE TABLE
    $clip = utf8_normalize_nfc(request_var('clip', ''));
    $clip_enabled = request_var('clip_enabled', '');
    //$filename = explode('.', substr(strrchr(__FILE__, '/'), 1));
    //$upload_thumbnail = utf8_normalize_nfc(request_var('upload_thumbnail', ''));
    $image = utf8_normalize_nfc(request_var('image', ''));
    $image_enabled = request_var('thumbnail_enabled', '');
    $order = request_var('order', '');
    $enabled_flag = request_var('enabled_flag', '');
    
    $image_enabled = $image_enabled == 'on' ? '1' : '0' ;
    $clip_enabled = $clip_enabled == 'on' ? '1' : '0' ;
    $enabled_flag = $enabled_flag == 'on' ? '1' : '0' ;
    
    $sql_ary = array(
	'whatson_image'		=> $image,
	'whatson_image_enabled'	=> (int) $image_enabled,
	'whatson_clip'		=> $clip,
	'whatson_clip_enabled'	=> (int) $clip_enabled,
	'whatson_order'		=> (int) ($order)? $order : '1',
	'whatson_enabled'		=> (int) $enabled_flag,
    );
    
    if ($mode === 'add')
    {
	$error = '';
	$error_msg = '';
	
	$sql = 'INSERT INTO ' . WHATSON_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	
	//echo $sql . 'master<p>'; //exit;
	$db->sql_query($sql);
	
	$did = $db->sql_nextid();
	
	//echo 'query result:' . $db->query_result . '<br/>last sql: ' . $db->last_query_text . '<p>$db->sql_nextid: ' . //$pid; exit;
	
    }
    
    if ($mode === 'update')
    {
	$sql = 'UPDATE ' . WHATSON_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE whatson_id = $did";
	
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
	$whatson_title = utf8_normalize_nfc(request_var('title_' . $row['id'], '', true));
	$whatson_content = utf8_normalize_nfc(request_var('content_' . $row['id'], '', true));
	
	$sql_translation = array(
	    'whatson_id'		=> (int) $did,
	    'translation_title'		=> (string) $whatson_title,
	    'translation_description'	=> (string) $whatson_content,
	    'language_id'		=> (string) $lang_id,
	);
	
	//if ($mode === 'add' || empty($translation_id) )
	if ( empty($translation_id) )
	{
	    $sql = 'INSERT INTO ' . WHATSON_TRANSLATIONS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_translation);
	    
	}
	
	//if ($mode === 'update' && !empty($translation_id) )
	if ( !empty($translation_id) )
	{
	    $sql = 'UPDATE ' . WHATSON_TRANSLATIONS_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_translation) .
	    " WHERE translation_id = " .$translation_id;
	}
    
	//echo '<p>lang: ' . $sql; exit;
	$db->sql_query($sql);
	
    }
    //exit;
    redirect($config['admin_path'] . 'whatson.' . $phpEx, $sid);
}

$detail_data = array();
$lang_data = array();
$lang_count = 0;
$keyword = 'WHERE language_enabled = 1 ';
//$sql_sort = 'log_time DESC';
$start = view_langs($lang_data, $lang_count, $keyword);

if ($mode === 'update' || $mode === 'detail')
{
    if (empty($did))
    {
	die('Missing Directory ID. Cannot update Directories Table.');
    }
    // Grab directory data
    $sql = 'SELECT * FROM ' . WHATSON_TABLE . " WHERE whatson_id = $did" ;

    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    
    $data_thumbnail = ($data['directory_image'])? $data['directory_image'] : '0';
    $data_clip = ($data['directory_clip'])? $data['directory_clip'] : '0';
    $thumbnail = $tonjaw_root_path . $config['media_path'] . $config['whatson_image_path'] . $data_thumbnail;
    $clip =  $tonjaw_root_path . $config['media_path'] . $config['clip_path'] . $data_clip;

    $label = ($mode === 'update') ? $adm_lang['update_item'] : $adm_lang['view_item'];
      
    $sql = 'SELECT * FROM ' . WHATSON_TRANSLATIONS_TABLE . " WHERE whatson_id = $did";
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
    //print_r($detail_data); exit;
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
    'S_HTMLBOX'			=> '0',
    'S_JQUERY_TE'		=> '0',
    //'L_TITLE'			=> $adm_lang['users_online'] . $config['session_length']/3600 . ' hour',
    'S_ADD_UPDATE'		=> $module->user_priviledge[1],
    'S_DELETE'			=> $module->user_priviledge[2],
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}whatsondetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'L_THUMBNAIL_ENABLED'	=> $adm_lang['image_only'],
    'L_CLIP_ENABLED'		=> $adm_lang['clip_only'],
    'L_ORDER'			=> $adm_lang['order'],
    'L_CLIP_FILE'		=> $adm_lang['clip'],
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
	    'id'	=> $did)
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
		'S_DID'		=> $detail_data[$row['id']]['translation_id'],
	    ));
	}

	$template->assign_vars(array(
	    'L_NOTICE_THUMBNAIL'	=> $adm_lang['upload_thumbnail_notice'],
	    'THUMBNAIL_FILE'		=> file_exists($thumbnail)? '1' : '0',
	    'S_THUMBNAIL_FILE'		=> $thumbnail . '.jpg',
	    'S_THUMBNAIL'		=> $data['whatson_image'],
	    'CLIP_FILE'			=> file_exists($clip)? '1' : '0',
	    'S_CLIP_FILE'		=> $clip,
	    'S_CLIP'			=> $data['whatson_clip'],
	    'S_FORM'			=> '1',
	    'L_UPLOAD'			=> $adm_lang['upload'] . ' ' . $adm_lang['image'],
	    'V_CLIP_ENABLED'		=> ($data['whatson_clip_enabled'])? 'checked' : '',
	    'V_THUMBNAIL_ENABLED'	=> ($data['whatson_image_enabled'])? 'checked' : '',
	    'S_ORDER'			=> $data['whatson_order'],
	    'L_SUBMIT'			=> $adm_lang['submit'],
	    'V_ENABLED'			=> ($data['whatson_enabled'])? 'checked' : '',
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
	    'S_THUMBNAIL_FILE'	=> $thumbnail . '.jpg',
	    'CLIP_FILE'		=> file_exists($clip)? '1' : '0',
	    'S_CLIP_FILE'	=> $clip,
	    'S_DETAIL'		=> '1',
	    'S_ORDER'		=> $data['whatson_order'],
	    'S_CLIP_ENABLED'	=> ($data['whatson_clip_enabled'])? $adm_lang['yes'] : $adm_lang['no'],
	    'S_IMAGE_ENABLED'	=> ($data['whatson_image_enabled'])? $adm_lang['yes'] : $adm_lang['no'],
	    'S_ENABLED'		=> ($data['whatson_enabled'])? $adm_lang['yes'] : $adm_lang['no'],
	    'L_EDIT'		=> $adm_lang['update'],
	    'U_EDIT'		=> append_sid("{$tonjaw_admin_path}whatsondetail.$phpEx", "mode=update") . '&amp;id=' .$did . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
	));
	
	break;
	
}


$template->set_filenames(array(
	'body' => 'admin_whatsonform.tpl',
));

page_footer();

?>