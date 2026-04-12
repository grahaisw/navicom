<?php
/**
*
* admin/nodedetail.php
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

$parent 	= request_var('parent', '');
$mode		= request_var('mode', '');
$sid 		= request_var('sid', '');
$modules	= request_var('module', '');
$nid		= request_var('id', '');

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

//$flag_file 	= '0';
$error = '';
$error_msg = '';
$u_action = $tonjaw_admin_path . 'nodedetail.' . $phpEx .'?sid=' . $sid;
 
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    $node_name = utf8_normalize_nfc(request_var('name', ''));
    $node_mac = utf8_normalize_nfc(request_var('mac', ''));
    $node_ip = utf8_normalize_nfc(request_var('ip', ''));
    $node_description = utf8_normalize_nfc(request_var('description', ''));
    $node_url = utf8_normalize_nfc(request_var('url', ''));
    //$node_lang = utf8_normalize_nfc(request_var('lid', ''));
    $node_enabled = request_var('enabled_flag', '');
    $node_enabled = $node_enabled == 'on' ? '1' : '0' ;
    $tv_channel_id = request_var('tv_channel_id', '');
    
    $sql_ary = array(
	'node_mac'		=> (string) $node_mac,
	'node_name'		=> (string) $node_name,
	'node_url'		=> (string) $node_url,
	'node_description'	=> (string) $node_description,
	'node_ip'		=> (string) $node_ip,
	'node_enabled'		=> (int) $node_enabled,
	'node_lang_id'		=> 'en',
    'node_last_channel'     => (int) $tv_channel_id,
    );
    
    //echo "$node_enabled::" ; print_r($sql_ary); exit;
    
    //$parent_parameter = $sid . '&amp;id=' . $row['id'] . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,;
}

if ($mode === 'add' && isset($_POST['submit']))
{
    
    $sql = 'INSERT INTO ' . NODES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);

    $db->sql_query($sql);
    
    redirect($config['admin_path'] . 'node.' . $phpEx, $sid);
    //echo $sql; exit;
}

if ($mode === 'update')
{
    $data = array();
    
    if (empty($nid))
    {
	die('Missing Node ID. Cannot update Nodes Table.');
    }
    
    $label = ($mode === 'update') ? $adm_lang['update_item'] : $adm_lang['view_item'];

    if (isset($_POST['submit']))
    {
      
	$sql = 'UPDATE ' . NODES_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE node_id = " .  (int) $nid;
	
	$db->sql_query($sql);
	
	redirect($config['admin_path'] . 'node.' . $phpEx, $sid);
	//echo $sql; exit;
    }
    else
    {
	// Get node data for updating
	$sql = 'SELECT * FROM ' . NODES_TABLE . " WHERE node_id=" . (int) $nid;
    
	//echo $sql; exit;
	$result = $db->sql_query($sql);
	$data = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	$last_channel_id = (!empty($data['node_last_channel'])) ? $data['node_last_channel'] : $config['tv_channel_id_on_home'];
    }
    
}

$s_hidden_fields = build_hidden_fields(array(
    'parent'	=> $parent,
    'mode'	=> $mode,
    'sid'	=> $sid,
    'module'	=> $modules,
    'id'	=> $nid)
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
    'U_ACTION'			=> $u_action,
    //'L_TITLE'			=> $adm_lang['users_online'] . $config['session_length']/3600 . ' hour',
    'S_ADD_UPDATE'		=> $module->user_priviledge[1],
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}nodedetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '0',
    'L_LANG'		=> $adm_lang['lang'],
    'L_MAC'		=> $adm_lang['mac'],
    'S_MAC'		=> $data['node_mac'],
    'L_IP'		=> $adm_lang['ip'],
    'S_IP'		=> $data['node_ip'],
    'L_NAME'		=> $adm_lang['node_name'],
    'S_NAME'		=> $data['node_name'],
    'L_DESCRIPTION'	=> $adm_lang['description'],
    'S_DESCRIPTION'	=> $data['node_description'],
    'L_URL'		=> $adm_lang['custom_url'],
    'S_URL'		=> $data['node_url'],
    'L_ENABLED'		=> $adm_lang['enabled'],
    'L_SUBMIT'		=> $adm_lang['submit'],
    'S_ENABLED'		=> ($data['node_enabled'])? 'checked' : '',
    'S_FORM_TOKEN'	=> $s_hidden_fields,
    'L_LABEL'			=> $label,
    'L_CHANNEL' => $adm_lang['last_channel'],
        'S_CHANNEL' => generate_channel_combo('tv_channel_id', $last_channel_id),
        'S_URL_SERVER'  => $config['server_name'].$config['script_path'],
 ));
// echo "string";exit();

$template->set_filenames(array(
	'body' => 'admin_nodeform.tpl',
));

page_footer();

?>
