<?php
/**
*
* admin/roomdetail.php
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

$u_action = $tonjaw_admin_path . 'roomdetail.' . $phpEx .'?sid=' . $sid;
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
    $description = utf8_normalize_nfc(request_var('description', ''));
    $nid = array();
    $nid = (isset($_REQUEST['node_id'])) ? request_var('node_id', array('0')) : array();
    $enabled_flag = request_var('enabled_flag', '') == 'on' ? '1' : '0';
    $zone_id = request_var('zone_id', '');
    $zone_id = $zone_id ? $zone_id : '0';
    
    //print_r($nid); exit;
    $sql_ary = array(
	    'room_name'		=> $name,
	    'room_description'	=> $description,
	    'room_enabled'	=> (int) $enabled_flag,
	    'zone_id'		=> (int) $zone_id,
    );
    
    if ($mode === 'add')
    {
	$sql = 'INSERT INTO ' . ROOMS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	
	//echo $sql . 'master<p>'; exit;
	$db->sql_query($sql);
	$rid = $db->sql_nextid();
    }

    if ($mode === 'update')
    {
	$sql = 'UPDATE ' . ROOMS_TABLE . ' SET ' . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE room_id = $rid";
	$db->sql_query($sql);
	
	// reset the old value of node_room_id in NODE Table
	$sql_ary = array(
	    'room_id'	=> 0,
	);
	
	$sql = 'UPDATE ' . NODES_TABLE . ' SET ' . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE room_id = $rid";
	$db->sql_query($sql);;
    }
    
    //print_r($nid); echo '<br> size: ' . sizeof($nid); exit;
    
    //Update data of node table
    $i = 0;
    while ( $i < sizeof($nid) )
    {
	$sql_ary = array(
	    'room_id'	=> $rid,
	);
	    
	$sql = 'UPDATE ' . NODES_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . 
	    " WHERE node_id = " . $nid[$i];
	    //echo $sql . 'master<p>'; exit;
	$db->sql_query($sql);
	
	$i++;
    }

    redirect($config['admin_path'] . 'room.' . $phpEx, $sid);
}

if ($mode === 'update')
{
    if (empty($rid))
    {
	die('Missing Room ID. Cannot update Room Table.');
    }

    $label = ($mode === 'update') ? $adm_lang['update_item'] : $adm_lang['view_item'];
    // Get room data for updating
    $sql = 'SELECT * FROM ' . ROOMS_TABLE . " WHERE room_id=" . (int) $rid;
    
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    
    $zone_id = $data['zone_id'];
/*    
    $sql = 'SELECT node_name FROM ' . NODES_TABLE . " WHERE node_room_id=" . (int) $rid;
    
    $result = $db->sql_query($sql);
    $node_data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
*/
}

$foreign_id = ($rid)? $rid : 0;
//$zone_id = ($zid)? $zid : 0;

$s_hidden_fields = build_hidden_fields(array(
    'parent'	=> $parent,
    'mode'	=> $mode,
    'sid'	=> $sid,
    'module'	=> $modules,
    'id'	=> $rid)
);

//print_r($node_data); exit;
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
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}roomdetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '0',
    'L_NAME'			=> $adm_lang['name'],
    'L_DESCRIPTION'		=> $adm_lang['description'],
    'L_NODE'			=> $adm_lang['node'],
    'L_ZONE'			=> $adm_lang['zone'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'S_NAME'			=> $data['room_name'],
    'S_DESCRIPTION'		=> $data['room_description'],
    'S_NODE'			=> generate_node('node_id[]', $foreign_id),
    'S_ZONE'			=> generate_zone('zone_id', $zone_id),
    'S_ENABLED'			=> ($data['room_enabled'])? 'checked' : '',
    'S_FORM_TOKEN'		=> $s_hidden_fields,
    'L_SUBMIT'			=> $adm_lang['submit'],
    'L_LABEL'			=> $label,
));

$template->set_filenames(array(
	'body' => 'admin_roomform.tpl',
));

page_footer();


?>
