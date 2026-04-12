<?php
/**
*
* admin/runningtextdetail.php
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
$mid		= request_var('id', '');

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
$group_data = array();
$zone_data = array();

$u_action = $tonjaw_admin_path . 'runningtextdetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    // Preparing UPDATE PAGE TABLE
    $type = request_var('global_flag', '');
    $gid = array();
    $gid = (isset($_REQUEST['group_id'])) ? request_var('group_id', array('0')) : array();
    $zid = array();
    $zid = (isset($_REQUEST['zone_id'])) ? request_var('zone_id', array('0')) : array(); //array('0' => '');
    $enabled_flag = request_var('enabled_flag', '');  
    $enabled_flag = $enabled_flag == 'on' ? '1' : '0';
	$order = request_var('order', '');

    $type = $type == 'on' ? '1' : '0';

    $start = strtotime(request_var('start', ''));
    $end = strtotime(request_var('end', '')); 
//$start = date("YmdHis",$start);
//$end = date("YmdHis", $end);
    $daily_flag = request_var('daily_flag', '');  
    $daily_flag = $daily_flag == 'on' ? '1' : '0';
        
    $sql_ary = array(
	'message_global'	=> (int) $type,
	'message_enabled'	=> (int) $enabled_flag,
	'message_schedule_start'	=> (int) $start,
	'message_schedule_end'	=> (int) $end,
	'message_daily'	=> (int) $daily_flag,
	'message_order'		=> $order,
     );
    /*
    // Preparing upload poster file
    $path = $tonjaw_root_path . $config['media_path'] . $config['movie_icon_path'];
    $can_upload = (file_exists($tonjaw_root_path . $config['media_path'] . $config['movie_icon_path']) && tonjaw_is_writable($path) && (@ini_get('file_uploads') || strtolower(@ini_get('file_uploads')) == 'on')) ? true : false;
    */
    //echo 'path: ' . $path . '<br>' . $can_upload; exit;
    
    if ($mode === 'add')
    {
	$error = '';
	$error_msg = '';
	if ( $error )
	{
	    die($error_msg);
	}
    
	//$sql_ary['movie_thumbnail'] = $picture_name;
		
	$sql = 'INSERT INTO ' . RUNNINGTEXT_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	//echo $sql; exit;
	$db->sql_query($sql);
	$mid = $db->sql_nextid();
	
    }

    if ($mode === 'update')
    {
	$sql = 'UPDATE ' . RUNNINGTEXT_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE message_id = $mid";
	$db->sql_query($sql);
	
	// Remove old data from message grouping table
	$sql = 'DELETE FROM ' . RUNNINGTEXT_GROUPINGS_TABLE . "
	    WHERE message_id = $mid";
	$db->sql_query($sql);
	
	// Remove old data from message zone grouping table
	$sql = 'DELETE FROM ' . RUNNINGTEXT_ZONE_GROUPINGS_TABLE . "
	    WHERE message_id = $mid";
	$db->sql_query($sql);
    }
    
    //Insert new data to message_grouping table
    foreach($gid as $key => $val)
    {
	$sql_ary = array(
	    'message_id'	=> $mid,
	    'room_id'		=> $val,
	);
	    
	$sql = 'INSERT INTO ' . RUNNINGTEXT_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	    //echo $sql . 'master<p>'; //exit;
	$db->sql_query($sql);

    }
    
    //Insert new data to message_zone_grouping table
    foreach($zid as $key => $val)
    {
	$sql_ary = array(
	    'message_id'	=> $mid,
	    'zone_id'		=> $val,
	);
	    
	$sql = 'INSERT INTO ' . RUNNINGTEXT_ZONE_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	    //echo $sql . 'master<p>'; //exit;
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
	$title = utf8_normalize_nfc(request_var('title_' . $row['id'], '', true));
	$description = utf8_normalize_nfc(request_var('description_' . $row['id'], '', true));
	
	$sql_translation = array(
	    'message_id'		=> (int) $mid,
	    'translation_message'	=> (string) $title,
	    'translation_description'	=> (string) $description,
	    'language_id'		=> (string) $lang_id,
	);
	
	//if ($mode === 'add')
	if ( empty($translation_id) )
	{
	    $sql = 'INSERT INTO ' . RUNNINGTEXT_TRANSLATIONS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_translation);
	    
	}
	
	//if ($mode === 'update')
	if ( !empty($translation_id) )
	{
	    $sql = 'UPDATE ' . RUNNINGTEXT_TRANSLATIONS_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_translation) .
	    " WHERE translation_id = " .$translation_id;
	}
    
	//echo '<p>lang: ' . $sql; exit; 
	$db->sql_query($sql);
	
    }

    redirect($config['admin_path'] . 'runningtext.' . $phpEx, $sid);
}

