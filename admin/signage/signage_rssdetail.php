<?php
/**
*
* admin/signage/signage_rssdetail.php
*
* Agnes Emanuella. Sep 2014
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

$u_action = $tonjaw_admin_signage_path . 'signage_rssdetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    $name = utf8_normalize_nfc(request_var('name', ''));
    $file = utf8_normalize_nfc(request_var('file', ''));
    $ads_id = request_var('ads_id', '');
    $enabled_flag = request_var('enabled_flag', '');
    $enabled_flag = $enabled_flag == 'on' ? '1' : '0' ;
    
    //print_r($room_id); exit;
    $sql_ary = array(
	    'signage_rss_name'		=> $name,
	    'signage_rss_file'		=> $file,
	    'signage_ads_id'	    	=> $ads_id,
	    'signage_rss_enabled'	=> (int) $enabled_flag,
    );
    
    if ($mode === 'add')
    {
        $sql = 'INSERT INTO ' . SIGNAGE_RSS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
        
        //echo $sql . 'master<p>'; //exit;
        $db->sql_query($sql);
        $nextid = $db->sql_nextid();
        
    }
    
    if ($mode === 'update')
    {
        $sql = 'UPDATE ' . SIGNAGE_RSS_TABLE . ' SET ' . 
            $db->sql_build_array('UPDATE', $sql_ary) .
            " WHERE signage_rss_id = $nextid";
        //echo $sql; exit;
        $db->sql_query($sql);
        
    }
    
    redirect($config['signage_path'] . 'signage_rss.' . $phpEx, $sid);
}

if ($mode === 'update' || $mode === 'detail')
{
    if (empty($nextid))
    {
	die('Missing Room ID. Cannot update Room Table.');
    }

    // Get room data for updating
    $sql = 'SELECT signage_rss_name, signage_rss_file, signage_rss_enabled, a.signage_ads_name, t.signage_ads_id FROM ' . SIGNAGE_RSS_TABLE . " t LEFT JOIN ".SIGNAGE_ADS_TABLE." a ON t.signage_ads_id = a.signage_ads_id WHERE signage_rss_id=" . (int) $nextid;
    
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

}
/*
$s_hidden_fields = build_hidden_fields(array(
    'parent'	=> $parent,
    'mode'	=> $mode,
    'sid'	=> $sid,
    'module'	=> $modules,
    'id'	=> $nextid)
);
*/
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
    'U_ADD'			=> append_sid("{$tonjaw_admin_signage_path}signage_rssdetail.$phpEx", "mode=add") . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '0',
    'L_NAME'			=> $adm_lang['name'],
    'L_FILE'			=> $adm_lang['file'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'L_SUBMIT'			=> $adm_lang['submit'],
    'L_ADS'			=> $adm_lang['ads'],
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
            'S_NAME'		=> $data['signage_rss_name'],
            'S_FILE'		=> $data['signage_rss_file'],
            'S_ADS'		=> generate_ads('ads_id', $data['signage_ads_id']),
            'S_ENABLED'		=> ($data['signage_rss_enabled'])? 'checked' : '',
            'S_FORM_TOKEN'		=> $s_hidden_fields,
        ));
        break;
        
    case 'detail' :
    
        $template->assign_vars(array(
            'S_DETAIL'		=> '1',
            'S_NAME'		=> $data['signage_rss_name'],
            'S_FILE'		=> $data['signage_rss_file'],
            'S_ADS'		=> $data['signage_ads_name'],
            'S_ENABLED'		=> ($data['signage_rss_enabled'])? 'Yes' : 'No',
        ));
        break;
    
}

$template->set_filenames(array(
	'body' => 'admin_signage_rssform.tpl',
));

page_footer();


?>