<?php
/**
*
* admin/group_infodetail.php
*
* Agnes Emanuella. Feb 2017
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

$u_action = $tonjaw_admin_path . 'group_infodetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    // Preparing UPDATE PAGE TABLE
    $guest_groups_code = request_var('guest_groups_code', '');
    $title = request_var('title', '');
    $logo = utf8_normalize_nfc(request_var('logo', ''));
    $welcome_text = utf8_normalize_nfc(request_var('welcome_text', ''));
    $type = request_var('type', '');
    $enabled_flag = request_var('enabled_flag', '');
    $enabled_flag = $enabled_flag == 'on' ? '1' : '0' ;
	$counter_text = request_var('counter_text', '');
    $counter_image = request_var('counter_image', '');
    $counter_fullscreen = request_var('counter_fullscreen', '');
    $counter_video = request_var('counter_video', '');
    
    
	//echo $counter_text; exit;
    
    $sql_ary = array(
	'guest_groups_info_title'		=> $title,
	'guest_groups_info_logo'		=> $logo,
	'guest_groups_info_welcome'		=> $welcome_text,
	'guest_groups_info_type'		=> $type,
	'guest_groups_code'				=> (int) $guest_groups_code,
	'guest_groups_info_enabled'		=> (int) $enabled_flag,
    );
    
    if ($mode === 'add')
    {
	$error = '';
	$error_msg = '';
	
	$sql = 'INSERT INTO ' . GUEST_GROUPS_INFO_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	
	//echo $sql . 'master<p>'; exit;
	$db->sql_query($sql);
	
	$gid = $db->sql_nextid();
	
	//echo 'query result:' . $db->query_result . '<br/>last sql: ' . $db->last_query_text . '<p>$db->sql_nextid: ' . $gid; exit;	
    }
    
    if ($mode === 'update')
    {
	$sql = 'UPDATE ' . GUEST_GROUPS_INFO_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE guest_groups_info_id = $gid";
	//echo $sql . 'master<p>'; exit;
	$db->sql_query($sql);
	
	// Delete old data
	$sql = "DELETE FROM " . GUEST_GROUPS_DETAIL_TABLE . " WHERE guest_groups_info_id = ".$gid;
	$db->sql_query($sql);
	
    }
	
	// Manage Detail Info
	$content = array();
	if($type == '1') {
		for($i=0; $i<=$counter_text; $i++) {
			$content[] = utf8_normalize_nfc(request_var('content_text'.$i, ''));
		}
	} else if($type == '2') {
		for($i=0; $i<=$counter_image; $i++) {
			$content[] = utf8_normalize_nfc(request_var('content_image'.$i, ''));
		}
	} else if($type == '3') {
		for($i=0; $i<=$counter_fullscreen; $i++) {
			$content[] = utf8_normalize_nfc(request_var('content_fullscreen'.$i, ''));
		}
	} else if($type == '4') {
		for($i=0; $i<=$counter_image; $i++) {
			$content[] = utf8_normalize_nfc(request_var('content_video'.$i, ''));
		}
	}
	
	// Insert new data
	$j = 1;
	foreach($content as $item) {
		if(!empty($item)) {
			$sql_ary = array(
			'guest_groups_detail_content'	=> $item,
			'guest_groups_info_id'			=> (int) $gid,
			'guest_groups_detail_order'		=> (int) $j,
			);
			
			$sql = 'INSERT INTO ' . GUEST_GROUPS_DETAIL_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
			$db->sql_query($sql);
			
			$j++;
		}
	}
    
    //exit;
    redirect($config['admin_path'] . 'group_info.' . $phpEx, $sid);
}

if ($mode === 'update' || $mode === 'detail')
{
    if (empty($gid))
    {
	die('Missing Group ID. Cannot update Group Table.');
    }
    // Grab group data
    $sql = 'SELECT * FROM ' . GUEST_GROUPS_INFO_TABLE . " WHERE guest_groups_info_id = $gid" ;

    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
	
	$sql_count = "SELECT COUNT(*) AS total_content FROM " . GUEST_GROUPS_DETAIL_TABLE . " WHERE guest_groups_info_id = ".$data['guest_groups_info_id'];
	//echo $sql_count; exit;
	$result_count = $db->sql_query($sql_count);
	$total_content = $db->sql_fetchfield('total_content');
	
	$sql = "SELECT * FROM " . GUEST_GROUPS_DETAIL_TABLE . " WHERE guest_groups_info_id = ".$data['guest_groups_info_id'];
	//echo $sql; exit;
	$result = $db->sql_query($sql);
	$i = 0;
	while($row = $db->sql_fetchrow($result)) { 
		
		if($data['guest_groups_info_type'] == '1') {
			$template->assign_block_vars('texts', array(
			'CONTENT_TEXT'		=> $row['guest_groups_detail_content'],
			'COUNTER_TEXT'		=> $i,
			
			));
		
		} else if($data['guest_groups_info_type'] == '2') {
			$template->assign_block_vars('images', array(
			'CONTENT_IMAGE'		=> $row['guest_groups_detail_content'],
			'COUNTER_IMAGE'		=> $i,
			
			));
		} else if($data['guest_groups_info_type'] == '3') {
			$template->assign_block_vars('fullscreens', array(
			'CONTENT_FULLSCREEN'=> $row['guest_groups_detail_content'],
			'COUNTER_FULLSCREEN'=> $i,
			
			));
		} else if($data['guest_groups_info_type'] == '4') {
			$template->assign_block_vars('videos', array(
			'CONTENT_VIDEO'		=> $row['guest_groups_detail_content'],
			'COUNTER_VIDEO'		=> $i,
			
			));
		}
		
		$i++;
	} 
    $db->sql_freeresult($result);
	$label = ($mode === 'update') ? $adm_lang['update_item'] : $adm_lang['view_item'];
    
}

$label = (!$label) ? $adm_lang['add_item'] : $label;

adm_page_header($module->active_module_name);

$template->assign_vars(array(
    'HIDE_DISPLAY_SIDE_MENU'	=> $adm_lang['hide_display_side_menu'],
    'LOGIN_AS'			=> $adm_lang['login_as'],
    'USERNAME'			=> $session->username,
    'U_LOGOUT'			=> append_sid("{$tonjaw_admin_path}index.$phpEx") . '&amp;mode=logout',
    'L_LOGOUT'			=> $adm_lang['logout'],
    'MODULE_TITLE'		=> $module->active_module_name,
    'MODULE_DESC' 		=> $module->active_module_desc,
    'U_ACTION'			=> $u_action,
    'S_HTMLBOX'			=> '0',
    'S_JQUERY_TE'		=> '0',
    //'L_TITLE'			=> $adm_lang['users_online'] . $config['session_length']/3600 . ' hour',
    'S_ADD_UPDATE'		=> $module->user_priviledge[1],
    'S_DELETE'			=> $module->user_priviledge[2],
    'U_ADD'				=> append_sid("{$tonjaw_admin_path}group_infodetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'				=> $adm_lang['add'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'L_LABEL'			=> $label,
    'L_TITLE'			=> $adm_lang['title'],
    'L_WELCOME_SCREEN'	=> $adm_lang['welcome_text'],
    'L_LOGO'			=> $adm_lang['logo'],
    'L_GROUP'			=> $adm_lang['group'],
    'L_CONTENT'			=> $adm_lang['content'], 
	'L_TYPE'			=> $adm_lang['type'],
	'S_CHECKED_TEXT'	=> ($data['guest_groups_info_type']== '1' || $data['guest_groups_info_type']=='') ? 'checked' : '',
	'S_CHECKED_IMAGE'	=> ($data['guest_groups_info_type']== '2') ? 'checked' : '',
	'S_CHECKED_FULLSCREEN'	=> ($data['guest_groups_info_type']== '3') ? 'checked' : '',
	'S_CHECKED_VIDEO'	=> ($data['guest_groups_info_type']== '4') ? 'checked' : '',
	
));


switch( $mode )
{
    case 'update':
	
	$s_hidden_fields = build_hidden_fields(array(
	    'parent'	=> $parent,
	    'mode'	=> $mode,
	    'sid'	=> $sid,
	    'module'	=> $modules,
	    'id'	=> $gid)
	);

	$template->assign_vars(array(
	    'L_NOTICE_THUMBNAIL'	=> $adm_lang['upload_thumbnail_notice'],
	    'THUMBNAIL_FILE'		=> file_exists($thumbnail)? '1' : '0',
		'S_WELCOME_SCREEN'	=> $data['guest_groups_info_welcome'],
	    'S_TITLE'			=> $data['guest_groups_info_title'],
	    'S_LOGO'			=> $data['guest_groups_info_logo'],
	    'S_FORM'			=> '1',
	    'S_GROUP'			=> generate_guestgroup_combo('guest_groups_code', $data['guest_groups_code']),
	    'L_SUBMIT'			=> $adm_lang['submit'],
	    'V_ENABLED'			=> ($data['guest_groups_info_enabled'])? 'checked' : '',
	    'S_FORM_TOKEN'		=> $s_hidden_fields,
		'S_DISPLAY_TEXT'	=> ($data['guest_groups_info_type']== '2'|| $data['guest_groups_info_type']== '3'|| $data['guest_groups_info_type']== '4') ? 'display:none' : '',
		'S_DISPLAY_IMAGE'	=> ($data['guest_groups_info_type']== '1'|| $data['guest_groups_info_type']== '3'|| $data['guest_groups_info_type']== '4' || $data['guest_groups_info_type']=='') ? 'display:none' : '',
		'S_DISPLAY_FULLSCREEN'	=> ($data['guest_groups_info_type']== '1' || $data['guest_groups_info_type']== '2'|| $data['guest_groups_info_type']== '4'|| $data['guest_groups_info_type']=='') ? 'display:none' : '',
		'S_DISPLAY_VIDEO'	=> ($data['guest_groups_info_type']== '1' || $data['guest_groups_info_type']== '3'|| $data['guest_groups_info_type']== '2'|| $data['guest_groups_info_type']=='') ? 'display:none' : '',
		'S_TOTAL_TEXT'		=> ($data['guest_groups_info_type']== '1') ?  $total_content-1 : 0,
		'S_TOTAL_IMAGE'		=> ($data['guest_groups_info_type']== '2') ?  $total_content-1 : 0,
		'S_TOTAL_FULLSCREEN'=> ($data['guest_groups_info_type']== '3') ?  $total_content-1 : 0,
		'S_TOTAL_VIDEO'		=> ($data['guest_groups_info_type']== '4') ?  $total_content-1 : 0,
	));
	
	break;
	
    case 'add':
	
	$s_hidden_fields = build_hidden_fields(array(
	    'parent'	=> $parent,
	    'mode'	=> $mode,
	    'sid'	=> $sid,
	    'module'	=> $modules,
	    'id'	=> $gid)
	);

	$template->assign_vars(array(
	    'L_NOTICE_THUMBNAIL'	=> $adm_lang['upload_thumbnail_notice'],
	    'THUMBNAIL_FILE'		=> file_exists($thumbnail)? '1' : '0',
		'S_WELCOME_SCREEN'	=> $data['guest_groups_info_welcome'],
	    'S_TITLE'			=> $data['guest_groups_info_title'],
	    'S_LOGO'			=> $data['guest_groups_info_logo'],
	    'S_FORM'			=> '1',
	    'S_GROUP'			=> generate_guestgroup_combo('guest_groups_code', $data['guest_groups_code']),
	    'L_SUBMIT'			=> $adm_lang['submit'],
	    'V_ENABLED'			=> ($data['guest_groups_info_enabled'])? 'checked' : '',
	    'S_FORM_TOKEN'		=> $s_hidden_fields,
		'S_ADD'				=> 1,
		'S_DISPLAY_TEXT'	=> ($data['guest_groups_info_type']== '2' || $data['guest_groups_info_type']== '3' || $data['guest_groups_info_type']== '4') ? 'display:none' : '',
		'S_DISPLAY_IMAGE'	=> ($data['guest_groups_info_type']== '1' || $data['guest_groups_info_type']== '3' || $data['guest_groups_info_type']== '4' || $data['guest_groups_info_type']=='') ? 'display:none' : '',
		'S_DISPLAY_FULLSCREEN'=> ($data['guest_groups_info_type']== '1' || $data['guest_groups_info_type']== '2' || $data['guest_groups_info_type']== '4'|| $data['guest_groups_info_type']=='') ? 'display:none' : '',
		'S_DISPLAY_VIDEO'	=> ($data['guest_groups_info_type']== '1' || $data['guest_groups_info_type']== '3' || $data['guest_groups_info_type']== '2'|| $data['guest_groups_info_type']=='') ? 'display:none' : '',
		'S_TOTAL_TEXT'		=> 0,
		'S_TOTAL_IMAGE'		=> 0,
		'S_TOTAL_FULLSCREEN'=> 0,
		'S_TOTAL_VIDEO'		=> 0,
	));
	
	break;
	
    case 'detail':
    
	break;
	
}


$template->set_filenames(array(
	'body' => 'admin_group_infoform.tpl',
));

page_footer();

?>