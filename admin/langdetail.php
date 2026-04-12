<?php
/**
*
* admin/langdetail.php
*
* Roberto Tonjaw. Jan 2014
*/

/**
*/
define('IN_TONJAW', true);
define('IN_ADMIN', true);
define('NEED_SID', true);

//echo 'langdetail crottt'; exit;
$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './../';
$phpEx = substr(strrchr( $_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr( $_SERVER['PHP_SELF'], '/'), 1));

// Include files
require($tonjaw_root_path . 'common.' . $phpEx);
$tonjaw_admin_path = $tonjaw_root_path . $config['admin_path'];
require($tonjaw_admin_path . 'common_adm.' . $phpEx);

$template->set_template();

$parent 	= request_var('parent', '');
$mode		= request_var('mode', '');
$sid 		= request_var('sid', '');
$modules	= request_var('module', '');
$lid		= request_var('id', '');
$flag_file 	= '0';

//echo $parent; exit;
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

 
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    $lang_name = utf8_normalize_nfc(request_var('name', ''));
    $lang_id = utf8_normalize_nfc(request_var('lid', ''));
    //$lang_flag = utf8_normalize_nfc(request_var('flag', ''));
    $lang_disabled = request_var('enabled_flag', '');
    //$filename = explode('.', substr(strrchr(__FILE__, '/'), 1));
    $lang_disabled = $lang_disabled == 'on' ? '1' : '0';
    
    $sql_ary = array(
	'language_id'		=> (string) $lang_id,
	'language_name'		=> (string) $lang_name,
	//'language_flag'		=> (string) $lang_flag,
	'language_enabled'	=> (int) $lang_disabled,
    );

    // Preparing upload flag file
    $path = $tonjaw_root_path . $config['media_path'] . $config['flag_path'];
    $can_upload = (file_exists($tonjaw_root_path . $config['media_path'] . $config['flag_path']) && tonjaw_is_writable($path) && (@ini_get('file_uploads') || strtolower(@ini_get('file_uploads')) == 'on')) ? true : false;
    
    //$parent_parameter = $sid . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,;
}

if ($mode === 'add' && isset($_POST['submit']))
{
    // Check Lang Id
    $sql = 'SELECT language_id FROM ' . LANGUAGES_TABLE . " WHERE language_id='" . (string) $lang_id . "'";
    
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    
    if(!empty($data['language_id']))
    {
	die('language id already exist');
    }
    else
    {
	$error = '';
	$error_msg = '';
	    
	if ((!empty($_FILES['uploadfile']['name'])) && $can_upload)
	{
	    //echo 'siap upload'; exit;
	    require_once($tonjaw_root_path . $config['include_path'] . 'functions_image.' . $phpEx);

	    $filetype = explode('.', $_FILES['uploadfile']['name']);
	    $newfilename = $lang_id . '.' . $filetype[1];
	    
	    $picture_name = upload_image($error, $error_msg, $newfilename, $_FILES['uploadfile']['tmp_name'], $_FILES['uploadfile']['size'], $_FILES['uploadfile']['type'], $path, 'flag');
	    //list($sql_ary['user_avatar_type'], $sql_ary['language_flag'], $sql_ary['user_avatar_width'], $sql_ary['user_avatar_height']) = image_upload('flag', $lang_id, $error);
	}
	else
	{
	    die('file kosong atau ga bs nulis');
	}

	if ( $error )
	{
	    die($error_msg);
	}
	
	$sql_ary['language_flag'] = $picture_name;
		
	$sql = 'INSERT INTO ' . LANGUAGES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	//echo $sql; exit;
	$db->sql_query($sql);
	
	redirect($config['admin_path'] . 'lang.' . $phpEx, $sid);
    }
    
/*
    
*/    
    
    //echo $sql; exit;
}

