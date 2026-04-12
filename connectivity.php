<?php
/**
*
* connectivity.php
*
* Roberto Tonjaw. Jul 2014
*/

/**
*/

//header('location: main.php');
//exit;

define('IN_TONJAW', true);
define('NEED_SID', true);
define('IN_FRONTEND', true);

$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './';
$phpEx = substr(strrchr( $_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr( $_SERVER['PHP_SELF'], '/'), 1));
$page = $file[0] . '.' . $phpEx;

// Include files
require($tonjaw_root_path . 'common.' . $phpEx);
require($tonjaw_root_path . 'fe_common.' . $phpEx);
//require($tonjaw_root_path . $config['pms_path'] . 'common_pms.' . $phpEx);
require($tonjaw_root_path . $config['qrcode_path'] . 'qrlib.' . $phpEx);

// Welcome Screen is in Homepage / Main Menu

$connectivity_page = array();

$sql = 'SELECT t.page_translation_title, t.page_translation_content FROM ' . PAGES_TABLE . ' p, ' . 
    PAGE_TRANSLATIONS_TABLE . ' t '  . " WHERE p.page_id = t.page_id AND p.page_id = " . 
    $config['connectivity_page_id'] . " AND language_id='" . $lang_id . "'";
//echo $sql; exit;
$result = $db->sql_query($sql);
$i = 0;
while ($row = $db->sql_fetchrow($result))
{
    $connectivity_data[$i] = array(
	'title'		=> $row['page_translation_title'],
	'content'	=> $row['page_translation_content'],
    );
}

$db->sql_freeresult($result);
 
// generating QR Code
$qr_cache_dir = $tonjaw_root_path . $config['qrcode_path'] . 'cache/';
$code_content = 'http://' . $config['server_name'] . $config['script_path'] . '/index.php?key=' . $guests_name[0]['room_key'];

//echo $code_content; exit;
QRcode::png($code_content, $qr_cache_dir.'qr.png', QR_ECLEVEL_L, 11);
   
    // displaying
   // echo '<img src="'.$qr_cache_dir.'qr.png" />'; exit;


// Generate the page
$template->set_template();

//Get Guests Names
//$guests_name = array();
$guest_names = '';
generate_menus($lang_id, $room_key, $guest_names);
//page_header($lang_id);
page_header($lang_id, $page);

$template->assign_vars(array(
    'L_NOTICE'		=> '',
    //'L_PAGE_TITLE'	=> $lang['connectivity'],
    'S_CONNECTIVITY'	=> '1',
    'S_ONMOUSEDOWN'	=> "",
    'S_CONNECTIVITY_TITLE'	=> prepare_message($connectivity_data[0]['title']),
    'T_BG_CLIP_PATH'	=> $config['vod_server'] . $config['vod_path'],
    'L_ROOM'		=> $lang['room'],
    'S_ROOM'		=> $guests_name[0]['room'],
    'S_GUEST'		=> $guest_names,
    'L_NOTE'		=> prepare_message($connectivity_data[0]['content']),
    'L_QR_IMAGE'	=> $qr_cache_dir.'qr.png',
    'S_HOME_MENU_URL'		=> $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value'],
));

$template->set_filenames(array(
	'body' => 'connectivity.tpl',
));

//add_log($adm_lang['read']);
page_footer(true, $page);


?>