<?php
/**
*
* remote.php	: User's Guide
*
* Roberto Tonjaw. Apr 2014
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

//$mode	= request_var('mode', '');
//$sid 	= request_var('sid', '');


$remote_data = array();

$sql = 'SELECT t.page_translation_title, t.page_translation_content FROM ' . PAGES_TABLE . ' p, ' . 
    PAGE_TRANSLATIONS_TABLE . ' t '  . " WHERE p.page_id = t.page_id AND p.page_id = " . 
    $config['user_guide_page_id'] . " AND language_id='" . $lang_id . "'";
//echo $sql; exit;
$result = $db->sql_query($sql);
$i = 0;
while ($row = $db->sql_fetchrow($result))
{
    $remote_data[$i] = array(
	'title'		=> $row['page_translation_title'],
	'content'	=> $row['page_translation_content'],
    );
}

$db->sql_freeresult($result);
 
//print_r($welcome_data); exit;  
    
    
// Goto Last URL if TRUE
if( $config['go_to_last_url'] && !empty($node_id) )
{
    $sql = 'SELECT node_last_url FROM ' . NODES_TABLE . " WHERE node_id=$node_id" ;
    $result = $db->sql_query($sql);
    $last_url = $db->sql_fetchfield('node_last_url');
    $db->sql_freeresult($result);
    
    if( !empty($last_url) )
    {
	redirect($last_url);
    }
}

// Generate the page
$widget_data = grab_weather_widget('Kuta');
$template->set_template();

$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $pms_config['url_request']."GetRoomStatus?RoomNo=".$guests_name[0]['room']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 2);
    $response = curl_exec($ch);

    if(curl_errno($ch)) 
    {
        //echo 'Curl error: ' . curl_error($ch);
    }
    else
    {
        $xml = new SimpleXmlElement($response);
        $user = trim($xml->Entry->HotspotUsr);
        $pwd = trim($xml->Entry->HotspotPwd);

    }

if( $config['mobile'] )
{
    $guest_names = '';
    generate_menus($lang_id, $room_key, $guest_names);
}
//page_header($lang_id);
page_header($lang_id, $page);

$template->assign_vars(array(
    'L_TITLE'			=> prepare_message($remote_data[0]['title']),
    'S_REMOTE'			=> '1',
    'S_LANG'			=> $lang_id,
    'S_HOME_MENU_URL'		=> $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value'],
    'T_MEDIA_IMAGE_PATH'	=> $tonjaw_root_path . $config['media_path'] . $config['image_path'],
    //'T_LOG_JS_PATH'		=> $tonjaw_root_path . $config['js_path'] . 'log.js',
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
    ));

$template->set_filenames(array(
	'body' => 'remote.tpl',
));

//add_log($adm_lang['read']);
page_footer();

?>
