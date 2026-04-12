<?php
/**
*
* admin/signage/signage_gatedetail.php
*
* Agnes Emanuella. Oct 2014
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

$u_action = $tonjaw_admin_signage_path . 'signage_gatedetail.' . $phpEx .'?sid=' . $sid;
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
    $enabled_flag = request_var('enabled_flag', '');
    $enabled_flag = $enabled_flag == 'on' ? '1' : '0' ;
    
    //print_r($room_id); exit;
    $sql_ary = array(
	    'target_gate_name'		    => $name,
	    'target_gate_description'	=> $description,
	    'target_gate_enabled'		=> (int) $enabled_flag,
    );
    
    if ($mode === 'add')
    {
        $sql = 'INSERT INTO ' . TARGET_GATES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
        
        //echo $sql . 'master<p>'; //exit;
        $db->sql_query($sql);
        $nextid = $db->sql_nextid();
        
    }
    
    if ($mode === 'update')
    {
        $sql = 'UPDATE ' . TARGET_GATES_TABLE . ' SET ' . 
            $db->sql_build_array('UPDATE', $sql_ary) .
            " WHERE target_gate_id = $nextid";
        //echo $sql; exit;
        $db->sql_query($sql);
        
    }
    
    redirect($config['signage_path'] . 'signage_gate.' . $phpEx, $sid);
}

if ($mode === 'update' || $mode === 'detail')
{
    if (empty($nextid))
    {
	die('Missing Room ID. Cannot update Room Table.');
    }

    // Get room data for updating
    $sql = 'SELECT * FROM ' . TARGET_GATES_TABLE . " WHERE target_gate_id=" . (int) $nextid;
    
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

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
    'U_ADD'			=> append_sid("{$tonjaw_admin_signage_path}signage_gatedetail.$phpEx", "mode=add") . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '0',
    'L_NAME'			=> $adm_lang['name'],
    'L_DESCRIPTION'		=> $adm_lang['description'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'L_PREVIEW'         => $adm_lang['preview'],
    'S_FORM_TOKEN'		=> $s_hidden_fields,
    'L_SUBMIT'			=> $adm_lang['submit'],
));

switch($mode) {
    case 'update' :
    case 'add':
        $s_hidden_fields = build_hidden_fields(array(
            'parent'	=> $parent,
            'mode'	=> $mode,
            'sid'	=> $sid,
            'module'	=> $modules,
            'id'	=> $nextid)
        );
        
        $template->assign_vars(array(
            'S_FORM'		=> '1',
            'S_NAME'	    => $data['target_gate_name'],
            'S_DESCRIPTION'	=> $data['target_gate_description'],
            'S_ENABLED'		=> ($data['target_gate_enabled'])? 'checked' : '',
            'S_FORM_TOKEN'	=> $s_hidden_fields,
        ));
        break;
        
    case 'detail' :
    
        $template->assign_vars(array(
            'S_DETAIL'		=> '1',
            'S_NAME'	    => $data['target_gate_name'],
            'S_DESCRIPTION'	=> $data['target_gate_description'],
            'S_ENABLED'		=> ($data['target_gate_enabled'])? 'Yes' : 'No',
        ));
        break;
    
}

$template->set_filenames(array(
	'body' => 'admin_signage_gateform.tpl',
));

page_footer();


?>