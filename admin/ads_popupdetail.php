<?php
/**
*
* admin/ads_popupdetail.php
*
* Agnes Emanuella. Mar 2017
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
$rid		= request_var('id', '');

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

$u_action = $tonjaw_admin_path . 'ads_popupdetail.' . $phpEx .'?sid=' . $sid;
// This page depends on its parent and cannot be displayed alone
if (empty($parent) || empty($sid) || empty($module) || empty($mode))
{
    die('Hacking Attempt');
}

// Preparing data
if (isset($_POST['submit']))
{
    // Preparing UPDATE ROOM TABLE
    $name = utf8_normalize_nfc(request_var('name', ''));
    $description = utf8_normalize_nfc(request_var('description', ''));
    $image = utf8_normalize_nfc(request_var('image', ''));
    $duration = request_var('duration', '');
    $enabled_flag = request_var('enabled_flag', '');
    $enabled_flag = $enabled_flag == 'on' ? '1' : '0' ;
   
	// Copy file from temporary folder into the real folder
	$filename = $tonjaw_admin_path . 'uploads/temp/' . $image;
	$filename_ads = $tonjaw_root_path . $config['media_path'] . $config['ads_popup_path'] . $image;
	
	/*if (!copy($filename, $filename_ads)) {
		$errors= error_get_last();
		echo "failed to copy $filename...\n";
		echo "COPY ERROR: ".$errors['type'];
		echo "<br />\n".$errors['message'];
	} else {
		echo 'yeay';
	}*/
	
	$input = fopen($filename, "r");
	$temp = tmpfile();
	$realSize = stream_copy_to_stream($input, $temp);
	fclose($input);
	
	$target = fopen($filename_ads, "w");        
	fseek($temp, 0, SEEK_SET);
	stream_copy_to_stream($temp, $target);
	fclose($target);
	
	// Delete files in temporary folder
	$files = glob($tonjaw_admin_path . 'uploads/temp/*'); //get all file names
	foreach($files as $file){
		if(is_file($file))
		unlink($file); //delete file
	}
   
    $sql_ary = array(
	    'ads_popup_name'		=> $name,
	    'ads_popup_description'	=> $description,
        'ads_popup_image'		=> $image,
        //'ads_popup_duration'	=> $duration,
	    'ads_popup_enabled'		=> (int) (!empty($enabled_flag)? '1' : '0'),
    );
    
    if ($mode === 'add')
    {
	$sql = 'INSERT INTO ' . ADS_POPUPS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	
	//echo $sql . 'master<p>'; //exit;
	$db->sql_query($sql);
	$rid = $db->sql_nextid();
    }

    if ($mode === 'update')
    {
	$sql_check = "SELECT ads_popup_image FROM " . ADS_POPUPS_TABLE . " WHERE ads_popup_id = '".$rid."'";
	$result_check = $db->sql_query($sql_check);
	$popup_image = $db->sql_fetchfield('ads_popup_image');
	
	// Delete previous file
	$file = $tonjaw_root_path . $config['media_path'] . $config['ads_popup_path'] . $popup_image; 
	if(is_file($file))
	unlink($file); 	
		
	$sql = 'UPDATE ' . ADS_POPUPS_TABLE . ' SET ' . 
	    $db->sql_build_array('UPDATE', $sql_ary) .
	    " WHERE ads_popup_id = $rid";
	$db->sql_query($sql);
	
    }
   
    redirect($config['admin_path'] . 'ads_popup.' . $phpEx, $sid);
}

if ($mode === 'update')
{
    if (empty($rid))
    {
	die('Missing Popup ID. Cannot update Popup Table.');
    }

    // Get popup data for updating
    $sql = 'SELECT * FROM ' . ADS_POPUPS_TABLE . " WHERE ads_popup_id=" . (int) $rid;
    
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $data = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
 
}

$foreign_id = (!empty($rid))? $rid : 0;
//$zone_id = (!empty($zid))? $zid : 0;

$s_hidden_fields = build_hidden_fields(array(
    'parent'	=> $parent,
    'mode'	=> $mode,
    'sid'	=> $sid,
    'module'	=> $modules,
    'id'	=> $rid)
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
    'U_ADD'			=> append_sid("{$tonjaw_admin_path}ads_popupdetail.$phpEx", "mode=add") . '&amp;parent=' . $file[0] . '&amp;module=' . $module->active_module_name,
    'L_ADD'			=> $adm_lang['add'],
    'S_FACEBOX'			=> '0',
    'S_DATATABLE_NODES'		=> '0',
    'L_POPUP_NAME'		=> $adm_lang['name'],
    'L_POPUP_DESCRIPTION'	=> $adm_lang['description'],
    'L_IMAGE'			=> $adm_lang['image'],
    //'L_DURATION'			=> $adm_lang['duration'],
    'L_ENABLED'			=> $adm_lang['enabled'],
    'S_POPUP_NAME'			=> $data['ads_popup_name'],
    'S_POPUP_DESCRIPTION'		=> $data['ads_popup_description'],
    'S_IMAGE'			=> $data['ads_popup_image'],
    'S_DURATION'			=> $data['ads_popup_duration'],
    'S_ENABLED'			=> ($data['ads_popup_enabled'])? 'checked' : '',
    'S_FORM_TOKEN'		=> $s_hidden_fields,
    'L_SUBMIT'			=> $adm_lang['submit'],
	'S_ADS_IMAGE_UPLOADER'		=> '1',
	'S_TYPE'			=> 'popup',
));

$template->set_filenames(array(
	'body' => 'admin_ads_popupform.tpl',
));

page_footer();


?>
