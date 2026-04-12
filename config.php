<?php
/**
*
* config.php
*
* By Roberto Tonjaw. Dec 2013
*/

/**
* FINISHED
*/
$dbms = 'postgres';
$dbhost = 'localhost';
$dbport = '5432';
$dbname = 'postgres';
$dbuser = 'postgres';
$dbpasswd = 'apalah';
$table_prefix = '';
$acm_type = 'file';
$load_extensions = '';
/**
*	
*/
/*
// POWERPRO
$pmsname	= 'powerpro';
$pmsmethod	= 'web';
$pms_config['pms_format']	= 'xml';
$pms_config['pms_userid']	= 'TEST';
$pms_config['pms_userkey']	= 'RTW5QJBETLX8X2RDC9XVPCB';
$pms_config['local_saved_roomservice_order']	= true;
$pms_config['roomservice_item_in_pos']		= false;
$pms_config['roomservice_name_from_pos']	= false;
$pms_config['shop_item_in_pos']			= false;
$pms_config['shop_name_from_pos']		= false;
$pms_config['url_request']	= 'http://TEST:123@172.10.20.101:1968/api/1.0/xml/'; 
$pms_config['outlet_id'] = 'RS';
$pms_config['update_pos_from_iptv']		= false;
//dummy target xml
$pms_config['url_request']	= 'http://localhost/navicom/tester/';
*/
/*
// REALTA
// http://192.168.0.101/navicom/pms/nis.php
$pmsname	= 'rhapsody';
$pmsmethod	= 'web';
$pms_config['pms_format']	= 'xml';
$pms_config['pms_userid']	= 'REALTA';
$pms_config['pms_userkey']	= 'REALTA';
$pms_config['url_request']	= 'http://192.168.0.100/IPTv/Request.aspx'; 
//dummy target xml
$pms_config['url_request']	= 'http://localhost/navicom/tester/realta/';
$pms_config['local_saved_roomservice_order']	= true;
$pms_config['roomservice_item_in_pos']		= true;
$pms_config['roomservice_name_from_pos']	= true;
$pms_config['shop_item_in_pos']			= false;
$pms_config['shop_name_from_pos']		= false;
$pms_config['update_pos_from_iptv']		= false;
*/
/*
// VHP
// http://192.168.0.101/navicom/pms/nis.php
$pmsname	= 'vhp';
$pmsmethod	= 'web';
$pms_config['pms_format']	= 'xml';
$pms_config['pms_userid']	= 'VHP';
$pms_config['pms_userkey']	= 'VHP';
$pms_config['url_request']	= 'http://192.168.0.100/IPTv/Request.aspx'; 
//dummy target xml
$pms_config['url_request']	= 'http://localhost/navicom/tester/realta/';
$pms_config['local_saved_roomservice_order']	= true;
$pms_config['roomservice_item_in_pos']		= false;
$pms_config['roomservice_name_from_pos']	= true;
$pms_config['shop_item_in_pos']			= false;
$pms_config['shop_name_from_pos']		= false;
$pms_config['spa_item_in_pos']			= false;
$pms_config['spa_name_from_pos']		= false;
$pms_config['tour_item_in_pos']			= false;
$pms_config['tour_name_from_pos']		= false;
$pms_config['update_pos_from_iptv']		= true;
$pms_config['outlet_id'][0]['code']		= 'RS';
$pms_config['outlet_id'][0]['buffer_type']	= 'F';
$pms_config['outlet_id'][1]['code']		= 'GS';
$pms_config['outlet_id'][1]['buffer_type']	= 'G';
*/
// FOS
// http://192.168.0.101/navicom/pms/nis.php
/*$pmsname	= 'fos';
$pmsmethod	= 'web';
$pms_config['pms_format']	= 'xml';
$pms_config['pms_userid']	= 'FOS';
$pms_config['pms_userkey']	= 'FOS';
$pms_config['url_request']	= 'http://10.201.59.14:9763/services/FOS.HTTPEndpoint/'; 
//dummy target xml
//$pms_config['url_request']	= 'http://202.137.26.158:9763/services/FOS.HTTPEndpoint/';
$pms_config['local_saved_roomservice_order']	= true;
$pms_config['roomservice_item_in_pos']		= true;
$pms_config['roomservice_name_from_pos']	= true;
$pms_config['shop_item_in_pos']			= false;
$pms_config['shop_name_from_pos']		= false;
$pms_config['update_pos_from_iptv']		= false;
*/
//'http://localhost/~tonjaw/navicom/pms_tester_powerpro/';

