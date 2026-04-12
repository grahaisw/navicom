<?php
/**
*
* roomupdate.php
*
* Roberto Tonjaw. Aug 2014
*/

/**
*/

//header('location: main.php');
//exit;

define('IN_TONJAW', true);
define('NEED_SID', true);
define('IN_FRONTEND', true);
define('BYPASS_LOCK', true);

$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './';
$phpEx = substr(strrchr( $_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr( $_SERVER['PHP_SELF'], '/'), 1));
$page = $file[0] . '.' . $phpEx;

// Include files
require($tonjaw_root_path . 'common.' . $phpEx);
require($tonjaw_root_path . 'fe_common.' . $phpEx);
require($tonjaw_root_path . $config['pms_path'] . $pmsname . '.' . $phpEx);

$pms	= new $pms_api();

//Get Guests Names
//$room_name = array();
//$room_name = get_room_data($session->mac); //echo 'mac: ' . $guests_name; exit;
$room_name = $guests_name[0]['room'];

$gid = request_var('gid', '');
$key = request_var('key', '');
$mode = request_var('mode', '');
$key = !trim($key)? '' : 'key=' . $key . '&';
$code = request_var('code', '');
$user_id = request_var('housekeeper_id', '');

//print_r($room_name); exit;
$room_status = $pms->generate_status_combo();

if ( !empty($code) )
{
    //echo "code: $code :: crottt"; exit;
    
    $values['room_name'] = $room_name;
    $values['new_status'] = $code;
	$values['user_id'] = $user_id;
    
    $pms->room_status_update($values);
    
    
    
}

// Generate the page
$template->set_template();
//page_header($lang_id);
page_header($lang_id, $page);

$template->assign_vars(array(
    'L_NOTICE'		=> '',
    'L_PAGE_TITLE'	=> $lang['room_status_update'],
    'S_ROOM_UPDATE'	=> '1',
    'S_ONMOUSEDOWN'	=> "",
    'T_BG_CLIP_PATH'	=> $config['vod_server'] . $config['vod_path'],
    'L_ROOM'		=> $lang['room'],
    'S_ROOM'		=> $room_name,
    'L_SUBMIT'		=> $lang['submit'],
    'L_STATUS'		=> $lang['status'],
    'S_STATUS'		=> $room_status,
    'U_ACTION'		=> $_SERVER['PHP_SELF'],
    'S_HOME_MENU_URL'	=> $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value'],
	'L_USER'		=> $lang['user_id'],
));

$template->set_filenames(array(
	'body' => 'room_update.tpl',
));

//add_log($adm_lang['read']);
page_footer();


?>
