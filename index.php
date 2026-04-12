<?php
/**
*
* index.php	: Main Menu
*
* Roberto Tonjaw. Feb 2014
*/

/**
*/

//header('location: main.php');
//exit;

define('IN_TONJAW', true);
define('NEED_SID', true);
define('IN_FRONTEND', true);

$tonjaw_root_path = (defined('TONJAW_ROOT_PATH')) ? TONJAW_ROOT_PATH : './';
//$phpEx = substr(strrchr(__FILE__, '.'), 1);
//$file = explode('.', substr(strrchr(__FILE__, '/'), 1));
$phpEx = substr(strrchr( $_SERVER['PHP_SELF'], '.'), 1);
$file = explode('.', substr(strrchr( $_SERVER['PHP_SELF'], '/'), 1));
//echo $phpEx . ' <br/>' . $file[0] . '<br/>' . $_SERVER['PHP_SELF']; exit; 
$page = $file[0] . '.' . $phpEx;

// Include files
require($tonjaw_root_path . 'common.' . $phpEx); 
require($tonjaw_root_path . 'fe_common.' . $phpEx);
//require_once($tonjaw_root_path . $config['pms_path'] . 'common_pms.' . $phpEx);

$home_menu	= request_var('menu', '0');
//$sid 	= request_var('sid', '');

// REDIRECT TO TV CHANNEL :: REQUEST FROM REGENT BALI DUE TO CHANGE HOTEL NAME
//redirect($tonjaw_root_path . 'tv_channel.' . $phpEx, $room_key);

// Goto Welcome Screen if TRUE
if ( $config['go_to_welcome_screen'] && !empty($node_id) )
{
    $sql = 'SELECT node_welcome_screen FROM ' . NODES_TABLE . " WHERE node_id=$node_id" ;
    $result = $db->sql_query($sql);
    $node_welcome_screen = $db->sql_fetchfield('node_welcome_screen');
    $db->sql_freeresult($result);
	
    if( $node_welcome_screen != 0 )
    {
	redirect($tonjaw_root_path . 'welcome.' . $phpEx, $room_key);
    }
    
}

// Welcome Screen is in Homepage / Main Menu

$welcome_data = array();

$sql = 'SELECT t.page_translation_title, t.page_translation_content FROM ' . PAGES_TABLE . ' p, ' . 
    PAGE_TRANSLATIONS_TABLE . ' t '  . " WHERE p.page_id = t.page_id AND p.page_id = " . 
    $config['welcome_page_id'] . " AND language_id='" . $lang_id . "'";
//echo $sql; exit;
$result = $db->sql_query($sql);
$i = 0;
while ($row = $db->sql_fetchrow($result))
{
    $welcome_data[$i] = array(
	'title'		=> $row['page_translation_title'],
	'content'	=> $row['page_translation_content'],
    );
}

$db->sql_freeresult($result);


// Welcome Message For Group Guest
if(!empty($guests_name[0]['resv_id']) && !isset($_REQUEST['group_id'])) {
$sql_count = "SELECT COUNT(*) AS total_entries
        FROM " . GUESTS_TABLE . " g
        JOIN " . GUEST_GROUPS_INFO_TABLE . " i ON g.guest_group = i.guest_groups_code
        WHERE guest_reservation_id = ".$guests_name[0]['resv_id']."  AND guest_groups_info_enabled = 1";
$result_count = $db->sql_query($sql_count);
$total_guest_group = $db->sql_fetchfield('total_entries');
$db->sql_freeresult($result_count);

$group_active = 0;
if($total_guest_group > 0) {
$sql = "SELECT g.guest_groupname, g.guest_group, i.guest_groups_info_logo, i.guest_groups_info_title, i.guest_groups_info_welcome  
	FROM " . GUESTS_TABLE . " g 
	JOIN " . GUEST_GROUPS_INFO_TABLE . " i ON g.guest_group = i.guest_groups_code 
	WHERE guest_reservation_id = ".$guests_name[0]['resv_id']." AND guest_groups_info_enabled = 1";
$result = $db->sql_query($sql);
$guest_group = $db->sql_fetchrow($result);

if(!empty($guest_group['guest_groupname']) && !empty($guest_group['guest_group'])) {
	$welcome_data[0]['name'] = $guest_group['guest_groups_info_title'];
	$welcome_data[0]['content'] = $guest_group['guest_groups_info_welcome'];
	$group_active = 1;
}
}
}
//print_r($welcome_data); exit;  
  
    
// Goto Last URL if TRUE
if( $config['go_to_last_url'] && !empty($node_id) )
{
    $sql = 'SELECT node_last_url FROM ' . NODES_TABLE . " WHERE node_id=$node_id" ;
    
    //echo $sql; exit;
    $result = $db->sql_query($sql);
    $last_url = $db->sql_fetchfield('node_last_url');
    $db->sql_freeresult($result);
    
    if( !empty($last_url) )
    {
	redirect($last_url);
    }
}


// Generate the page
$template->set_template();

//Get Guests Names
//$guests_name = array();
$guest_names = '';
generate_menus($lang_id, $room_key, $guest_names);
/*
if ( empty($guest_names) && $config['lock_on_empty_room'] )
{
    redirect('lock.'.$phpEx);
}
*/
if ( $config['tv_on_home'] )
{
    $home_clip = $config['tv_on_home_url'];
}
else
{
    //$home_clip = $tonjaw_root_path . $config['media_path'] . $config['clip_path'] .  $config['clip_file'];
	$home_clip = $config['vod_server'] . $config['vod_path'] . '/' . $config['clip_file'];
}

