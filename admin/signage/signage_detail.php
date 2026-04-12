<?php
/**
*
* admin/signage/signage_detail.php
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
$type		= request_var('type', '');
$signage_id	= request_var('signage_id', '');
$region_id	= request_var('region_id', '');
$playlist_id    = request_var('playlist_id', '');
$name		= request_var('name', '');

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
$full_url = $_SERVER['REQUEST_URI'];
$pos = strpos($full_url, '&region_id'); 
if(!empty($pos)) {
    $tail = substr($full_url, $pos);
    $url = str_replace($tail, "", $full_url);
} else {
    $url = $full_url;
}
$default_type = $type;

$u_action = $tonjaw_admin_signage_path . 'signage_detail.' . $phpEx .'?sid=' . $sid;
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
    $signage_id = request_var('signage_id', '');
    $region_id = request_var('region_id', '');
    $playlist_id = request_var('playlist_id', '');  
    $playlist_id = ($playlist_id=='') ? 0 : $playlist_id;
    $type_id = request_var('type_id', '');
    $source_id = request_var('source_id', '');
    $enabled_flag = request_var('enabled_flag', '');
    $enabled_flag = $enabled_flag == 'on' ? '1' : '0' ;
    
    
    $type_name = $config['signage_type'][$type_id];
    
    $type_data = get_playlist_type($type_id);
    
    $source = $type_name;
    if(!empty($source_id)) {
        $sql = "SELECT signage_".$type_data[1]."_file AS file FROM " . $type_data[0] . " WHERE signage_".$type_data[1]."_id = ".$source_id." ORDER BY signage_".$type_data[1]."_name";
        
        $db->sql_query($sql);
        $result = $db->sql_query($sql);
        $source = $db->sql_fetchfield('file');
        $db->sql_freeresult($result);
    } 
        
    $sql_ary = array(
	    'signage_id'		    => $signage_id,
	    'region_id'	            	=> $region_id,
	    'playlist_id'	        => (int) ($enabled_flag == '1')? $playlist_id : '0',
	    'default_type'		    => $type_name,
        'default_source'	    => $source,
        'signage_region_grouping_name'  => $name,
    );
    
    if ($mode === 'add')
    {
        $sql = 'INSERT INTO ' . SIGNAGE_REGION_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
        
        //echo $sql; exit;
        $db->sql_query($sql);
        $nextid = $db->sql_nextid();
        
    }
    
    if ($mode === 'update')
    {
        $sql = 'UPDATE ' . SIGNAGE_REGION_GROUPINGS_TABLE . ' SET ' . 
            $db->sql_build_array('UPDATE', $sql_ary) .
            " WHERE signage_region_grouping_id = $nextid";
        //echo $sql; exit;
        $db->sql_query($sql);
                
    }
    
    redirect($config['signage_path'] . 'signage.' . $phpEx, $sid);
}


if ($mode === 'update')
{
    if (empty($nextid))
    {
	die('Missing Playlist ID. Cannot update Playlist Table.');
    }

    // Get playlist data for updating
    $sql = 'SELECT * FROM ' . SIGNAGE_REGION_GROUPINGS_TABLE . " WHERE signage_region_grouping_id=" . (int) $nextid;
    
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    
    $d_type = array_keys($config['signage_type'], $data['default_type']);
    
    $default_type = $d_type[0];
    $signage_id = $data['signage_id'];
    $region_id = $data['region_id'];
    $playlist_id = $data['playlist_id'];
    $default_source = $data['default_source'];
    $name = $data['signage_region_grouping_name'];
    
    $pos = strpos($full_url, '&type_id'); 
    if(!empty($pos)) {
        $tail = substr($full_url, $pos);
        $url = str_replace($tail, "", $full_url);
    } else {
        $url = $full_url;
    }
    
    if($type != '') {
        $default_type = $type;
    }
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
    'U_ADD'			    => append_sid("{$tonjaw_admin_signage_path}signage_detail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			    => $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '0',
    'L_NAME'			=> $adm_lang['name'],
    'L_SIGNAGE'		    => $adm_lang['signage'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'S_NAME'			=> $name,
    'S_SIGNAGE'		    => generate_signage('signage_id', $signage_id),
    'S_ENABLED'			=> ($data['playlist_enabled'])? 'checked' : '',
    'S_FORM_TOKEN'		=> $s_hidden_fields,
    'L_SUBMIT'			=> $adm_lang['submit'],
    'L_TYPE'		    => $adm_lang['default_type'],
    'S_TYPE'		    => view_signage_type('type_id', $default_type, 'get_content', $url),
    'L_REGION'			=> $adm_lang['region'],
    'S_REGION'			=> generate_region('region_id', $region_id),
    'L_PLAYLIST'        => $adm_lang['playlist'],
    'S_PLAYLIST'		=> ($data['playlist_id'] > 0)? 'checked' : '',
    'S_PLAYLIST_STYLE'		=> ($data['playlist_id'] > 0)? 'style="display:table-row;"' : 'style="display:none;"',
    'S_OTHER_STYLE'		=> ($data['playlist_id'] > 0)? 'style="display:none;"' : 'style="display:table-row;"',
    'L_DEFAULT_PLAYLIST'        => $adm_lang['default_playlist'],
    'S_DEFAULT_PLAYLIST'		=> generate_playlist('playlist_id', $playlist_id, $default_type),
    'L_SOURCE'		    => $adm_lang['default_source'],
    'S_SOURCE'		    => view_signage_type_source('source_id', $default_type, $default_source),
));

$template->set_filenames(array(
	'body' => 'admin_signage_form.tpl',
));

page_footer();


?>