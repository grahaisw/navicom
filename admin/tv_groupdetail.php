<?php
/**
*
* admin/tv_groupdetail.php
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

//echo $file[0]; exit;
//$template->set_template();

$parent 	= request_var('parent', '');
$mode		= request_var('mode', '');
$sid 		= request_var('sid', '');
$modules	= request_var('module', '');
$gid		= request_var('id', '');

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

$u_action = $tonjaw_admin_path . 'tv_groupdetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    //$title = utf8_normalize_nfc(request_var('title', ''));
    $description = utf8_normalize_nfc(request_var('description', ''));
    $enabled_flag = request_var('enabled_flag', '');
    $thumbnail = request_var('thumbnail', '');
    $order = request_var('order', '');
    
    $enabled_flag = $enabled_flag == 'on' ? '1' : '0';
    
    $sql_ary = array(
	'tv_channel_group_description'	=> (string) $description,
	'tv_channel_group_enabled'	=> (int) $enabled_flag,
	'tv_channel_group_order'	=> (int) $order,
	'tv_channel_group_thumbnail'	=> (string) $thumbnail,
    );

    if ($mode === 'add')
    {
      
	$sql = 'INSERT INTO ' . TV_GROUPS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	
	//echo $sql . 'master<p>'; //exit;
	$db->sql_query($sql);
	$gid = $db->sql_nextid();
	
    }
    
    if ($mode === 'update')
    {
	$sql = 'UPDATE ' . TV_GROUPS_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE tv_channel_group_id = $gid";
	
	$db->sql_query($sql);
	
    }
    
    //GRAB LANGUAGES DATA
    $lang_data = array();
    $lang_count = 0;
    //$sql_sort = 'log_time DESC';
    $start = view_langs($lang_data, $lang_count);

    //echo '<p>'; print_r($lang_data);
    $sql_translation 	= array();
    $i = 0;
    foreach($lang_data as $row)
    {
	$lang_id = request_var('lang_' . $row['id'], '');
	$translation_id = request_var('translation_' . $row['id'], '');
	$group_title = utf8_normalize_nfc(request_var('title_' . $row['id'], '', true));
	
	$sql_translation = array(
	    'tv_channel_group_id'	=> (int) $gid,
	    'translation_title'		=> (string) $group_title,
	    'language_id'		=> (string) $lang_id,
	);
	
	//if ($mode === 'add')
	if ( empty($translation_id) )
	{
	    $sql = 'INSERT INTO ' . TV_GROUP_TRANSLATIONS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_translation);
	    
	}
	
	//if ($mode === 'update')
	if ( !empty($translation_id) )
	{
	    $sql = 'UPDATE ' . TV_GROUP_TRANSLATIONS_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_translation) .
	    " WHERE translation_id = " .$translation_id;
	}
    
	//echo '<p>lang: ' . $sql; exit;
	$db->sql_query($sql);
	
    }

    redirect($config['admin_path'] . 'tv_group.' . $phpEx, $sid);
}

$detail_data = array();
$lang_data = array();
$lang_count = 0;
$keyword = 'WHERE language_enabled = 1 ';
//$sql_sort = 'log_time DESC';
$start = view_langs($lang_data, $lang_count, $keyword);

if ($mode === 'update')
{
    if (empty($gid))
    {
	die('Missing TV Group ID. Cannot update TV Group Table.');
    }
    
    $label = ($mode === 'update') ? $adm_lang['update_item'] : $adm_lang['view_item'];

    $data = array();
    
    // Get node data for updating
    $sql = 'SELECT * FROM ' . TV_GROUPS_TABLE . " WHERE tv_channel_group_id=" . (int) $gid;
    
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    
    $sql = 'SELECT * FROM ' . TV_GROUP_TRANSLATIONS_TABLE . " WHERE tv_channel_group_id = $gid";
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    //$detail = $db->sql_fetchrow($result);
    
    while ($detail = $db->sql_fetchrow($result))
    {
	$detail_data[$detail['language_id']] = array(
	    'translation_id'		=> $detail['translation_id'],
	    'translation_title'		=> $detail['translation_title'],
	);

    }
    
    $db->sql_freeresult($result);
}

$flag_path = $tonjaw_root_path . $config['media_path'] . $config['flag_path'];

$s_hidden_fields = build_hidden_fields(array(
    'parent'	=> $parent,
    'mode'	=> $mode,
    'sid'	=> $sid,
    'module'	=> $modules,
    'id'	=> $gid)
);

$label = (!$label) ? $adm_lang['add_item'] : $label;
adm_page_header($module->active_module_name);

foreach ($lang_data as $row)
{
    //echo '<p>' . $tonjaw_root_path . $config['language_path'] . $row['id'] . ".$phpEx";
    //$data = array();
    $template->assign_block_vars('lang', array(
	'LANG_NAME'	=> $row['name']." (".$row['id'].")",	
	'L_TITLE'	=> $adm_lang['title'],
	'FLAG_FILE'	=> $flag_path . $row['flag'],
	'S_LID'		=> $row['id'],
	'S_TITLE'	=> $detail_data[$row['id']]['translation_title'],
	'S_TID'		=> $detail_data[$row['id']]['translation_id'],
    ));
}

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
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}tv_groupdetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '0',
    'L_TITLE'			=> $adm_lang['name'],
    'L_DESCRIPTION'		=> $adm_lang['description'],
    'L_THUMBNAIL'		=> $adm_lang['thumbnail'],
    'L_ORDER'			=> $adm_lang['order'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'S_TITLE'			=> $data['tv_channel_group_name'],
    'S_DESCRIPTION'		=> $data['tv_channel_group_description'],
    'S_THUMBNAIL'		=> $data['tv_channel_group_thumbnail'],
    'S_ORDER'			=> $data['tv_channel_group_order'],
    'S_ENABLED'			=> ($data['tv_channel_group_enabled'])? 'checked' : '',
    'S_FORM_TOKEN'		=> $s_hidden_fields,
    'L_SUBMIT'			=> $adm_lang['submit'],
    'L_LABEL'			=> $label,
));

$template->set_filenames(array(
	'body' => 'admin_tv_groupform.tpl',
));

page_footer();


?>