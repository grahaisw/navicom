<?php
/**
*
* admin/hotspotdetail.php
*
* Agnes Emanuella. Apr 2016
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
$room		= request_var('room', '');

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

$u_action = $tonjaw_admin_path . 'hotspotdetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    // Preparing UPDATE TV CHANNEL TABLE
    $room = request_var('room', '');
	$password1 = request_var('password1', '');
	$password2 = request_var('password2', '');
	$password3 = request_var('password3', '');
	$password4 = request_var('password4', '');
	
	$password = array($password1, $password2, $password3, $password4);
	
	for($i=0; $i<4; $i++) {
		$sql_ary = array(
			'room_name'			=> $room,
			'hotspot_password'	=> $password[$i],
			'hotspot_rule'		=> $i+1,
		);

		if ($mode === 'add')
		{
		$sql = 'INSERT INTO ' . HOTSPOTS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
		
		//echo $sql . 'master<p>'; exit;
		$db->sql_query($sql);
		$tid = $db->sql_nextid();
		   
		}
		
		if ($mode === 'update')
		{
		$sql = 'UPDATE ' . HOTSPOTS_TABLE . " SET " . 
			$db->sql_build_array('UPDATE', $sql_ary) .
			" WHERE room_name = '".$room."' AND hotspot_rule = ".($i+1)."";
		//echo $sql; exit;
		$db->sql_query($sql);
		
		
		}
		
		
	
	}
    
    redirect($config['admin_path'] . 'hotspot.' . $phpEx, $sid);

}

if ($mode === 'update' || $mode === 'detail')
{
    if (empty($room))
    {
	die('Missing Hotspot Room. Cannot update Hotspot Table.');
    }
    
    $label = ($mode === 'update') ? $adm_lang['update_item'] : $adm_lang['view_item'];
    
    // Grab hotspot data
    $sql = "SELECT * FROM " . HOTSPOTS_TABLE . " WHERE room_name = '".$room."'" ;

    //echo $sql; exit;
    $result = $db->sql_query($sql);
    while($row = $db->sql_fetchrow($result)) {
		switch($row['hotspot_rule']) {
			case 1	: $password1 = $row['hotspot_password']; break;
			case 2	: $password2 = $row['hotspot_password']; break;
			case 3	: $password3 = $row['hotspot_password']; break;
			case 4	: $password4 = $row['hotspot_password']; break;
		}
	}
	
    $db->sql_freeresult($result);
    
}

if ($mode === 'delete')
{
	$sql = 'DELETE FROM ' . HOTSPOTS_TABLE .
		" WHERE room_name = '".$room."'";
	echo $sql; exit;
	$db->sql_query($sql);


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
    //'L_TITLE'			=> $adm_lang['users_online'] . $config['session_length']/3600 . ' hour',
    'S_ADD_UPDATE'		=> $module->user_priviledge[1],
    'S_DELETE'			=> $module->user_priviledge[2],
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}hotspotdetail.$phpEx", "mode=add") . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
    'L_ROOM'			=> $adm_lang['room'],
    'L_PASSWORD1'		=> $adm_lang['password'].' Week 1',
    'L_PASSWORD2'		=> $adm_lang['password'].' Week 2',
	'L_PASSWORD3'		=> $adm_lang['password'].' Week 3',
	'L_PASSWORD4'		=> $adm_lang['password'].' Week 4',
    'L_ADD'			=> $adm_lang['add'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'S_ROOM'				=> $room,
    'S_PASSWORD1'			=> $password1,
    'S_PASSWORD2'			=> $password2,
    'S_PASSWORD3'			=> $password3,
    'S_PASSWORD4'			=> $password4,
    'L_LABEL'			=> $label,
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
	    'id'	=> $tid)
	);


	$template->assign_vars(array(
	    'L_NOTICE_THUMBNAIL'	=> $adm_lang['upload_thumbnail_notice'],
	    'S_THUMBNAIL'		=> $data['tv_channel_thumbnail'],
	    'S_GROUPNAME'		=> generate_tv_group('group_id[]', $group_data),
	    
	    'S_FORM'			=> '1',
	    'S_ALLOW_ADS'		=> ($data['tv_channel_allow_ads'])? 'checked' : '',
	    'L_SUBMIT'			=> $adm_lang['submit'],
	    'S_ENABLED'			=> ($data['tv_channel_enabled'])? 'checked' : '',
	    'S_FORM_TOKEN'		=> $s_hidden_fields,
	));
	
	break;
	
    case 'detail':
    
	
	
	$template->assign_vars(array(
	    'S_GROUPNAME'	=> '',
	    
	    'S_DETAIL'		=> '1',
	    'S_ALLOW_ADS'	=> ($data['tv_channel_allow_ads'])? $adm_lang['yes'] : $adm_lang['no'],
	    'S_ENABLED'		=> ($data['tv_channel_enabled'])? $adm_lang['yes'] : $adm_lang['no'],
	    'L_EDIT'		=> $adm_lang['update'],
	    'U_EDIT'		=> append_sid("{$tonjaw_admin_path}hotspotdetail.$phpEx", "mode=update") . '&amp;room=' .$room . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
	));
	
	break;
	
}


$template->set_filenames(array(
	'body' => 'admin_hotspotform.tpl',
));

page_footer();


?>