$detail_data = array();
$lang_data = array();
$lang_count = 0;
$keyword = 'WHERE language_enabled = 1 ';
//$sql_sort = 'log_time DESC';
$start = view_langs($lang_data, $lang_count, $keyword);

if ($mode === 'update' || $mode === 'detail')
{
    if (empty($mid))
    {
	die('Missing Running Text ID. Cannot update Running Text Table.');
    }
    
    $label = ($mode === 'update') ? $adm_lang['update_item'] : $adm_lang['view_item'];
    // Get movie data for updating
    $sql = 'SELECT * FROM ' . RUNNINGTEXT_TABLE . " WHERE message_id=" . (int) $mid;
    
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    
    $sql = 'SELECT * FROM ' . RUNNINGTEXT_TRANSLATIONS_TABLE . " WHERE message_id = $mid";
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    //$detail = $db->sql_fetchrow($result);
    
    while ($detail = $db->sql_fetchrow($result))
    {
	$detail_data[$detail['language_id']] = array(
	    'translation_id'		=> $detail['translation_id'],
	    'translation_title'		=> $detail['translation_message'],
	    'translation_description'	=> $detail['translation_description'],
	);

    }
    
    $db->sql_freeresult($result);
    
    // Grab group data
    $group_data = array();
    
    $sql = 'SELECT g.message_grouping_id, r.room_id, r.room_name FROM ' . 
	  RUNNINGTEXT_GROUPINGS_TABLE . ' g, ' . ROOMS_TABLE . " r 
	  WHERE g.room_id=r.room_id AND g.message_id=$mid";
    $result = $db->sql_query($sql);
    
    $i = 0;
    $group_string = '';
    while ($detail = $db->sql_fetchrow($result))
    {
	$group_data[$i] = array(
	    'room_id'		=> $detail['room_id'],
	    'room_name'		=> $detail['room_name'],
	);
	
	$group_string .= ($i < 1) ? $detail['room_name'] : ', ' . $detail['room_name'];
	
	$i++;

    }
    
    $db->sql_freeresult($result);

    // Grab zone data
    $zone_data = array();
    
    $sql = 'SELECT g.message_zone_grouping_id, z.zone_id, z.zone_name FROM ' . 
	  RUNNINGTEXT_ZONE_GROUPINGS_TABLE . ' g, ' . ZONES_TABLE . " z 
	  WHERE g.zone_id=z.zone_id AND g.message_id=$mid";
    $result = $db->sql_query($sql);
    
    $i = 0;
    $zone_string = '';
    while ($detail = $db->sql_fetchrow($result))
    {
	$zone_data[$i] = array(
	    'zone_id'		=> $detail['zone_id'],
	    'zone_name'		=> $detail['zone_name'],
	);
	
	$zone_string .= ($i < 1) ? $detail['zone_name'] : ', ' . $detail['zone_name'];
	
	$i++;

    }
    
    $db->sql_freeresult($result);
}

$label = (!$label) ? $adm_lang['add_item'] : $label;
$flag_path = $tonjaw_root_path . $config['media_path'] . $config['flag_path'];

$s_hidden_fields = build_hidden_fields(array(
    'parent'	=> $parent,
    'mode'	=> $mode,
    'sid'	=> $sid,
    'module'	=> $modules,
    'id'	=> $mid)
);


adm_page_header($module->active_module_name);

foreach ($lang_data as $row)
{
    //echo '<p>' . $tonjaw_root_path . $config['language_path'] . $row['id'] . ".$phpEx";
    //$data = array();
    $template->assign_block_vars('lang', array(
	'LANG_NAME'	=> $row['name']." (".$row['id'].")",	
	'L_TITLE'	=> $adm_lang['title'],
	'L_DESCRIPTION'	=> $adm_lang['description'],
	'S_DESCRIPTION'	=> $detail_data[$row['id']]['translation_description'],
	'FLAG_FILE'	=> $flag_path . $row['flag'],
	'S_LID'		=> $row['id'],
	'S_TITLE'	=> $detail_data[$row['id']]['translation_title'],
	'S_MID'		=> $detail_data[$row['id']]['translation_id'],
    ));
}