/*
FIDS CONFIG
*/
$pmsname	= 'fids';
$config['fids_data_format']	= 'json'; //json
$config['fids_key']		= '170533ceb61bdbc877d71dd966333e8f';
$config['fids_server']		= 'http://192.168.200.215/sub/?id=status';
//$config['fids_server']          = 'ws://192.168.200.215/ws/subs/status';

$config['fids_api']		= 'http://ais.angkasapura1.co.id/navicom/flight/';
// sample url =		http://<ip address>/query.php?key=170533ceb61bdbc877d71dd966333e8f&id=DPS&format=xml
//dummy target fids
//$config['fids_server']		= 'http://localhost/navicom_makasar/tester/fids/';  
//$config['fids_api']		= 'http://localhost/navicom_makasar/tester/fids/'; 
$config['fids_arrival_code']	= 0;
$config['fids_departure_code']	= 1;
$config['fids_arrival_icon']	= $config['fids_arrival_code'] . '.png';
$config['fids_departure_icon']	= $config['fids_departure_code'] . '.png';
$config['fids_source'] 		= 'PT Angkasa Pura I';

@define('TONJAW_INSTALLED', true);
// @define('DEBUG', true);
// @define('DEBUG_EXTRA', true);

$config['root_id']	= '1';
$config['root_name']	= 'root';
$config['root_password'] = '7f6f945269a605fde7b99c50878a40c6'; //n4V1c0m
//$site_config['site_logo_img']		=> $user->img('site_logo'),
$config['weather_source'] = 'http://weather.pacitan.org/query.php?key=170533ceb61bdbc877d71dd966333e8f&id=';
$config['go_to_last_url'] = 0;
$config['go_to_welcome_screen'] = 1;
//$config['welcome_screen_file'] = 'welcome.php';


// directories path
$config['admin_path'] = "admin/";
$config['include_path'] = "includes/";
$config['qrcode_path'] = "includes/phpqrcode/";
$config['feature_path'] = "features/";
$config['pms_path'] = "pms/";
$config['style_path'] = 'styles/';
$config['language_path'] = 'languages/';
$config['js_path'] = $config['include_path'] . 'js/';
$config['datatable_path'] = $config['include_path'] . 'datatable/media/';
$config['media_path'] = 'media/';
$config['music_path'] = 'musics/';
$config['movie_path'] = 'movies/';
$config['audio_path'] = 'audios/';
$config['flag_path'] = 'images/flags/';
$config['clip_path'] = 'clips/';
$config['image_path'] = 'images/';
$config['ads_path'] = 'ads/';
$config['tv_icon_path'] = 'images/tv/';
$config['tv_promo_path'] = 'images/tv/promo/';
$config['movie_icon_path'] = 'images/movies/';
$config['trailer_path'] = 'movies/trailers/';
$config['directory_image_path'] = 'images/directories/';
$config['directory_promo_image_path'] = 'images/directory_promos/';
$config['city_icon_path'] = 'images/cities/';
$config['weather_icon_path'] = 'images/weathers/';
$config['menu_path'] = 'images/menus/';
$config['service_group_icon_path'] = 'images/fnb/category/';
$config['service_icon_path'] = 'images/fnb/';
$config['signage_path'] = 'admin/signage/';
$config['image_signage_path'] = 'media/images/signage/';
$config['clip_signage_path'] = 'media/clips/signage/';
$config['rss_signage_path'] = 'media/rss/signage/';
$config['text_signage_path'] = 'media/text/signage/';
$config['signage_style_path'] = 'styles/signage/template/';
$config['spa_group_icon_path'] = 'images/spa/category/';
$config['spa_icon_path'] = 'images/spa/';
$config['shop_group_icon_path'] = 'images/shop/category/';
$config['shop_icon_path'] = 'images/shop/';
$config['tour_group_icon_path'] = 'images/tour/category/';
$config['tour_icon_path'] = 'images/tour/';
$config['popup_promo_path'] = 'images/popup/';
$config['flight_icon_path'] = 'images/flight/';
$config['ads_popup_path'] = 'images/ads/popup/';
$config['ads_banner_path'] = 'images/ads/banner/';
$config['ads_home_path'] = 'images/ads/home/';

