<?php
/**
*
* admin/popup_promo_scheduledetail.php
*
* Agnes Emanuella. Jun 2015
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

$parent 	= request_var('parent', '');
$mode		= request_var('mode', '');
$sid 		= request_var('sid', '');
$modules	= request_var('module', '');
$aid		= request_var('id', '');

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

$u_action = $tonjaw_admin_path . 'popup_promo_scheduledetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    //$title = utf8_normalize_nfc(request_var('title', ''));
    //$description = utf8_normalize_nfc(request_var('description', ''));
    //$enabled_flag = request_var('enabled_flag', '');
    //$enabled_flag = $enabled_flag == 'on' ? '1' : '0';
    $duration = (isset($_REQUEST['duration'])) ? request_var('duration', array(0)) : array();
    $times = (isset($_REQUEST['time'])) ? request_var('time', array(0)) : array();
    

    for($i=0; $i<count($times); $i++) {
    	$mktime = mktime($times[$i], 0, 0, 1, 1, 2015);
		$popup = request_var('popup_'.$i, '');

		$sql_ary = array(
		    'popup_schedule_time'		=> (int) $mktime,
		    'popup_schedule_duration'	=> (int) $duration[$i],
		    'popup_id'		=> (int) $popup,
		);

		if ($mode === 'add')
		{
		  
		    $sql = 'INSERT INTO ' . POPUP_PROMO_SCHEDULE_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
		    
		    //echo $sql.'<br>'; 
		    $db->sql_query($sql);
		    
		}
		
		if ($mode === 'update')
		{
		    $sql = 'UPDATE ' . POPUP_PROMO_SCHEDULE_TABLE . " SET " . 
			$db->sql_build_array('UPDATE', $sql_ary) .
			" WHERE popup_schedule_time = ".$mktime."";
		     
		    $db->sql_query($sql);
		    
		}
    	
    
    }
   
    redirect($config['admin_path'] . 'popup_promo_schedule.' . $phpEx, $sid);
}

$label = (!$label) ? $adm_lang['add_item'] : $label;
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
    'L_LABEL'			=> $label,
    'S_CONTENT'			=> generate_popup_promo_schedule('popup'),
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
	    'id'	=> $aid)
	);

	$template->assign_vars(array(
	    'S_FORM'		=> '1',
	    'U_ACTION'		=> $u_action,
	    'L_COMPOSE'		=> ($mode === 'add')?$adm_lang['add'] : $adm_lang['edit'],
	    'L_SUBMIT'		=> $adm_lang['submit'],
	    'V_ENABLED'		=> ($data['popup_enabled'])? 'checked' : '',
	    'S_FORM_TOKEN'	=> $s_hidden_fields,
	));

	break;
	
    case 'detail':
	$template->assign_vars(array(
	    'S_DETAIL'		=> '1',
	    'L_COMPOSE'		=> $adm_lang['view'],
	    'S_ENABLED'		=> ($data['popup_enabled'])? 'True' : 'False',
	    'L_EDIT'		=> $adm_lang['update'],
	    'U_EDIT'		=> append_sid("{$tonjaw_admin_path}popup_promoscheduledetail.$phpEx", "mode=update") . '&amp;id=' .$aid . '&amp;parent=' . $parent . '&amp;module=' . $module->active_module_name,
	));
	
	break;

    default:
	$error = true;
	$error_msg = ($error_msg) ? $error_msg . '<br />' . $adm_lang['Error_ilegal_mode'] : $adm_lang['Error_ilegal_mode'];
	
	break;
} 




$template->set_filenames(array(
	'body' => 'admin_popup_promo_scheduleform.tpl',
));

page_footer();


?>
