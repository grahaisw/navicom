<?php
/**
*
* admin/signage/signage_masterdetail.php
*
* Agnes Emanuella. Jul 2014
*/

/**
*/

define('IN_TONJAW', true);
define('IN_ADMIN', true);
define('NEED_SID', true);

$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './../../';
$phpEx = substr(strrchr( $_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr( $_SERVER['PHP_SELF'], '/'), 1));

// Include files
require($tonjaw_root_path . 'common.' . $phpEx);
$tonjaw_admin_path = $tonjaw_root_path . $config['admin_path'];
require($tonjaw_admin_path . 'common_adm.' . $phpEx);
$tonjaw_admin_signage_path = $tonjaw_root_path . $config['signage_path'];

$parent 	= request_var('parent', '');
$mode		= request_var('mode', '');
$sid 		= request_var('sid', '');
$modules	= request_var('module', '');
$nextid		= request_var('id', '');

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

$u_action = $tonjaw_admin_signage_path . 'signage_masterdetail.' . $phpEx .'?sid=' . $sid;
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
    $template_id = request_var('template_id', '');
    $zone_id = array();
    $zone_id = (isset($_REQUEST['zone_id'])) ? request_var('zone_id', array('0')) : array();
    $room_id = array();
    $room_id = (isset($_REQUEST['room_id'])) ? request_var('room_id', array('0')) : array();
    $enabled_flag = request_var('enabled_flag', '');
    $enabled_flag = $enabled_flag == 'on' ? '1' : '0' ;
    
    //print_r($room_id); exit;
    $sql_ary = array(
	    'signage_name'		=> $name,
	    'signage_description'	=> $description,
	    'signage_enabled'		=> (int) $enabled_flag,
	    'template_id'		=> $template_id,
    );
    
    if ($mode === 'add')
    {
        $sql = 'INSERT INTO ' . SIGNAGES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
        
        //echo $sql . 'master<p>'; //exit;
        $db->sql_query($sql);
        $nextid = $db->sql_nextid();
        
    }
    
    if ($mode === 'update')
    {
        $sql = 'UPDATE ' . SIGNAGES_TABLE . ' SET ' . 
            $db->sql_build_array('UPDATE', $sql_ary) .
            " WHERE signage_id = $nextid";
        //echo $sql; exit;
        $db->sql_query($sql);
        
        // Remove old data from signage_zone_groupings table
        $sql = 'DELETE FROM ' . SIGNAGE_ZONE_GROUPINGS_TABLE . "
            WHERE signage_id = $nextid";
        $db->sql_query($sql);
        
        // Remove old data from signage_room_groupings table
        $sql = 'DELETE FROM ' . SIGNAGE_ROOM_GROUPINGS_TABLE . "
            WHERE signage_id = $nextid";
        $db->sql_query($sql);
        
    }

    //Insert new data to signage_zone_groupings table
    $i = 0;
    while ( $i < sizeof($zone_id) )
    {
        $sql_ary = array(
            'signage_id'    => $nextid,
            'zone_id'		=> $zone_id[$i],
        );
        
        $sql = 'INSERT INTO ' . SIGNAGE_ZONE_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
        //echo $sql; exit;
        $db->sql_query($sql);
    
        $i++;
    }
    
    //Insert new data to signage_room_groupings table
    $j = 0;
    while ( $j < sizeof($room_id) )
    {
        $sql_ary = array(
            'signage_id'    => $nextid,
            'room_id'		=> $room_id[$j],
        );
        
        $sql = 'INSERT INTO ' . SIGNAGE_ROOM_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
        //echo $sql; exit;
        $db->sql_query($sql);
    
        $j++;
    }
        
    redirect($config['signage_path'] . 'signage_master.' . $phpEx, $sid);
}

if ($mode === 'update')
{
    if (empty($nextid))
    {
	die('Missing Room ID. Cannot update Room Table.');
    }

    // Get room data for updating
    $sql = 'SELECT * FROM ' . SIGNAGES_TABLE . " WHERE signage_id=" . (int) $nextid;
    
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    
    $template_id = $data['template_id'];
/*    
    $sql = 'SELECT node_name FROM ' . NODES_TABLE . " WHERE node_room_id=" . (int) $nextid;
    
    $result = $db->sql_query($sql);
    $node_data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
*/
}

//$foreign_id = (!empty($nextid))? $nextid : 0;
//$zone_id = (!empty($zid))? $zid : 0;

$s_hidden_fields = build_hidden_fields(array(
    'parent'	=> $parent,
    'mode'	=> $mode,
    'sid'	=> $sid,
    'module'	=> $modules,
    'id'	=> $nextid)
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
    'U_ADD'			=> append_sid("{$tonjaw_admin_signage_path}signage_masterdetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '0',
    'L_NAME'			=> $adm_lang['name'],
    'L_DESCRIPTION'		=> $adm_lang['description'],
    'L_ZONE'			=> $adm_lang['zone'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'S_NAME'			=> $data['signage_name'],
    'S_DESCRIPTION'		=> $data['signage_description'],
    'S_TEMPLATE'		=> generate_template('template_id', $data['template_id']),
    'S_ZONE'			=> generate_zone_multiple('zone_id[]', $nextid, SIGNAGE_ZONE_GROUPINGS_TABLE, 'signage_id'),
    'S_ROOMS'			=> generate_room('room_id[]', $nextid, SIGNAGE_ROOM_GROUPINGS_TABLE, 'signage_id'),
    'S_ENABLED'			=> ($data['signage_enabled'])? 'checked' : '',
    'S_FORM_TOKEN'		=> $s_hidden_fields,
    'L_SUBMIT'			=> $adm_lang['submit'],
    'L_TEMPLATE'		=> $adm_lang['template'],
    'L_ROOMS'		    => $adm_lang['room'],
));

$template->set_filenames(array(
	'body' => 'admin_signage_masterform.tpl',
));

page_footer();


?>