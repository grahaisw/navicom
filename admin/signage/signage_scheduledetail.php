<?php
/**
*
* admin/signage/signage_scheduledetail.php
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

$u_action = $tonjaw_admin_signage_path . 'signage_scheduledetail.' . $phpEx .'?sid=' . $sid;
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
    $name = utf8_normalize_nfc(request_var('name', ''));
    $region_group_id = request_var('region_group_id', '');
    $start = strtotime(request_var('start', ''));
    $end = strtotime(request_var('end', '')); 
    $playlist_id = request_var('playlist_id', '');
    $enabled_flag = request_var('enabled_flag', '');
    $enabled_flag = $enabled_flag == 'on' ? '1' : '0' ;
	$fullscreen_flag = request_var('fullscreen_flag', '');
    $fullscreen_flag = $fullscreen_flag == 'on' ? '1' : '0' ;
    
    $sql_ary = array(
	    'signage_content_schedule_name'	    => $name,
        'signage_content_schedule_start'	=> $start,
	    'signage_content_schedule_end'		=> $end,
	    'signage_region_grouping_id'	    => $region_group_id,
        'playlist_id'	                    => $playlist_id,
        'signage_content_schedule_enabled'  => (int) $enabled_flag,
		'signage_content_schedule_fullscreen'  => (int) $fullscreen_flag,
    );
    
    if ($end < $start)
    {
	$error = true;
	$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $adm_lang['Error_start_end_date'] : $adm_lang['Error_start_end_date'];
    }
    
    if ($mode === 'add')
    {
        $sql = 'INSERT INTO ' . SIGNAGE_CONTENT_SCHEDULE_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
        
        //echo $sql; exit;
        $db->sql_query($sql);
        $nextid = $db->sql_nextid();
        
    }
    
    if ($mode === 'update')
    {
        $sql = 'UPDATE ' . SIGNAGE_CONTENT_SCHEDULE_TABLE . ' SET ' . 
            $db->sql_build_array('UPDATE', $sql_ary) .
            " WHERE signage_content_schedule_id = $nextid";
        //echo $sql; exit;
        $db->sql_query($sql);
                
    }
    
    redirect($config['signage_path'] . 'signage_schedule.' . $phpEx, $sid);
}


if ($mode === 'update')
{
    if (empty($nextid))
    {
	die('Missing Playlist ID. Cannot update Playlist Table.');
    }

    // Get playlist data for updating
    $sql = 'SELECT s.*, g.default_type FROM ' . SIGNAGE_CONTENT_SCHEDULE_TABLE . " s LEFT JOIN ".SIGNAGE_REGION_GROUPINGS_TABLE." g ON s.signage_region_grouping_id = g.signage_region_grouping_id WHERE signage_content_schedule_id=" . (int) $nextid;
    
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    
    $sql = "SELECT playlist_type FROM ".SIGNAGE_PLAYLIST_TABLE." WHERE playlist_id = ".$data['playlist_id']."";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
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
    'U_ADD'			    => append_sid("{$tonjaw_admin_signage_path}signage_scheduledetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			    => $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '0',
    'S_DATETIME_PICKER'	=> '1',
    'L_NAME'			=> $adm_lang['name'],
    'L_REGION_GROUP_NAME'   => $adm_lang['region_group'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'S_NAME'			=> $data['signage_content_schedule_name'],
    'S_REGION_GROUP_NAME'   => generate_region_group('region_group_id', $data['signage_region_grouping_id']),
    'V_ENABLED'			=> ($data['signage_content_schedule_enabled'])? 'checked' : '',
    'S_FORM_TOKEN'		=> $s_hidden_fields,
    'L_SUBMIT'			=> $adm_lang['submit'],
    'L_START'		    => $adm_lang['start'],
    'S_START'		    => date($config['schedule_dateformat'], $data['signage_content_schedule_start']),
    'L_END'			    => $adm_lang['end'],
    'S_END'			    => date($config['schedule_dateformat'], $data['signage_content_schedule_end']),
    'L_PLAYLIST'        => $adm_lang['playlist'],
    'S_PLAYLIST'		=> generate_playlist('playlist_id', $data['playlist_id'], $row['playlist_type']),
    'L_PICK'            => $adm_lang['pick'],
	'L_FULLSCREEN'		=> $adm_lang['full_screen'],
	'S_STYLE'           => ($data['signage_content_schedule_fullscreen'] == 0 && $data['default_type'] != "Clip") ? 'style="display:none;"' : '',
	'V_FULLSCREEN'		=> ($data['signage_content_schedule_fullscreen'])? 'checked' : '',
));

$template->set_filenames(array(
	'body' => 'admin_signage_scheduleform.tpl',
));

page_footer();


?>