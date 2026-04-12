<?php
/**
*
* language.php
*
* Roberto Tonjaw. Mar 2014
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

// GRAB LANGUAGE
$lid = request_var('lid', '');
$key = request_var('key', '');
$key = !trim($key)? '' : 'key=' . $key . '&';

$lang_url = 'language.php?' . $key;


if ( !empty($lid) && !empty($node_id) )
{
    $sql = 'UPDATE ' . NODES_TABLE . " SET node_lang_id='" . (string) $lid ."'
	  WHERE node_id = $node_id";
    $db->sql_query($sql);
    
    if(!empty($key)) {
		redirect( $tonjaw_root_path . 'index.' . $phpEx . '?' . $key);
	} else {
		redirect( $tonjaw_root_path . 'index.' . $phpEx);
	}
}

$data = array();
$sql = 'SELECT language_id, language_flag FROM ' . LANGUAGES_TABLE . ' WHERE language_enabled=1';

$result = $db->sql_query($sql);
$i = 0;
while ($row = $db->sql_fetchrow($result))
{
    $data[$i] = array(
	    'id'	=> $row['language_id'],
	    'flag'	=> $row['language_flag'],
    );
    
    $i++;
}


//print_r($data); exit;
$db->sql_freeresult($result);

// Set background image
$guestgroup = get_guest_group($node_id);

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
//page_header($lang_id);
page_header($lang_id, $page);

if( $config['mobile'] )
{
    //Get Guests Names
    //$guests_name = array();
    $guest_names = '';
    generate_menus($lang_id, $room_key, $guest_names);

}

foreach ($data as $row)
{
    //$data = array();
    $template->assign_block_vars('language', array(
	'S_TITLE'	=> $lang[$row['id']],
	//'S_URL'		=> ($room_key) ? $row[$config['tv_source_protocol']] . '?key=' . $room_key : $row[$config['tv_source_protocol']],
	'S_URL'		=> ($room_key) ? $tonjaw_root_path . $lang_url . '&lid=' . $row['id'] : $tonjaw_root_path . $lang_url . 'lid=' . $row['id'],
	'S_FLAG'	=> $row['flag'],
    ));
}

$template->assign_vars(array(
    'L_NOTICE'		=> '',
    //'L_PAGE_TITLE'	=> $lang['select_language'],
    'S_LANGUAGE'	=> '1',
    'S_ONMOUSEDOWN'	=> "",
    'T_BG_CLIP_PATH'	=> $config['vod_server'] . $config['vod_path'],
    'S_HOME_MENU_URL'	=> $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value'],
    'S_BGROUND_IMAGE'        => (!empty($guestgroup)) ? $guestgroup.'.jpg' : $config['bground_default'],
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
	'body' => 'language.tpl',
));

//add_log($adm_lang['read']);
page_footer();



?>
