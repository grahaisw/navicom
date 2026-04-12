<?php
/**
*
* admin/tvdetail.php
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
$tid		= request_var('id', '');

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

$u_action = $tonjaw_admin_path . 'valasdetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    // Preparing UPDATE TV CHANNEL TABLE
    $name = utf8_normalize_nfc(request_var('name', ''));
    $jual = request_var('jual', '');
    $beli = request_var('beli', '');
    $gid	= array();
    $gid	= (isset($_REQUEST['group_id'])) ? request_var('group_id', array('0')) : array('0' => '1');
    //$filename = explode('.', substr(strrchr(__FILE__, '/'), 1));
    $thumbnail = utf8_normalize_nfc(request_var('thumbnail', ''));
    $order = request_var('order', '');
    $allow_ads_flag = request_var('allow_ads_flag', '');
    $enabled_flag = request_var('enabled_flag', '');
    $enabled_flag = $enabled_flag == 'on' ? '1' : '0' ;
    $allow_ads_flag = $allow_ads_flag == 'on' ? '1' : '0' ;
    
    $sql_ary = array(
	    'valas_nama'		=> $name,
	    'valas_jual'	=> $jual,
	    'valas_beli'	=> $beli,
	    //'tv_channel_enabled'	=> (int) ($enabled_flag)? '1' : '0',
	    //'tv_channel_allow_ads'	=> (int) ($allow_ads_flag)? '1' : '0',
	    // 'tv_channel_enabled'	=> (int) $enabled_flag,
    );

    if ($mode === 'add')
    {
	$sql = 'INSERT INTO ' . VALAS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	
	// echo $sql . 'master<p>'; exit;
	$db->sql_query($sql);
    // echo "string";exit();
	$tid = $db->sql_nextid();
	   
    } 
    
    if ($mode === 'update')
    {
	$sql = 'UPDATE ' . VALAS_TABLE . " SET " . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE valas_id = $tid";
	$db->sql_query($sql);
	
	// Remove old data from tv grouping table
	// $sql = 'DELETE FROM ' . TV_GROUPINGS_TABLE . "
	//     WHERE tv_channel_id = $tid";
	// $db->sql_query($sql);
	
    }
    
 //    foreach($gid as $key => $val)
 //    {
	// $sql_ary = array(
	//     'tv_channel_id'		=> $tid,
	//     'tv_channel_group_id'	=> $val,
	// );
	    
	// $sql = 'INSERT INTO ' . TV_GROUPINGS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	// $db->sql_query($sql);
	
 //    }
    
    redirect($config['admin_path'] . 'valas.' . $phpEx, $sid);

}

if ($mode === 'update' || $mode === 'detail')
{
    if (empty($tid))
    {
	die('Missing you.');
    }
    
    $label = ($mode === 'update') ? $adm_lang['update_item'] : $adm_lang['view_item'];
    
    // Grab tv data
    $sql = 'SELECT * FROM ' . VALAS_TABLE . " WHERE valas_id = $tid" ;

    // echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    
 //    $data_thumbnail = ($data['tv_channel_thumbnail'])? $data['tv_channel_thumbnail'] : '0';
 //    $thumbnail = $tonjaw_root_path . $config['media_path'] . $config['tv_icon_path'] . $data_thumbnail;
    
 //    $sql = 'SELECT tv_channel_group_id FROM ' . TV_GROUPINGS_TABLE . " WHERE tv_channel_id = $tid";
 //    //echo $sql; exit;
 //    $result = $db->sql_query($sql);
 //    //$detail = $db->sql_fetchrow($result);
    
 //    $i = 0;
 //    while ($detail = $db->sql_fetchrow($result))
 //    {
	// $group_data[$i] = $detail['tv_channel_group_id'];
	
	// $i++;

 //    }
    
 //    $db->sql_freeresult($result);
    
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
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}tvdetail.$phpEx", "mode=add") . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
    'L_NAME'			=> $adm_lang['name'],
    'L_ORDER'			=> $adm_lang['order'],
    'L_GROUPNAME'		=> $adm_lang['group_name'],
    'L_JUAL'			=> $adm_lang['jual'],
    'L_BELI'		=> $adm_lang['beli'],
    'L_ADD'			=> $adm_lang['add'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'L_ALLOW_ADS'		=> $adm_lang['allow_ads'],
    'L_THUMBNAIL'		=> $adm_lang['thumbnail'],
    'THUMBNAIL_FILE'		=> file_exists($thumbnail)? '1' : '0',
    'S_THUMBNAIL_FILE'		=> $thumbnail,
    'S_ORDER'			=> $data['tv_channel_order'],
    'S_NAME'			=> $data['valas_nama'],
    'S_JUAL'			=> $data['valas_jual'],
    'S_BELI'		=> $data['valas_beli'],
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
	    'U_EDIT'		=> append_sid("{$tonjaw_admin_path}tvdetail.$phpEx", "mode=update") . '&amp;id=' .$tid . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
	));
	
	break;
	
}


$template->set_filenames(array(
	'body' => 'admin_valasdetail.tpl',
));

page_footer();


?>