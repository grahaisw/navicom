<?php
/**
*
* admin/airportdetail.php
*
* Roberto Tonjaw. Oct 2014
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

$parent 	= request_var('parent', '');
$mode		= request_var('mode', '');
$sid 		= request_var('sid', '');
$modules	= request_var('module', '');
$aid		= request_var('id', '');

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

$u_action = $tonjaw_admin_path . 'airportdetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    //$title = utf8_normalize_nfc(request_var('title', ''));
    //$description = utf8_normalize_nfc(request_var('description', ''));
    $enabled_flag = request_var('enabled_flag', '');
    $enabled_flag = $enabled_flag == 'on' ? '1' : '0';
    $code = utf8_normalize_nfc(request_var('code', '', true));
    $name = utf8_normalize_nfc(request_var('name', '', true));
    $description = utf8_normalize_nfc(request_var('description', '', true));
    
    if(empty($code))
    {
	$error = true;
	$error_msg = 'Airport Code field cannot be left empty.';
	
	die($error_msg);
    }
    else
    {
	$sql_ary = array(
	    //'service_group_description'	=> $description,
	    'airport_enabled'		=> (int) $enabled_flag,
	    'airport_code'		=> (string) strtoupper($code),
	    'airport_name'		=> (string) $name,
	    'airport_description'	=> (string) $description,
	);

	if ($mode === 'add')
	{
	  
	    $sql = 'INSERT INTO ' . AIRPORTS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	    
	    //echo $sql . 'master<p>'; exit;
	    $db->sql_query($sql);
	    
	}
	
	if ($mode === 'update')
	{
	    $sql = 'UPDATE ' . AIRPORTS_TABLE . " SET " . 
		$db->sql_build_array('UPDATE', $sql_ary) .
		" WHERE airport_id = $aid";
	    
	    $db->sql_query($sql);
	    
	}
    
    }
    
   
     redirect($config['admin_path'] . 'airport.' . $phpEx, $sid);
}

$detail_data = array();

if ($mode === 'update' || $mode === 'detail')
{
    if (empty($aid))
    {
	die('Missing Airport ID.');
    }
    
    $label = ($mode === 'update') ? $adm_lang['update_item'] : $adm_lang['view_item'];

    $data = array();
    
    // Get Airport data for updating
    $sql = 'SELECT * FROM ' . AIRPORTS_TABLE . " WHERE airport_id=" . (int) $aid;
    
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    //print_r($data); exit;
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
    'L_CODE'			=> $adm_lang['code'],
    'L_NAME'			=> $adm_lang['name'],
    'L_DESCRIPTION'		=> $adm_lang['description'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'L_LABEL'			=> $label,
    'S_CODE'			=> $data['airport_code'],
    'S_NAME'			=> prepare_message($data['airport_name']),
    'S_DESCRIPTION'		=> prepare_message($data['airport_description']),
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
	    'id'	=> $aid)
	);

	$template->assign_vars(array(
	    'S_FORM'		=> '1',
	    'U_ACTION'		=> $u_action,
	    'L_COMPOSE'		=> ($mode === 'add')?$adm_lang['add'] : $adm_lang['edit'],
	    'L_SUBMIT'		=> $adm_lang['submit'],
	    'V_ENABLED'		=> ($data['airport_enabled'])? 'checked' : '',
	    'S_FORM_TOKEN'	=> $s_hidden_fields,
	));

	break;
	
    case 'detail':
	$template->assign_vars(array(
	    'S_DETAIL'		=> '1',
	    'L_COMPOSE'		=> $adm_lang['view'],
	    'S_ENABLED'		=> ($data['airport_enabled'])? 'True' : 'False',
	    'L_EDIT'		=> $adm_lang['update'],
	    'U_EDIT'		=> append_sid("{$tonjaw_admin_path}airportdetail.$phpEx", "mode=update") . '&amp;id=' .$aid . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
	));
	
	break;

    default:
	$error = true;
	$error_msg = ($error_msg) ? $error_msg . '<br />' . $adm_lang['Error_ilegal_mode'] : $adm_lang['Error_ilegal_mode'];
	
	break;
} 




$template->set_filenames(array(
	'body' => 'admin_airportform.tpl',
));

page_footer();


?>