if ($mode === 'update')
{
    $data = array();
    $code_disabled = 'disabled';
    
    if (empty($lid))
    {
	die('Missing Language ID. Cannot update Languages Table.');
    }
    
    $label = ($mode === 'update') ? $adm_lang['update_item'] : $adm_lang['view_item'];

    if (isset($_POST['submit']))
    {
	$error = '';
	$error_msg = '';
	    
	if (!empty($_FILES['uploadfile']['name']))
	{
	    
	
	    if ( $can_upload )
	    {
		//echo 'siap upload'; exit;
		require_once($tonjaw_root_path . $config['include_path'] . 'functions_image.' . $phpEx);

		// Delete the previous pic
		$oldflag = request_var('oldflag', '');
		
		delete_image($oldflag, $path);
			
		$filetype = explode('.', $_FILES['uploadfile']['name']);
		$newfilename = $lang_id . '.' . $filetype[1];
	    
		$picture_name = upload_image($error, $error_msg, $newfilename, $_FILES['uploadfile']['tmp_name'], $_FILES['uploadfile']['size'], $_FILES['uploadfile']['type'], $path, 'flag');

		$sql_ary['language_flag'] = $picture_name;
	    }
	    else
	    {
		//die('Cannot delete n upload file');
		$error = true;
		$error_msg = ($error_msg) ? $error_msg . '<br />' . $adm_lang['Error_upload'] : $adm_lang['Error_upload'];
	    }
	
	
	}
	
	if ( $error )
	{
	    die($error_msg);
	}

	//echo $sql; exit;
	$sql = 'UPDATE ' . LANGUAGES_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE language_id = '" .  (string) $lid . "'";
	
	$db->sql_query($sql);
	//echo $sql; exit;
	redirect($config['admin_path'] . 'lang.' . $phpEx, $sid);

    }
    else
    {
	// Get node data for updating
	$sql = 'SELECT * FROM ' . LANGUAGES_TABLE . " WHERE language_id='" . (string) $lid . "'";
    
	//echo $sql; exit;
	$result = $db->sql_query($sql);
	$data = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	
	$flag_file = $tonjaw_root_path . $config['media_path'] . $config['flag_path'] . $data['language_flag'];
	
    }
    
}

$s_hidden_fields = build_hidden_fields(array(
    'parent'	=> $parent,
    'mode'	=> $mode,
    'sid'	=> $sid,
    'module'	=> $modules,
    'id'	=> $lid,
    'oldflag'	=> $data['language_flag'])
);

$label = (!$label) ? $adm_lang['add_item'] : $label;
adm_page_header($module->active_module_name);

$template->assign_vars(array(
    'HIDE_DISPLAY_SIDE_MENU'	=> $adm_lang['hide_display_side_menu'],
    //'T_LOG_JS_PATH'		=> $tonjaw_root_path . $config['js_path'] . 'log.js',
    'LOGIN_AS'			=> $adm_lang['login_as'],
    'USERNAME'			=> $session->username,
    'U_LOGOUT'			=> append_sid("{$tonjaw_admin_path}index.$phpEx") . '&amp;mode=logout',
    'L_LOGOUT'			=> $adm_lang['logout'],
    'MODULE_TITLE'		=> $module->active_module_name,
    'MODULE_DESC' 		=> $module->active_module_desc,
    'U_ACTION'		=> append_sid("{$tonjaw_admin_path}langdetail.$phpEx"),
    'L_COMPOSE'		=> ($mode === 'add')?$adm_lang['add'] : $adm_lang['edit'],
    'L_ID'		=> $adm_lang['code'],
    'S_ID'		=> $data['language_id'],
    'S_DISABLED'	=> $code_disabled,
    'L_NAME'		=> $adm_lang['lang'],
    'S_NAME'		=> $data['language_name'],
    'L_FLAG'		=> $adm_lang['flag'],
    'S_FLAG'		=> $data['language_flag'],
    'FLAG_FILE'		=> $flag_file ,
    'L_NOTICE_FLAG'	=> $adm_lang['upload_flag_notice'],
    'L_UPLOAD'		=> $adm_lang['upload_flag'],
    'L_ENABLED'		=> $adm_lang['enabled'],
    'L_SUBMIT'		=> $adm_lang['submit'],
    'V_ENABLED'		=> ($data['language_enabled'])? 'checked' : '',
    'S_FORM_TOKEN'	=> $s_hidden_fields,
    'L_LABEL'			=> $label,
 ));

$template->set_filenames(array(
	'body' => 'admin_langform.tpl',
));

page_footer();


?>