//$config['logo_path'] = 'images/';
///$config['dashboard_id'] = 1;
$config['page_thumbnail_prefix'] = 'page_';

// default value
$config['stb_http_header'] = 'Mozilla/5.0 (; U; Linux SH4;en) AppleWebKit/534.13 (KHTML, like Gecko) Safari/534.13 Chrome/9.0.597.98 SureSoftBrowser/3.0';
$config['self_ip'] = '127.0.0.1';
$config['mac_127'] = '00:00:00:00:00:00';
$config['default_cp_style'] = 'simplicity-v2';
//$config['default_cp_style'] = 'simplicity';
$config['default_style'] = 'savannah';
$config['mobile_style'] = 'mobile';
$config['schedule_dateformat']	= 'M d, Y g:i a';
$config['default_language'] = 'en';
$config['default_thumbnail'] = 'blank.jpg';
$config['default_thumbnail_tv'] = 'tv_default.png';
$config['default_thumbnail_movie'] = 'movie_default.png';
$config['default_thumbnail_directory'] = 'blank.png';
$config['default_thumbnail_service_group'] = 'blank.jpg';
$config['default_thumbnail_service'] = 'blank.jpg';
$config['default_thumbnail_spa_group'] = 'blank.jpg';
$config['default_thumbnail_spa'] = 'blank.jpg';
$config['default_thumbnail_roomservice'] = 'default';
$config['blank_png'] = 'blank.png';
$config['png_ext'] = '.png';
$config['mobile'] = false;
$config['min_qty'] = 1;
$config['max_qty'] = 10;
$config['over_max_qty'] = 999;
$config['min_hour'] = 7;
$config['max_hour'] = 23;

// change these configs to the client need
$config['header_dateformat']	= "l M j, Y";
//$config['default_lang']	= 'en';
$config['default_dateformat']	= 'D M d, Y g:i a';
$config['log_dateformat']	= 'D M d, Y g:i:s a';
$config['viewbill_dateformat']	= 'D M d, Y';
$config['vieworder_dateformat']	= 'M d, Y';
// $config['server_name']		= '192.168.114.14'; //'192.168.137.4';
$config['server_name']		= 'localhost:8000'; //'192.168.137.4';
$config['script_path']		= '/navicom';
$config['vod_server']		= 'http://192.168.114.4';
$config['vod_path']			= '/vod';
$config['trailer_path']		= '/trailer';
$config['movie_path']		= '/movies';
$config['server_port']		= 80;
$config['session_length']	= 36000;
$config['recs_per_page']	= 20;
$config['welcome_page_id']	= 1;
$config['user_guide_page_id']	= 2;
$config['connectivity_page_id'] = 3;
$config['currency'] 		= array('IDR' => 'IDR', 'USD' => 'USD');
$config['lock_on_empty_room'] = false;
$config['home_menu_value']	= '1';
$config['guest_names_separator'][0]	= ' <br/> & '; // <br/>
$config['guest_names_separator'][1]	= '<br/>'; // <br/> ''
$config['list_ip_static'] = array("192.168.1.91", "192.168.0.52", "192.168.0.222"); //CPL, Swimming Pool, Smoking Area

/*
BEGIN Will be moved to database
*/

$config['site_name']	= "Navicom IPTV";
$config['tv_source_protocol'] = 'udp'; //udp
$config['stb_auth'] = 'ip'; //mac ip

