<?php
/**
*
* admin/userdetail.php
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
$uid		= request_var('id', '');
$flag_file 	= '0';
$error = '';
$error_msg = '';

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

$u_action = $tonjaw_admin_path . 'userdetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    $username = utf8_normalize_nfc(request_var('name', ''));
    $fullname = utf8_normalize_nfc(request_var('fullname', ''));
    $password = utf8_normalize_nfc(request_var('password', ''));
    $confirm = utf8_normalize_nfc(request_var('confirm', ''));
    $description = utf8_normalize_nfc(request_var('description', ''));
    $lang_id = request_var('lang_id', '');
    $group_id = request_var('group_id', '');
    $enabled = request_var('enabled_flag', '');
    
    $enabled = $enabled == 'on' ? '1' : '0';
    
    $sql_ary = array(
	'user_name'		=> (string) $username,
	'user_fullname'		=> (string) $fullname,
	'user_description'	=> (string) $description,
	'language_id'		=> (string) $lang_id,
	'user_group_id'		=> (int) $group_id,
	'user_enabled'		=> (int) $enabled,
    );
    
    if (empty(trim($username)))
    {
	$error = true;
	$error_msg = ($error_msg) ? $error_msg . '<br />' . $adm_lang['Error_empty_username'] : $adm_lang['Error_empty_username'];
    }
    
    if (!empty(trim($password)) && $password !== $confirm)
    {
	//die($adm_lang['Error_confirm_password']);
	$error = true;
	$error_msg = ($error_msg) ? $error_msg . '<br />' . $adm_lang['Error_confirm_password'] : $adm_lang['Error_confirm_password'];
    }
    elseif(!empty(trim($password)) && $password === $confirm)
    {
	$sql_ary['user_password'] = (string) md5($password);

    }
    
    if(empty(trim($lang_id)) || empty(trim($group_id)))
    {
	$error = true;
	$error_msg = ($error_msg) ? $error_msg . '<br />' . $adm_lang['Error_empty_lang_group'] : $adm_lang['Error_empty_lang_group'];
    }
    //$parent_parameter = $sid . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,;
}

if ($mode === 'add' && isset($_POST['submit']))
{
    // Validate
    $sql = 'SELECT user_id FROM ' . USERS_TABLE . " WHERE user_name ='$username'";
    $result = $db->sql_query($sql);
    $user_exist = $db->sql_fetchfield('user_id');
    $db->sql_freeresult($result);

    if(!empty($user_exist))
    {
	//die($adm_lang['Error_user_exist']);
	$error = true;
	$error_msg = ($error_msg) ? $error_msg . '<br />' . $adm_lang['Error_user_exist'] : $adm_lang['Error_user_exist'];
    }
    
    if (!$error)
    {
	// Add new record
	$sql = 'INSERT INTO ' . USERS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	$db->sql_query($sql);
    
	redirect($config['admin_path'] . 'user.' . $phpEx, $sid);
    
    }
    else
    {
	die($error_msg);
    }
    //echo $sql; exit;
}


if ($mode === 'update' || $mode === 'detail')
{
    $data = array();
    
    if (empty($uid))
    {
	
	$error = true;
	$error_msg = ($error_msg) ? $error_msg . '<br />' . $adm_lang['Error_missing_id'] : $adm_lang['Error_missing_id'];
    }
    
    $label = ($mode === 'update') ? $adm_lang['update_item'] : $adm_lang['view_item'];

    if (isset($_POST['submit']))
    {
	if (!$error)
	{
	    $sql = 'UPDATE ' . USERS_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE user_id = " .  (int) $uid;
	    //echo $sql; exit;
	    $db->sql_query($sql);
	
	    redirect($config['admin_path'] . 'user.' . $phpEx, $sid);
	}
	else
	{
	    die($error_msg);
	}
	//
    }
    else
    {
	// Get user data for updating
	//$sql = 'SELECT * FROM ' . USER_GROUPS_TABLE . " WHERE u.user_group_id=g.user_group_id" . (int) $gid;
	$sql = "SELECT u.*, g.user_group_name, g.user_group_id 
		FROM " . USERS_TABLE . " u, " . USER_GROUPS_TABLE . " g 
		WHERE u.user_group_id = g.user_group_id AND u.user_id = $uid";
    
	///echo $sql; exit;
	$result = $db->sql_query($sql);
	$data = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
    }
  
}

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
    'L_USERNAME'		=> $adm_lang['username'],
    'L_FULLNAME'	=> $adm_lang['fullname'],
    'L_DESCRIPTION'	=> $adm_lang['description'],
    'L_ENABLED'		=> $adm_lang['enabled'],
    'L_LANGUAGE'	=> $adm_lang['lang'],
    'L_GROUPNAME'	=> $adm_lang['group_name'],
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
	    'id'	=> $uid)
	);

	$template->assign_vars(array(
	    'S_FORM'		=> '1',
	    'U_ACTION'		=> $u_action,
	    'L_COMPOSE'		=> ($mode === 'add')?$adm_lang['add'] : $adm_lang['edit'],
	    'S_NAME'		=> $data['user_name'],
	    'S_FULLNAME'	=> $data['user_fullname'],
	    'L_PASSWORD'	=> $adm_lang['password'],
	    'S_PASSWORD'	=> '',
	    'L_CONFIRM'		=> $adm_lang['confirm_password'],
	    'S_CONFIRM'		=> '',
	    'S_DESCRIPTION'	=> $data['user_description'],
	    'S_LANGUAGE'	=> generate_lang('lang_id', $data['language_id']),
	    'S_GROUPNAME'	=> generate_group('group_id', $data['user_group_id']),
	    'L_ENABLED'		=> $adm_lang['enabled'],
	    'L_SUBMIT'		=> $adm_lang['submit'],
	    'V_ENABLED'		=> ($data['user_enabled'])? 'checked' : '',
	    'S_FORM_TOKEN'	=> $s_hidden_fields,
	));

	break;
	
    case 'detail':
	$template->assign_vars(array(
	    'S_DETAIL'		=> '1',
	    'L_COMPOSE'		=> $adm_lang['view'],
	    'S_FULLNAME'	=> $data['user_fullname'],
	    'S_USERNAME'	=> $data['user_name'],
	    'S_GROUPNAME'	=> $data['user_group_name'],
	    'L_LASTVISIT'	=> $adm_lang['last_activity'],
	    'S_LASTVISIT'	=> ($data['user_lastvisit']) ? date($config['default_dateformat'], $data['user_lastvisit']) : '' ,
	    'S_DESCRIPTION'	=> $data['user_description'],
	    'S_ENABLED'		=> ($data['user_enabled'])? 'True' : 'False',
	    'S_LANGUAGE'	=> $data['language_id'],
	    'L_EDIT'		=> $adm_lang['update'],
	    'U_EDIT'		=> append_sid("{$tonjaw_admin_path}userdetail.$phpEx", "mode=update") . '&amp;id=' .$uid . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
	));
	
	break;

    default:
	$error = true;
	$error_msg = ($error_msg) ? $error_msg . '<br />' . $adm_lang['Error_ilegal_mode'] : $adm_lang['Error_ilegal_mode'];
	
	break;
} 
 
 
 
$template->set_filenames(array(
	'body' => 'admin_userform.tpl',
));

page_footer();

?>