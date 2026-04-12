<?php
/**
*
* weather.php	
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

// GRAB WEATHER
$weather_data = array();

//$filter = ($gid) ? " AND gp.movie_group_id = $gid" : '';

$sql = "SELECT weather_id, weather_city, weather_city_full, weather_today_text, 
    weather_today_condition, weather_today_icon, weather_today_temp_f_min, 
    weather_today_temp_f_max, weather_today_temp_c_min, weather_today_temp_c_max, weather_day1_text, 
    weather_day1_condition, weather_day1_icon, weather_day1_temp_f_min, 
    weather_day1_temp_f_max, weather_day1_temp_c_min, weather_day1_temp_c_max, weather_day2_text, 
    weather_day2_condition, weather_day2_icon, weather_day2_temp_f_min, 
    weather_day2_temp_f_max, weather_day2_temp_c_min, weather_day2_temp_c_max, weather_day3_text, 
    weather_day3_condition, weather_day3_icon, weather_day3_temp_f_min, 
    weather_day3_temp_f_max, weather_day3_temp_c_min, weather_day3_temp_c_max, weather_exist 
	FROM " . WEATHER_TABLE . " 
	WHERE weather_exist=1 AND weather_enabled=1 
	ORDER BY weather_city";

//echo $sql; exit;
$result = $db->sql_query($sql);
$i = 0;
$rec1 = 1;

while ($row = $db->sql_fetchrow($result))
{
    $weather_data[$i] = array(
	'rec1'			=> $rec1,
	'id'			=> $row['weather_id'],
	'city'			=> $row['weather_city'],
	'city_full'		=> $row['weather_city_full'],
	'today_l'		=> $row['weather_today_text'],
	'today_condition'	=> $row['weather_today_condition'],
	'today_icon'		=> $row['weather_today_icon'],
	'today_tempf_l'		=> $row['weather_today_temp_f_min'],
	'today_tempf_h'		=> $row['weather_today_temp_f_max'],
	'today_tempc_l'		=> $row['weather_today_temp_c_min'],
	'today_tempc_h'		=> $row['weather_today_temp_c_max'],
	
	'day1_l'		=> $row['weather_day1_text'],
	'day1_condition'	=> $row['weather_day1_condition'],
	'day1_icon'		=> $row['weather_day1_icon'],
	'day1_tempf_l'		=> $row['weather_day1_temp_f_min'],
	'day1_tempf_h'		=> $row['weather_day1_temp_f_max'],
	'day1_tempc_l'		=> $row['weather_day1_temp_c_min'],
	'day1_tempc_h'		=> $row['weather_day1_temp_c_max'],
	
	'day2_l'		=> $row['weather_day2_text'],
	'day2_condition'	=> $row['weather_day2_condition'],
	'day2_icon'		=> $row['weather_day2_icon'],
	'day2_tempf_l'		=> $row['weather_day2_temp_f_min'],
	'day2_tempf_h'		=> $row['weather_day2_temp_f_max'],
	'day2_tempc_l'		=> $row['weather_day2_temp_c_min'],
	'day2_tempc_h'		=> $row['weather_day2_temp_c_max'],
	    
	'day3_l'		=> $row['weather_day3_text'],
	'day3_condition'	=> $row['weather_day3_condition'],
	'day3_icon'		=> $row['weather_day3_icon'],
	'day3_tempf_l'		=> $row['weather_day3_temp_f_min'],
	'day3_tempf_h'		=> $row['weather_day3_temp_f_max'],
	'day3_tempc_l'		=> $row['weather_day3_temp_c_min'],
	'day3_tempc_h'		=> $row['weather_day3_temp_c_max'],
    );

    $rec1 = 0;
    $i++;
}

$query_mb= "SELECT  background_music_url from background_music where background_music_enabled = 1";
 $hasil = $db->sql_query($query_mb);
 $roww = $db->sql_fetchrow($hasil);
 $test = $roww['background_music_url'];
 $daniel = $config['vod_server'] . '/vod/music_backgrounds/'. $test .'';
$db->sql_freeresult($result);
//print_r($weather_data); exit;

//$vod_trailer = $config['vod_server'] . $config['vod_path'] . $config['trailer_path'] . '/';
// Generate the page
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

foreach ($weather_data as $row)
{
    //$data = array();
    $template->assign_block_vars('forecast', array(
	'REC1'			=> $row['rec1'],
	'S_CITY'		=> $row['city'],
	'L_TODAY'		=> $lang['today'], 
	'S_CITY_SIGNATURE'	=> str_replace(' ', '_', $row['city']),
	'S_WEATHER_TODAY'	=> $row['today_icon'],
	'S_TODAY_TEMPC_H'	=> $row['today_tempc_h'],
	'S_TODAY_TEMPC_L'	=> $row['today_tempc_l'],
	'S_FORECAST1_WEATHER'	=> $row['day1_icon'],
	'S_FORECAST1_TEMPC_H'	=> $row['day1_tempc_h'],
	'S_FORECAST1_TEMPC_L'	=> $row['day1_tempc_l'],
	'S_FORECAST2_WEATHER'	=> $row['day2_icon'],
	'S_FORECAST2_TEMPC_H'	=> $row['day2_tempc_h'],
	'S_FORECAST2_TEMPC_L'	=> $row['day2_tempc_l'],
	'S_FORECAST3_WEATHER'	=> $row['day3_icon'],
	'S_FORECAST3_TEMPC_H'	=> $row['day3_tempc_h'],
	'S_FORECAST3_TEMPC_L'	=> $row['day3_tempc_l'],
	//'L_FORECAST_DAY1'	=> $lang[strtolower($row['day1_l'])],
	//'L_FORECAST_DAY2'	=> $lang[strtolower($row['day2_l'])],
	//'L_FORECAST_DAY3'	=> $lang[strtolower($row['day3_l'])],
    ));
}
/*
foreach ($unique_group as $row)
{
    //$data = array();
    $template->assign_block_vars('group', array(
	'L_GROUP'	=> $row['group'],
	'S_GROUP'	=> $tonjaw_root_path . "tv_channel.php?gid=" . $row['gid'],
    ));
}
*/
$template->assign_vars(array(
    'L_NOTICE'			=> '',
    'S_WEATHER'			=> '1',
    'S_ONMOUSEDOWN'		=> '',
    'L_FORECAST_DAY1'		=> $lang[strtolower($row['day1_l'])],
    'L_FORECAST_DAY2'		=> $lang[strtolower($row['day2_l'])],
    'L_FORECAST_DAY3'		=> $lang[strtolower($row['day3_l'])],
    //'L_PAGE_TITLE'		=> $lang['weather'],
    'S_HOME_MENU_URL'		=> $tonjaw_root_path . 'index.php?menu=' . $config['home_menu_value'],
	
'S_MB'               => $daniel,
    //'T_MEDIA_IMAGE_MOVIE_PATH'	=> $tonjaw_root_path . $config['media_path'] . $config['movie_icon_path'],
    //'T_LOG_JS_PATH'		=> $tonjaw_root_path . $config['js_path'] . 'log.js',
));

$template->set_filenames(array(
	'body' => 'weather.tpl',
));

//add_log($adm_lang['read']);
page_footer();


?>
