<?php
/**
*
* inbox.php
*
* Roberto Tonjaw. Jun 2014
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
//require_once($tonjaw_root_path . $config['pms_path'] . 'common_pms.' . $phpEx);

/*
require($tonjaw_root_path . $config['pms_path'] . $pmsname . '.' . $phpEx);
$pms	= new $pms_api();
*/

//print_r($guests_name); exit;

// GRAB LANGUAGE
$key = request_var('key', '');

// Set background image
$guestgroup = get_guest_group($node_id);

// Generate the page
$widget_data = grab_weather_widget('Kuta');
$template->set_template();
//page_header($lang_id);
page_header($lang_id, $page);

if( $config['mobile'] )
{
    //Get Guests Names
    //$guests_name = array();
    $guest_names = '';
    generate_menus($lang_id, $room_key, $guest_names);
 
}

// If Room Share or Group status is/are TRUE set empty inbox
//if( empty($guests_name[0]['group']) || empty($guests_name[0]['room_share']) )
//{
    //GET MESSAGE
    $pms->get_message_all($guests_name[0]['resv_id']);
    //GET MESSAGE COUNT
    $message_count = $pms->get_message_count($guests_name[0]['resv_id']);
    //print_r($pms->message_data); exit;
    $i = 1;
    foreach ($pms->message_data as $row)
    {
	//$data = array();
	if ( !empty($row['date']) ) 
	{
		$rep = array('<br/>' => 'a', '<br>' => 'b', '\n' => 'c', '\r' => 'd', '\t' => 'e');
        	$content = strtr($row['content'], $rep);
	    $template->assign_block_vars('inbox', array(
		'S_NO'		=> $i,
		'S_DATE'	=> date($config['viewbill_dateformat'], $row['date']),
		'S_FROM'	=> $row['message_from'],
		'S_CONTENT'	=> $row['content'], //prepare_message($row['content']),
		'S_TIME'	=> date($config['default_dateformat'], $row['date']),
	    ));

	    $i++;
	}
    }
	
//}


$template->assign_vars(array(
    'L_NOTICE'		=> '',
    'L_PAGE_TITLE'	=> $lang['message_inbox'],
    'S_INBOX'		=> '1',
    'S_ONMOUSEDOWN'	=> "",
    'T_BG_CLIP_PATH'	=> $config['vod_server'] . $config['vod_path'],
    'L_DATE'		=> $lang['date'],
    'L_FROM'		=> $lang['from'],
    'L_CONTENT'		=> $lang['detail'],
    'URL_SEND_MESSAGE'	=> $tonjaw_root_path . 'sendmessage.' . $phpEx . "?key=$room_key",
    'L_SEND_MESSAGE'	=> $lang['send_message'],
    'S_HOME_MENU_URL'		=> $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value'],
    'S_BGROUND_IMAGE'        => (!empty($guestgroup)) ? $guestgroup.'.jpg' : $config['bground_default'],
    'S_NEW_MESSAGE'	=> 0,
		'S_WIDGET_DATE'		=> date("D. j M"),
	'S_WIDGET_CITY'		=> $widget_data['city'],
	'S_WIDGET_ICON'		=> $widget_data['icon'],
	'S_WIDGET_TEMP'		=> $widget_data['temp'],
	'S_CURRENT_TIME'	=> date("Y/n/d/H/i/s", time()),
	'S_CURRENT_PAGE'	=> $_SERVER['QUERY_STRING'],
));

$template->set_filenames(array(
	'body' => 'inbox.tpl',
));

//add_log($adm_lang['read']);
page_footer();


?>
