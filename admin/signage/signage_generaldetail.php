<?php
/**
*
* admin/signage/signage_generaldetail.php
*
* Agnes Emanuella. Nov 2014
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
$default_start	= time();
$default_end	= time();

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

$u_action = $tonjaw_admin_signage_path . 'signage_generaldetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

$region_data = array();
$region_count = 0;


// Preparing data
if (isset($_POST['submit']))
{
    // Preparing UPDATE REGION TABLE
    $title = utf8_normalize_nfc(request_var('title', ''));
    $date = strtotime(request_var('date', ''));
    $description = request_var('description', '');
    $enabled_flag = request_var('enabled_flag', '');
    $enabled_flag = $enabled_flag == 'on' ? '1' : '0' ;
    
    $sql_ary = array(
	    'signage_general_title'	    => $title,
        'signage_general_date'		=> $date,
	    'signage_general_remark'		=> $description,
        'signage_general_enabled'  => (int) $enabled_flag,
    );
    
    
    if ($mode === 'add')
    {
        $sql = 'INSERT INTO ' . SIGNAGE_GENERALS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
        
        //echo $sql; exit;
        $db->sql_query($sql);
        $nextid = $db->sql_nextid();
        
    }
    
    if ($mode === 'update')
    {
        $sql = 'UPDATE ' . SIGNAGE_GENERALS_TABLE . ' SET ' . 
            $db->sql_build_array('UPDATE', $sql_ary) .
            " WHERE signage_general_id = $nextid";
        //echo $sql; exit;
        $db->sql_query($sql);
                
    }
    
    redirect($config['signage_path'] . 'signage_general.' . $phpEx, $sid);
}


if ($mode === 'update')
{
    if (empty($nextid))
    {
	die('Missing Playlist ID. Cannot update Playlist Table.');
    }

    $sql = "SELECT * FROM ".SIGNAGE_GENERALS_TABLE." WHERE signage_general_id = ".$nextid."";
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    
}

$s_hidden_fields = build_hidden_fields(array(
    'parent'	=> $parent,
    'mode'	=> $mode,
    'sid'	=> $sid,
    'module'	=> $modules,
    'id'	=> $nextid
    )
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
    'U_ADD'			    => append_sid("{$tonjaw_admin_signage_path}signage_generaldetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			    => $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '0',
    'S_DATETIME_PICKER'	=> '1',
    'L_TITLE'			=> $adm_lang['title'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'S_TITLE'			=> $data['signage_general_title'],
    'V_ENABLED'			=> ($data['signage_general_enabled'])? 'checked' : '',
    'S_FORM_TOKEN'		=> $s_hidden_fields,
    'L_SUBMIT'			=> $adm_lang['submit'],
    'L_DATE'		    => $adm_lang['date'],
	'L_PICK'		    => $adm_lang['pick'],
    'S_DATE'		    => date($config['schedule_dateformat'], $data['signage_general_date']),
    'L_DESCRIPTION'		=> $adm_lang['description'],
    'S_DESCRIPTION'		=> $data['signage_general_remark'],
    
));

$template->set_filenames(array(
	'body' => 'admin_signage_generalform.tpl',
));

page_footer();


?>