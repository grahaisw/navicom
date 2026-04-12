<?php
/**
*
* admin/adsdetail.php
*
* Agnes Emanuella. Jul 2014
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
$rid		= request_var('id', '');

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
$node_data = array();

$u_action = $tonjaw_admin_path . 'adsdetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    // Preparing UPDATE ROOM TABLE
    $name = utf8_normalize_nfc(request_var('name', ''));
    $address = utf8_normalize_nfc(request_var('address', ''));
    $contact_person = utf8_normalize_nfc(request_var('contact_person', ''));
    $phone = utf8_normalize_nfc(request_var('phone', ''));
    $email = utf8_normalize_nfc(request_var('email', ''));
    $enabled_flag = request_var('enabled_flag', '');
    
    //print_r($nid); exit;
    $sql_ary = array(
	    'signage_ads_name'		=> $name,
	    'signage_ads_address'	=> $address,
        'signage_ads_cp'	=> $contact_person,
        'signage_ads_phone'	=> $phone,
        'signage_ads_email'	=> $email,
	    'signage_ads_enabled'	=> (int) (!empty($enabled_flag)? '1' : '0'),
    );
    
    if ($mode === 'add')
    {
	$sql = 'INSERT INTO ' . SIGNAGE_ADS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	
	//echo $sql . 'master<p>'; //exit;
	$db->sql_query($sql);
	$rid = $db->sql_nextid();
    }

    if ($mode === 'update')
    {
	$sql = 'UPDATE ' . SIGNAGE_ADS_TABLE . ' SET ' . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE signage_ads_id = $rid";
	$db->sql_query($sql);
	
    }
   
    redirect($config['admin_path'] . 'ads.' . $phpEx, $sid);
}

if ($mode === 'update')
{
    if (empty($rid))
    {
	die('Missing Room ID. Cannot update Room Table.');
    }

    // Get room data for updating
    $sql = 'SELECT * FROM ' . SIGNAGE_ADS_TABLE . " WHERE signage_ads_id=" . (int) $rid;
    
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
 
}

$foreign_id = (!empty($rid))? $rid : 0;
//$zone_id = (!empty($zid))? $zid : 0;

$s_hidden_fields = build_hidden_fields(array(
    'parent'	=> $parent,
    'mode'	=> $mode,
    'sid'	=> $sid,
    'module'	=> $modules,
    'id'	=> $rid)
);

//print_r($node_data); exit;

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
    'U_ACTION'			=> $u_action,
    //'L_TITLE'			=> $adm_lang['users_online'] . $config['session_length']/3600 . ' hour',
    'S_ADD_UPDATE'		=> $module->user_priviledge[1],
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}adsdetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '0',
    'L_COMPANY_NAME'	=> $adm_lang['company_name'],
    'L_ADDRESS'		    => $adm_lang['address'],
    'L_CONTACT_PERSON'	=> $adm_lang['contact_person'],
    'L_PHONE'			=> $adm_lang['phone'],
    'L_EMAIL'			=> $adm_lang['email'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'S_COMPANY_NAME'			=> $data['signage_ads_name'],
    'S_ADDRESS'		    => $data['signage_ads_address'],
    'S_CONTACT_PERSON'	=> $data['signage_ads_cp'],
    'S_PHONE'			=> $data['signage_ads_phone'],
    'S_EMAIL'			=> $data['signage_ads_email'],
    'S_ENABLED'			=> ($data['signage_ads_enabled'])? 'checked' : '',
    'S_FORM_TOKEN'		=> $s_hidden_fields,
    'L_SUBMIT'			=> $adm_lang['submit'],
));

$template->set_filenames(array(
	'body' => 'admin_adsform.tpl',
));

page_footer();


?>