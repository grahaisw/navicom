<?php
/**
*
* admin/signage/signage_playlistdetail.php
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
$full_url = $_SERVER['REQUEST_URI'];
$pos = strpos($full_url, '&region_id'); 
if(!empty($pos)) {
    $tail = substr($full_url, $pos);
    $url = str_replace($tail, "", $full_url);
} else {
    $url = $full_url;
}

$u_action = $tonjaw_admin_signage_path . 'signage_playlistdetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    // Preparing UPDATE REGION TABLE
    $name = utf8_normalize_nfc(request_var('name', ''));
    $description = utf8_normalize_nfc(request_var('description', ''));
    $type_id = request_var('type_id', '');
    $enabled_flag = request_var('enabled_flag', '');
    $enabled_flag = $enabled_flag == 'on' ? '1' : '0' ;
    //$loop_flag = request_var('loop_flag', '');
    $pcontent_id = array();
    $pcontent_id = (isset($_REQUEST['pc_id'])) ? request_var('pc_id', array('0')) : array();
    $duration = request_var('duration', '');  
    $duration = ($duration=='') ? 0 : $duration;
    
    //print_r($room_id); exit;
    $sql_ary = array(
	    'playlist_name'		    => $name,
	    'playlist_description'	=> $description,
	    'playlist_enabled'	    => (int) $enabled_flag,
	    'playlist_type'		    => $type_id,
        //'playlist_loop'	        => (int) (!empty($loop_flag)? '1' : '0'),
        'playlist_duration'	    => $duration,
    );
    
    if ($mode === 'add')
    {
        $sql = 'INSERT INTO ' . SIGNAGE_PLAYLIST_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
        
        //echo $sql . 'master<p>'; //exit;
        $db->sql_query($sql);
        $nextid = $db->sql_nextid();
        
    }
    
    if ($mode === 'update')
    {
        $sql = 'UPDATE ' . SIGNAGE_PLAYLIST_TABLE . ' SET ' . 
            $db->sql_build_array('UPDATE', $sql_ary) .
            " WHERE playlist_id = $nextid";
        //echo $sql; exit;
        $db->sql_query($sql);
        
        // Remove old data from signage_playlist_contents table
        $sql = 'DELETE FROM ' . SIGNAGE_PLAYLIST_CONTENT_TABLE . "
            WHERE playlist_id = $nextid";
        $db->sql_query($sql);
        
    }
    
    //Insert new data to signage_playlist_contents table
    $i = 0;
    while ( $i < sizeof($pcontent_id) )
    {
        $type = get_playlist_type($type_id);
        
        $sql = "SELECT signage_".$type[1]."_file AS file FROM ".$type[0]." WHERE signage_".$type[1]."_id = ".$pcontent_id[$i]."";
        $result = $db->sql_query($sql);
        $content_source = $db->sql_fetchfield('file');
        $db->sql_freeresult($result);
        
        $sql_ary = array(
            'playlist_content_source'   => $content_source,
            'playlist_id'		        => $nextid,
        );
        
        $sql = 'INSERT INTO ' . SIGNAGE_PLAYLIST_CONTENT_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
        //echo $sql; exit;
        $db->sql_query($sql);
    
        $i++;
    }
    
    redirect($config['signage_path'] . 'signage_playlist.' . $phpEx, $sid);
}


if ($mode === 'update' || $mode === 'detail')
{
    if (empty($nextid))
    {
	die('Missing Playlist ID. Cannot update Playlist Table.');
    }

    // Get playlist data for updating
    $sql = 'SELECT * FROM ' . SIGNAGE_PLAYLIST_TABLE . " WHERE playlist_id=" . (int) $nextid;
    
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
        
}

if ($mode === 'detail')
{
    if (empty($nextid))
    {
	die('Missing Playlist ID. Cannot update Playlist Table.');
    }

    // Get playlist data for updating
    $sql = 'SELECT * FROM ' . SIGNAGE_PLAYLIST_CONTENT_TABLE . " WHERE playlist_id=" . (int) $nextid;
    
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $content = array();
    while($row = $db->sql_fetchrow($result)) {
        $content[] = $row['playlist_content_source'];
    }
    $playlist_content = implode(", ", $content);
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
    'U_ADD'			    => append_sid("{$tonjaw_admin_signage_path}signage_playlistdetail.$phpEx", "mode=add") . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
    'L_ADD'			    => $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '0',
    'L_NAME'			=> $adm_lang['name'],
    'L_DESCRIPTION'		=> $adm_lang['description'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'S_FORM_TOKEN'		=> $s_hidden_fields,
    'L_SUBMIT'			=> $adm_lang['submit'],
    'L_TYPE'		    => $adm_lang['type'],
    //'S_TYPE'		    => view_signage_type('type_id', $data['playlist_type'], 'get_content', $url),
    'L_LOOP'			=> $adm_lang['loop'],
    'S_LOOP'			=> ($data['playlist_loop'])? 'checked' : '',
    'L_CONTENT'			=> $adm_lang['content'],
    'S_CONTENT'			=> generate_playlist_content('pc_id[]', $nextid, $data['playlist_type']),
    'L_DURATION'		=> $adm_lang['duration'],
    'S_DURATION'		=> $data['playlist_duration'],
    'S_STYLE'           => ($data['playlist_duration'] == 0) ? 'style="display:none;"' : '',
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
            'S_NAME'	    => $data['playlist_name'],
            'S_DESCRIPTION'	=> trim($data['playlist_description']),
            'S_TYPE'		=> view_signage_type('type_id', $data['playlist_type'], 'get_content', $url),
            'S_ADS'		    => generate_ads('ads_id', $data['signage_ads_id']),
            'S_ENABLED'		=> ($data['playlist_enabled'])? 'checked' : '',
            'S_FORM_TOKEN'		=> $s_hidden_fields,
        ));
        break;
        
    case 'detail' :
        foreach($config['signage_type'] as $key => $val) {
            if($data['playlist_type'] == $key) {
                $playlist_type = $val;
                break;
            }
        }
        
        $template->assign_vars(array(
            'S_DETAIL'		=> '1',
            'S_NAME'	    => $data['playlist_name'],
            'S_DESCRIPTION'	=> trim($data['playlist_description']),
            'S_TYPE'	    => $playlist_type,
            'S_CONTENT'		=> $playlist_content,
            'S_ENABLED'		=> ($data['playlist_enabled'])? 'Yes' : 'No',
            'L_DURATION'	=> $adm_lang['duration'],
        ));
        break;
    
}

$template->set_filenames(array(
	'body' => 'admin_signage_playlistform.tpl',
));

page_footer();


?>