$config['bground_clip'] = false;
$config['bground_clip_file'] = 'santika.mp4';
$config['bground_default'] = 'bground.jpg';
$config['clip_on_homescreen'] = true;
$config['clip_file'] = 'santika.mp4'; //'mercure-official.mp4';
$config['tv_channel_id_on_home'] = 147; // Trans 7
$config['welcome_screen'] = false;
$config['random_background'] = false;
$config['tv_promo_random'] = false;
$config['tv_on_home'] = false;
$config['tv_on_home_url'] = 'udp://@225.0.0.1:1234';
$config['tv_grouping'] = false;
$config['spa_grouping'] = false;
$config['tour_grouping'] = false;
$config['fe_menu_grouping'] = false;
$config['fe_menu_max'] = 8;
$config['connectivity_in_home_screen'] = false;
$config['hotspot_in_home_screen'] = true;
$config['tv_channel_id_on_home'] = 174; // I News

/*
END Will be moved to database
*/

// Airport
$config['firebase_key'] = 'AAAA8jG31NU:APA91bG8LTxwdOIaCzOXXYp7JhkzPMRsU7JvxPXWiPwE6pH8xbmCho1ArUklAUcnn9xrWlj-YGXFF7v8mzua-afuwWFr1GUth91CLidpippfMST1Hmn2vsj47x9mt3n17dKjeUjFl_Yj';
$config['display_period_days'] = 3;
$config['API_server'] = 'http://'.$config['server_name'].$config['script_path'].'/API/'; 
$config['fids_airport_code_default'] = 'UPG';
$config['device_switch_on'] = 'subscribe'; // subscribe/status/system
$config['notification_in_all_gates'] = true; 

//BUFFER TYPE
$config['roomservice_buffer_type'] = 'F';
$config['shop_buffer_type'] = 'G';
$config['tour_buffer_type'] = 'T';
$config['spa_buffer_type'] = 'S';
$config['view_orders_all'] = false;

//MESSAGE TARGET
$config['code_room'] = 'R';
$config['code_hotel'] = 'H';
$config['hotel'] = 'Hotel';

// Image
$config['image_extensions'] = array('jpg', 'jpeg', 'gif', 'png');
$config['flag_filesize'] = 20144;
$config['flag_width'] = 230;
$config['flag_height'] = 120;
$config['poster_filesize'] = 801440;
$config['poster_width'] = 300;
$config['poster_height'] = 432;
$config['directory_image_filesize'] = 8801440;
$config['directory_image_width'] = 1920;
$config['directory_image_height'] = 1200;

$config['thumbnail_prefix'] = '_tn_';
$config['thumbnail_width'] = 80;
$config['mime_triggers'] = 'body|head|html|img|plaintext|a href|pre|script|table|title';

// Advertisment
$config['advert_type'][0] = 'image';
$config['advert_type'][1] = 'text';
$config['advert_type'][2] = 'clip';

$config['signage_type'] = array(1 => 'Image', 2 => 'Text', 3 => 'Clip', 4 => 'Rss', 5 => 'Clock'/*, 6 => 'List'*/);
$config['direction'] = array('NO' => 'North', 'NE' => 'North East', 'EA' => 'East', 'SE' => 'South East', 'SO' => 'South', 'SW' => 'South West', 'WE' => 'West', 'NW' => 'North West');

$navicoms = array('00:00:00:00:00:00', 'f0:bf:97:08:dd:81', '3c:77:e6:d7:29:2b', '10:bf:48:36:be:cc', '94:db:c9:9d:3a:fe'); //, '74:2f:68:d4:fb:08');



/*

//do not change these following configs
$config['auth_method']		= 'db';
$config['browser_check']	= 1;
$config['cookie_secure']	= 0;
$config['force_server_vars']	= 0;
$config['forwarded_for_check']	= 0;
$config['ip_check']		= 3;
//$config['limit_load']		= 0;
//$config['limit_search_load']	= 0;
$config['server_protocol']	= 'http://';
$config['server_port']		= 80;	
$config['referer_validation']	= 1;
$config['ip_login_limit_use_forwarded'] = 0;
$config['ip_login_limit_max']	= 50;
*/

?>
