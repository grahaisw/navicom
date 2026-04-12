<?php
/**
*
* admin/priviledge.php
*
* Roberto Tonjaw. Jan 2014
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

$session->session_begin($file[0]);

require($tonjaw_root_path . $config['include_path'] . 'functions_module.' . $phpEx);

// Instantiate new module
$module = new p_master();

$template->set_template();

// Instantiate module system and generate list of available modules
$module->list_modules($file[0]);

//Generate detail menu of the selected module
$module->list_modules_detail($file[0], $module->p_id);

// Assign data to the template engine for the list of modules
// We do this before loading the active module for correct menu display in trigger_error
$module->assign_tpl_vars(append_sid("{$tonjaw_admin_path}index.$phpEx"));

// Set up general vars
$mode		= request_var('mode', 'select');
$sid 		= request_var('sid', '');
$uid 		= request_var('uid', '');
$mid 		= request_var('mid', '');

if (empty($mode))
{
    die('Hacking Attempt');
}

if (isset($_POST['submit']) && $mode === 'user' && !empty($uid))
{
    $module_id		= array();
    $priv_id		= array();

    $new_priviledge	= array();
    $string = '';
    
    $module_id	= (isset($_REQUEST['module_id'])) ? request_var('module_id', array(0)) : array();
    $priv_id	= (isset($_REQUEST['priv_id'])) ? request_var('priv_id', array(0)) : array();
    
    for($i = 0; $i < count($module_id); $i++)
    {
	//echo 'mark_' . $Lid[$i] . '- -';
	
	$read = (string) request_var('read_' . $module_id[$i], '')? '1' : '0';
	$update = (string) request_var('edit_' . $module_id[$i], '')? '1' : '0';
	$delete = (string) request_var('delete_' . $module_id[$i], '')? '1' : '0';
	
	$read1 = ( $update || $delete )? '1' : $read ;

	$new_priviledge[$i] = $read1 . $update . $delete;

	// Create a session
	$sql_ary = array(
	    'permission_user_id'	=> (int) $uid,
	    'permission_module_id'	=> (int) $module_id[$i],
	    'permission_value'		=> (string) $new_priviledge[$i],
	);
	
	if( !empty($priv_id[$i]) )
	{
	    $sql = 'UPDATE ' . PERMISSIONS_TABLE . " SET " . $db->sql_build_array('UPDATE', $sql_ary) . " 
		WHERE permission_id = " . $priv_id[$i];
	}
	else
	{
	    $sql = 'INSERT INTO ' . PERMISSIONS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	}
	//echo "<p>$sql</p>"; 
	$db->sql_query($sql);
	
    }
    //exit;
    //echo '<p>lid: '; print_r($lid);
    //echo '<br>mark: '; print_r($mark); echo '<p><p>'; exit; 
        
    redirect($config['admin_path'] . 'priviledge.' . $phpEx, $sid . '&mode=user&uid=' . $uid);
}
elseif (isset($_POST['submit']) && $mode === 'module' && !empty($mid))
{
    $user_id		= array();
    $priv_id		= array();

    $new_priviledge	= array();
    $string = '';
    
    $user_id	= (isset($_REQUEST['module_id'])) ? request_var('module_id', array(0)) : array();
    $priv_id	= (isset($_REQUEST['priv_id'])) ? request_var('priv_id', array(0)) : array();

    for($i = 0; $i < count($user_id); $i++)
    {
	//echo 'mark_' . $Lid[$i] . '- -';
	
	$read = (string) request_var('read_' . $user_id[$i], '')? '1' : '0';
	$update = (string) request_var('edit_' . $user_id[$i], '')? '1' : '0';
	$delete = (string) request_var('delete_' . $user_id[$i], '')? '1' : '0';
	
	$read1 = ( $update || $delete )? '1' : $read ;

	$new_priviledge[$i] = $read1 . $update . $delete;
	
	// Create a session
	$sql_ary = array(
	    'permission_module_id'	=> (int) $mid,
	    'permission_user_id'	=> (int) $user_id[$i],
	    'permission_value'		=> (string) $new_priviledge[$i],
	);
	
	if( !empty($priv_id[$i]) )
	{
	    $sql = 'UPDATE ' . PERMISSIONS_TABLE . " SET " . $db->sql_build_array('UPDATE', $sql_ary) . " 
		WHERE permission_id = " . $priv_id[$i];
	}
	else
	{
	    $sql = 'INSERT INTO ' . PERMISSIONS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	}
	
	$db->sql_query($sql);
	
    }
    
    redirect($config['admin_path'] . 'priviledge.' . $phpEx, $sid . '&mode=module&mid=' . $mid);
}

$u_action = append_sid("{$tonjaw_admin_path}priviledge.$phpEx", "mode=user");
$m_action = append_sid("{$tonjaw_admin_path}priviledge.$phpEx", "mode=module");

//echo 'your user id: ' . $session->userid; exit;

switch( trim($mode) )
{
    case 'user':

	if (empty($uid))
	{
	    die('User ID is empty');
	}
	
	//GRAB DATA
	$priviledges_data = array();
	$all_modules = array();
	$all_modules_count = 0;
	$keyword = " WHERE user_id = $uid";

	grab_priviledges($priviledges_data, $keyword);
	grab_all_modules($all_modules, $all_modules_count);
	$userinfo = get_userinfo($uid);

	//print_r($priviledges_data); echo '<p><p>'; print_r($all_modules); exit;
	$priviledges_data = array_sort($priviledges_data, "mdid");
	$all_modules = array_sort($all_modules, "mid");

	// COMBINE ARRAY MODULE AND PRIVILEDGE

	for ($i = 0; $i < $all_modules_count; $i++) 
	{
	    //$user_priviledges['module_detail_id'] = '';
    
	    //echo "mid:" . $all_modules[$i]['mid'] . ' - mdid:' . $priviledges_data[$i]['mdid'] . '</br>';
	    $string = '';
    
	    if ( $all_modules[$i]['mid'] === $priviledges_data[$i]['mdid'])
	    {
	    //echo $i . '</br>'; 
	
		$string = $priviledges_data[$i]['pvalue'];
	
		$all_modules[$i]['pid'] = $priviledges_data[$i]['pid'];
		$all_modules[$i]['read'] = ($string[0] === '1')? 'checked' : '';
		$all_modules[$i]['update'] = ($string[1] === '1')? 'checked' : '';
		$all_modules[$i]['delete'] = ($string[2] === '1')? 'checked' : '';
		//$all_modules[$i]['pvalue'] = $priviledges_data[$i]['pvalue'];
	
	    }
	    else
	    {
		$all_modules[$i]['pid'] = '';
		$all_modules[$i]['read'] = '';
		$all_modules[$i]['update'] = '';
		$all_modules[$i]['delete'] = '';
	    }
    
	}

	$s_hidden_fields = build_hidden_fields(array(
	    'mode'	=> $mode,
	    'sid'	=> $sid,
	    'uid'	=> $uid)
	);


	//print_r($all_modules); exit;
	// Generate the page
	adm_page_header($module->active_module_name);

	foreach ($all_modules as $row)
	{
	    //$string = $row['pvalue'];
    
	    //$data = array();
	    $template->assign_block_vars('priviledge', array(
		'NAME1'		=> $row['mparent'],
		'NAME2'		=> $row['mdetailcat'],
		'NAME3'		=> $row['mdetailname'],
		'U_NAME3'	=> $m_action . '&amp;mid=' . $row['mid'] . '&amp;module=' . $module->active_module_name,
		'S_MID'		=> $row['mid'],
		'S_PID'		=> $row['pid'],
		'V_RID'		=> $row['read'],
		'V_EID'		=> $row['update'],
		'V_DID'		=> $row['delete'],
		'READ'		=> ($row['read']) ? 'Yes' : 'No',
		'UPDATE'	=> ($row['update']) ? 'Yes' : 'No',
		'DELETE'	=> ($row['delete']) ? 'Yes' : 'No',
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
	    'U_ACTION'			=> $u_action . "&amp;$u_sort_param$keywords_param&amp;start=$start",
	    //'L_TITLE'			=> $adm_lang['users_online'] . $config['session_length']/3600 . ' hour',
	    'S_PRIVILEDGE'		=> '1',
	    'L_USER'			=> $userinfo,
    
	    'S_DATATABLE_NODES'		=> '1',
	    'S_THIRD_FIELD'		=> '1',
	    'S_FOURTH_FIELD'		=> '1',
	    'S_ADD_UPDATE'		=> $module->user_priviledge[1],
	    'S_DELETE'			=> $module->user_priviledge[2],

	    'L_NAME1'			=> $adm_lang['parent'],
	    'L_NAME2'			=> $adm_lang['category'],
	    'L_NAME3'			=> $adm_lang['module'],
	    'L_READ'			=> $adm_lang['read'],
	    'L_UPDATE'			=> $adm_lang['update'],
	    'L_DELETE'			=> $adm_lang['delete'],

	    'L_SUBMIT'			=> $adm_lang['submit'],
	    'S_FORM_TOKEN'		=> $s_hidden_fields,
	));

	$template->set_filenames(array(
	      'body' => 'admin_priviledge_user.tpl',
	));

    	break;
	
    case 'module':
	
	if (empty($mid))
	{
	    die('Module ID is empty');
	}
	
	//$u_action = append_sid("{$tonjaw_admin_path}priviledge.$phpEx", "mode=module");
	//GRAB DATA
	$priviledges_data = array();
	$all_users = array();
	$all_users_count = 0;
	$keyword = " WHERE module_detail_id = $mid";

	grab_priviledges($priviledges_data, $keyword);
	grab_all_users($all_users, $all_users_count);
	
	$moduleinfo = get_moduleinfo($mid);
	
	//echo 'hgfhgfh<p>'; print_r($all_users); exit;
	
	$priviledges_data = array_sort($priviledges_data, "puid");
	$all_users = array_sort($all_users, "uid");
	//print_r($priviledges_data); echo '<p><p>'; print_r($all_users); exit;
	
	// COMBINE ARRAY USER AND PRIVILEDGE

	for ($i = 0; $i < $all_users_count; $i++) 
	{
	    //$user_priviledges['module_detail_id'] = '';
    
	    $read = '';
	    $update = '';
	    $delete = '';
	
	    //echo "mid:" . $all_modules[$i]['mid'] . ' - mdid:' . $priviledges_data[$i]['mdid'] . '</br>';
	    $string = '';
    
	    if ( $all_users[$i]['uid'] === $priviledges_data[$i]['puid'])
	    {
	    //echo $i . '</br>'; 
	
		$string = $priviledges_data[$i]['pvalue'];
	
		$all_users[$i]['pid'] = $priviledges_data[$i]['pid'];
		$all_users[$i]['read'] = ($string[0] === '1')? 'checked' : '';
		$all_users[$i]['update'] = ($string[1] === '1')? 'checked' : '';
		$all_users[$i]['delete'] = ($string[2] === '1')? 'checked' : '';
		//$all_modules[$i]['pvalue'] = $priviledges_data[$i]['pvalue'];
	
	    }
	    else
	    {
		$all_users[$i]['pid'] = '';
		$all_users[$i]['read'] = '';
		$all_users[$i]['update'] = '';
		$all_users[$i]['delete'] = '';
	    }
    
	}

	$s_hidden_fields = build_hidden_fields(array(
	    'mode'	=> $mode,
	    'sid'	=> $sid,
	    'mid'	=> $mid)
	);
	
	//print_r($all_modules); exit;
	// Generate the page
	adm_page_header($module->active_module_name);

	foreach ($all_users as $row)
	{
	    //$string = $row['pvalue'];
    
	    //$data = array();
	    $template->assign_block_vars('priviledge', array(
		'NAME1'		=> $row['user_group_name'],
		'NAME2'		=> $row['user_fullname'],
		'NAME3'		=> $row['user_name'],
		'U_NAME3'	=> $u_action . '&amp;uid=' . $row['uid'] . '&amp;module=' . $module->active_module_name,
		'S_MID'		=> $row['uid'],
		'S_PID'		=> $row['pid'],
		'V_RID'		=> $row['read'],
		'V_EID'		=> $row['update'],
		'V_DID'		=> $row['delete'],
		'READ'		=> ($row['read']) ? 'Yes' : 'No',
		'UPDATE'	=> ($row['update']) ? 'Yes' : 'No',
		'DELETE'	=> ($row['delete']) ? 'Yes' : 'No',

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
	    'U_ACTION'			=> $u_action . "&amp;$u_sort_param$keywords_param&amp;start=$start",
	    //'L_TITLE'			=> $adm_lang['users_online'] . $config['session_length']/3600 . ' hour',
	    'S_PRIVILEDGE'		=> '1',
	    'L_USER'			=> $moduleinfo,
    
	    'S_DATATABLE_NODES'		=> '1',
	    'S_THIRD_FIELD'		=> '1',
	    'S_FOURTH_FIELD'		=> '1',
	    'S_ADD_UPDATE'		=> $module->user_priviledge[1],
	    'S_DELETE'			=> $module->user_priviledge[2],

	    'L_NAME1'			=> $adm_lang['group_name'],
	    'L_NAME2'			=> $adm_lang['fullname'],
	    'L_NAME3'			=> $adm_lang['username'],
	    'L_READ'			=> $adm_lang['read'],
	    'L_UPDATE'			=> $adm_lang['update'],
	    'L_DELETE'			=> $adm_lang['delete'],

	    'L_SUBMIT'			=> $adm_lang['submit'],
	    'S_FORM_TOKEN'		=> $s_hidden_fields,
	));

	$template->set_filenames(array(
	      'body' => 'admin_priviledge_user.tpl',
	));
	
	break;
	
    default:	// mode = select user or module
	//echo 'mode: ' . $mode; exit;
	
	$s_hidden_fields_user = build_hidden_fields(array(
	    'mode'	=> 'user',
	    'sid'	=> $sid)
	);
	
	$s_hidden_fields_module = build_hidden_fields(array(
	    'mode'	=> 'module',
	    'sid'	=> $sid)
	);
	
	    // Generate the page
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
	    'U_USER_ACTION'		=> $u_action,
	    'U_MODULE_ACTION'		=> $m_action,
	    //'L_TITLE'			=> $adm_lang['users_online'] . $config['session_length']/3600 . ' hour',

	    'L_USER'			=> generate_user_combo('uid'),
	    'L_MODULE'			=> generate_module_combo('mid'),

	    //'S_USER'			=> $adm_lang['group_name'],
	    //'S_MODULE'		=> $adm_lang['fullname'],

	    'L_SUBMIT'			=> $adm_lang['go'],
	));

	$template->set_filenames(array(
	      'body' => 'admin_priviledge_select.tpl',
	));
	
	break;


}
//add_log($adm_lang['read']);
page_footer();



?>