if($config['connectivity_in_home_screen'])
{
    require($tonjaw_root_path . $config['qrcode_path'] . 'qrlib.' . $phpEx);
    // generating QR Code
    $qr_cache_dir = $tonjaw_root_path . $config['qrcode_path'] . 'cache/';
    $code_content = 'http://' . $config['server_name'] . $config['script_path'] . '/index.php?key=' . $guests_name[0]['room_key'];

    //echo $code_content; exit;
    QRcode::png($code_content, $qr_cache_dir.'qr.png', QR_ECLEVEL_L, 11);
}

// Update fids_lastupdate, supaya notif yang sudah lewat tidak muncul lagi
$micro_time = microtime(true);
$sql_update = "UPDATE ".NODES_TABLE." SET fids_lastupdate = '".date("Y-m-d H:i:s")."', fids_lastupdate_microtime = ".$micro_time."";
$db->sql_query($sql_update);

// Set background image
$guestgroup = get_guest_group($node_id);
$guestgroup_path = $tonjaw_root_path.$config['media_path'].$config['image_path'].'bground/'.$guestgroup.'.jpg';		
if(!file_exists($guestgroup_path)) {
	$guestgroup_bground = $tonjaw_root_path.$config['media_path'].$config['image_path'].'bground/'.$config['bground_default'];
} else {
	$guestgroup_bground = $tonjaw_root_path.$config['media_path'].$config['image_path'].'bground/'.$guestgroup.'.jpg';
}

$widget_data = grab_weather_widget('Kuta');

//print_r($guests_name); exit;
//echo $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value']; exit;

$query_mb= "SELECT  background_music_url from background_music where background_music_enabled = 1";
 $hasil = $db->sql_query($query_mb);
 $roww = $db->sql_fetchrow($hasil);
 $test = $roww['background_music_url'];
 $daniel = $config['vod_server'] . '/vod/music_backgrounds/'. $test .'';
page_header($lang_id, $page);


$template->assign_vars(array(
    'L_NOTICE'			=> $lang['press_ok_to_proceed'],
    'L_PRESS'			=> $lang['press'],
    'L_TOGOTO'			=> $lang['to_go_to'],
    //'S_MAINMENU3'		=> '1',
    'S_WELCOME_TITLE'		=> prepare_message($welcome_data[0]['title']),
    'S_WELCOME_CONTENT'		=> prepare_message($welcome_data[0]['content']),
    'T_BG_CLIP_PATH'		=> $config['vod_server'] . $config['vod_path'] . '/' . $config['bground_clip_file'],
    'T_HOME_CLIP_PATH'		=> $home_clip,
    'S_GUEST_NAME'		=> $guest_names,
    'S_BGROUND_CLIP'		=> $config['bground_clip'],
    //'S_BGROUND_IMAGE'        => (!empty($guestgroup)) ? $guestgroup.'.jpg' : $config['bground_default'],
	'S_BGROUND_IMAGE'        => $guestgroup_bground,
    'S_HOME_CLIP'		=> $config['clip_on_homescreen'],
    'S_HOME_MESSAGE'		=> !$config['welcome_screen'],
    'S_HOME_MENU_URL'		=> $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value'],
    'S_QR_CODE'			=> $config['connectivity_in_home_screen'],
    'L_QR_IMAGE'	=> $qr_cache_dir.'qr.png',
    'L_HOTSPOT_INFO'    => $lang['hotspot_info'],
    'L_HOTSPOT_USER'    => $lang['hotspot_user'],
    'L_HOTSPOT_PWD'    => $lang['hotspot_pwd'],
    'S_HOTSPOT_USER'    => $user,
    'S_HOTSPOT_PWD'     => $pwd,
    'S_HOTSPOT'         => $config['hotspot_in_home_screen'],
	'S_WIDGET_DATE'		=> date("D. j M"),
	'S_WIDGET_CITY'		=> $widget_data['city'],
	'S_WIDGET_ICON'		=> $widget_data['icon'],
	'S_WIDGET_TEMP'		=> $widget_data['temp'],
	'S_CURRENT_TIME'	=> date("Y/n/d/H/i/s", time()),
    //'S_GUEST'			=> $guests_name[0]['fullname'],
    //'T_LOG_JS_PATH'		=> $tonjaw_root_path . $config['js_path'] . 'log.js',
	'S_GROUP'			=> (!empty($group_active)) ? 1 : 0,
	'S_GROUP_BUTTON'	=> 'btn-red.png',
	'S_GROUP_NAME'		=> $welcome_data[0]['name'].' Info',
	'S_MB'               => $daniel,
));

//echo 'key:' . $room_key . $home_menu; exit;

if ( $config['welcome_screen'] && $home_menu !== $config['home_menu_value'] && empty($room_key) )
{
    $show_running_text = false;
    $template->assign_vars(array(
	'S_WELCOME'	=> '1',
    ));
    
    $template->set_filenames(array(
	'body' => 'welcome.tpl',
    ));
    
    //echo 'crot'; exit;

}
else
{
    $show_running_text = true;
    
    $template->assign_vars(array(
	//'S_GUEST_NAME'		=> str_replace("<br/>","",$guest_names),
	'S_HOME'	=> (isset($_GET['group_id'])) ? '0' :'1',
	'S_HOME_GROUP'        => (isset($_GET['group_id'])) ? '1' :'0',
    ));
    
    $template->set_filenames(array(
	'body' => 'home.tpl',
    ));
}

//add_log($adm_lang['read']);
page_footer($show_running_text);

?>