$template->assign_vars(array(
    'HIDE_DISPLAY_SIDE_MENU'	=> $adm_lang['hide_display_side_menu'],
    'LOGIN_AS'			=> $adm_lang['login_as'],
    'USERNAME'			=> $session->username,
    'U_LOGOUT'			=> append_sid("{$tonjaw_admin_path}index.$phpEx") . '&amp;mode=logout',
    'L_LOGOUT'			=> $adm_lang['logout'],
    'MODULE_TITLE'		=> $module->active_module_name,
    'MODULE_DESC' 		=> $module->active_module_desc,
    'U_ACTION'			=> $u_action,
    //'L_TITLE'			=> $adm_lang['users_online'] . $config['session_length']/3600 . ' hour',
    'S_ADD_UPDATE'		=> $module->user_priviledge[1],
    'S_DELETE'			=> $module->user_priviledge[2],
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}runningtextdetail.$phpEx", "mode=add") . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
    'L_TITLE'			=> $adm_lang['title'],
    'L_TARGET_ROOM'		=> $adm_lang['target_room'],
    'L_TARGET_ZONE'		=> $adm_lang['target_zone'],
    'L_ADD'			=> $adm_lang['add'],
    'L_GLOBAL'			=> $adm_lang['global'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'L_LABEL'			=> $label,
	'L_ORDER'			=> $adm_lang['order'],
	
));


switch( $mode )
{
    case 'update':
    case 'add':

	$s_hidden_fields = build_hidden_fields(array(
	    'parent'	=> $parent,
	    'mode'	=> $mode,
	    'sid'	=> $sid,
	    'module'	=> $modules,
	    'id'	=> $mid)
	);


	$template->assign_vars(array(
	    //'S_TARGET_ROOM'	=> generate_runningtext_type('type', $data['message_global']),
	    'S_TARGET_ROOM'	=> generate_runningtext_target('group_id[]', $mid),
	    'S_TARGET_ZONE'	=> generate_runningtext_zone_target('zone_id[]', $mid),
	    'S_FORM'		=> '1',
	    'S_ENABLED'		=> ($data['message_enabled'])? 'checked' : '',
	    'S_GLOBAL'		=> ($data['message_global']) ? 'checked' : '',
	    //'S_TRAILER'	=> $data['movie_trailer'],
	    'L_SUBMIT'		=> $adm_lang['submit'],
	    'S_FORM_TOKEN'	=> $s_hidden_fields,
	    'L_START'		=> $adm_lang['start'],
    	'S_START'		=> date($config['schedule_dateformat'], $data['message_schedule_start']),
    	'L_END'			=> $adm_lang['end'],
    	'S_END'			=> date($config['schedule_dateformat'], $data['message_schedule_end']),
    	'L_PICK'        => $adm_lang['pick'],
    	'L_DAILY'        => $adm_lang['daily'],
    	'S_DATETIME_PICKER'	=> '1',
    	'S_DAILY'		=> ($data['message_daily'])? 'checked' : '',
		'S_ORDER'		=> $data['message_order'],
	));
	
	break;
	
    case 'detail':
    
	$template->assign_vars(array(
	    'S_DETAIL'		=> '1',
        //'S_GENRE'		=> get_movie_genre($config['default_language'], $mid),
	    'S_TARGET_ROOM'	=> $group_string,
	    'S_TARGET_ZONE'	=> $zone_string,
	    'S_GLOBAL'		=> ($data['message_global'])? $adm_lang['yes'] : $adm_lang['no'],
	    'S_ENABLED'		=> ($data['message_enabled'])? $adm_lang['yes'] : $adm_lang['no'],
	    'S_TRAILER'		=> $trailer,
	    'L_EDIT'		=> $adm_lang['update'],
	    'U_EDIT'		=> append_sid("{$tonjaw_admin_path}runningtextdetail.$phpEx", "mode=update") . '&amp;id=' .$mid . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
	    'L_START'		=> $adm_lang['start'],
    	'S_START'		=> date($config['schedule_dateformat'], $data['message_schedule_start']),
    	'L_END'			=> $adm_lang['end'],
    	'S_END'			=> date($config['schedule_dateformat'], $data['message_schedule_end']),
    	'L_PICK'        => $adm_lang['pick'],
    	'L_DAILY'        => $adm_lang['daily'],
    	'S_DATETIME_PICKER'	=> '1',
    	'S_DAILY'		=> ($data['message_daily'])? $adm_lang['yes'] : $adm_lang['no'],
		'S_ORDER'		=> $data['message_order'],
	));
	
	break;
	
}


$template->set_filenames(array(
	'body' => 'admin_runningtextform.tpl',
));

page_footer();

?>
