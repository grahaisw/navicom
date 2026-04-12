<?php
/**
*
* admin/signage/signage_emergencydetail.php
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

$u_action = $tonjaw_admin_signage_path . 'signage_emergencydetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    // Preparing UPDATE ROOM TABLE
    $code = utf8_normalize_nfc(request_var('code', ''));
    $name = utf8_normalize_nfc(request_var('name', ''));
    
    //print_r($room_id); exit;
    $sql_ary = array(
        'emergency_code'	=> $code,
        'emergency_name'	=> $name,
    );
    
    if ($mode === 'add')
    {
        $sql = 'INSERT INTO ' . EMERGENCIES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
        
        //echo $sql . 'master<p>'; //exit;
        $db->sql_query($sql);
        $nextid = $db->sql_nextid();
        
    }
    
    if ($mode === 'update')
    {
        $sql = 'UPDATE ' . EMERGENCIES_TABLE . ' SET ' . 
            $db->sql_build_array('UPDATE', $sql_ary) .
            " WHERE emergency_id = $nextid";
        //echo $sql; exit;
        $db->sql_query($sql);
        
    }
    
    redirect($config['signage_path'] . 'signage_emergency.' . $phpEx, $sid);
}

if ($mode === 'update' || $mode === 'detail')
{
    if (empty($nextid))
    {
	die('Missing Emergency ID. Cannot update Emergencies Table.');
    }

    // Get emergency data for updating
    $sql = 'SELECT emergency_code, emergency_name FROM ' . EMERGENCIES_TABLE . " WHERE emergency_id=" . $nextid;
    
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

}


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
    'U_ADD'			    => append_sid("{$tonjaw_admin_signage_path}signage_emergencydetail.$phpEx", "mode=add") . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '0',
    'L_EMERGENCY_CODE'		=> $adm_lang['emergency_code'],
    'L_EMERGENCY_NAME'		=> $adm_lang['emergency_name'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    //'S_FORM_TOKEN'		=> $s_hidden_fields,
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
            'S_FORM'		    => '1',
            'S_EMERGENCY_CODE'	=> $data['emergency_code'],
            'S_EMERGENCY_NAME'	=> $data['emergency_name'],
            'S_FORM_TOKEN'		=> $s_hidden_fields,
        ));
        break;
        
    case 'detail' :
    
        $template->assign_vars(array(
            'S_DETAIL'		    => '1',
            'S_EMERGENCY_CODE'	=> $data['emergency_code'],
            'S_EMERGENCY_NAME'	=> $data['emergency_name'],
        ));
        break;
    
}

$template->set_filenames(array(
	'body' => 'admin_signage_emergencyform.tpl',
));

page_footer();


?>